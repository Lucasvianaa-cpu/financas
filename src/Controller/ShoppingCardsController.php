<?php

namespace App\Controller;

use App\Controller\AppController;
use DateTime;
use Cake\I18n\FrozenDate;

class ShoppingCardsController extends AppController
{

    public function index()
    {
        $userId = $this->Auth->user('id');

        $dateShopping = $this->request->getQuery('date_shopping');
        $description = $this->request->getQuery('description');

        $conditions = ['ShoppingCards.user_id' => $userId];

        if (!empty($dateShopping)) {
            $date = DateTime::createFromFormat('d/m/Y', $dateShopping);
            if ($date) {
                $formattedDate = $date->format('Y/m/d');
                $conditions['ShoppingCards.date_shopping'] = $formattedDate;
            }
        }

        if (!empty($description)) {
            $conditions['ShoppingCards.description LIKE'] = '%' . $description . '%';
        }

        $this->paginate = [
            'contain' => ['Users', 'CreditCards'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['ShoppingCards.date_shopping' => 'DESC']
        ];

        $shoppingCards = $this->paginate($this->ShoppingCards);

        $this->set(compact('shoppingCards'));
    }


    public function add()
    {
        $userId = $this->Auth->user('id');
        $shoppingCard = $this->ShoppingCards->newEntity();
    
        if ($this->request->is('post')) {
            $data = $this->request->getData();
    
            $data = $this->convertCurrencyFields($data, ['value_total']);
    
            $data['user_id'] = $userId;
            $shoppingCard = $this->ShoppingCards->patchEntity($shoppingCard, $data);
    
            $shoppingCard->value_total = $this->request->getData('valor_parcela');
    
            if ($this->ShoppingCards->save($shoppingCard)) {

                if ($shoppingCard->is_parcel) {     
                    $shoppingCard->parcel_actual = 1;
                    $shoppingCard->parcel_number = $this->request->getData('parcel_number');
    
                    $this->createParcels($shoppingCard, $this->request->getData('date_shopping'));
                }

                $this->Flash->success(__('O Registro foi salvo!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }
    
        $credit_cards = $this->ShoppingCards->CreditCards->find('list', ['conditions' => ['user_id' => $userId]]);
        $users = $this->ShoppingCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('shoppingCard', 'credit_cards', 'users'));
    }
    

    public function edit($id = null)
    {
        $shoppingCard = $this->ShoppingCards->get($id, [
            'contain' => [],
        ]);

        $userId = $this->Auth->user('id');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $data = $this->convertCurrencyFields($data, ['value_total', 'value_parcel']);

            $data['user_id'] = $userId;
            $shoppingCard = $this->ShoppingCards->patchEntity($shoppingCard, $data);

            if ($this->ShoppingCards->save($shoppingCard)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }
        $credit_cards = $this->ShoppingCards->CreditCards->find('list', ['conditions' => ['user_id' => $userId]]);
        $users = $this->ShoppingCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('shoppingCard', 'credit_cards', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shoppingCard = $this->ShoppingCards->get($id);
        if ($this->ShoppingCards->delete($shoppingCard)) {
            $this->Flash->success(__('O Registro foi deletado!'));
        } else {
            $this->Flash->error(__('O Registro não pode ser deletado.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    private function createParcels($shoppingCard)
    {
        if (empty($this->Auth->user())) {
            $this->Flash->error(__('Você não possui permissão para visualizar esta página.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        for ($i = 1; $i < $shoppingCard->parcel_number; $i++) {
            $_shoppingCard = $this->ShoppingCards->newEntity();
            $_shoppingCard = $this->ShoppingCards->patchEntity($_shoppingCard, $shoppingCard->toArray());
            unset($_shoppingCard->id);
            $_shoppingCard->parcel_actual = $shoppingCard->parcel_actual + $i;
            $_shoppingCard->origin_parcel_id = $shoppingCard->id;

            $_shoppingCard->date_shopping = $shoppingCard->date_shopping->modify("$i month");

            $this->ShoppingCards->save($_shoppingCard);
        }
    }

    public function reportsShopping() {
        $userId = $this->Auth->user('id');
        
        $startDate = new \DateTime('first day of this month');
        $endDate = new \DateTime('last day of this month');
    
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['start_date'])) {
                $startDate = new \DateTime($data['start_date']);
            }
            if (!empty($data['end_date'])) {
                $endDate = new \DateTime($data['end_date']);
            }
        }
    
        $endDate->setTime(23, 59, 59);
        
        $this->loadModel('CreditCards');
        $this->loadModel('ShoppingCards');
    
        $shoppingCards = $this->ShoppingCards->find()
            ->contain(['CreditCards' => function ($q) {
                return $q->select(['CreditCards.id', 'CreditCards.name']);
            }])
            ->where([
                'CreditCards.user_id' => $userId,
                'date_shopping >=' => $startDate,
                'date_shopping <=' => $endDate
            ])
            ->order(['date_shopping' => 'ASC'])
            ->toArray();
        
        $this->set(compact('shoppingCards', 'startDate', 'endDate'));
    }
}