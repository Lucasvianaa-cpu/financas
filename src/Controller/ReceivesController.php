<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenDate;

use DateTime;

class ReceivesController extends AppController
{

    public function index()
    {
        $userId = $this->Auth->user('id');

        $status = $this->request->getQuery('status');
        $dateReceipt = $this->request->getQuery('data_recebimento');
        $description = $this->request->getQuery('description');

        $conditions = ['Receives.user_id' => $userId];
    
        if ($status !== null) {
            $conditions['Receives.status'] = ($status == 1) ? 1 : 0;
        }
    
        if (!empty($dateReceipt)) {
            $date = DateTime::createFromFormat('d/m/Y', $dateReceipt);
            if ($date) {
                $formattedDate = $date->format('Y/m/d'); 
                $conditions['Receives.date_receive'] = $formattedDate;
            } 
        }
        if (!empty($description)) {
            $conditions['Receives.description LIKE'] = '%' . $description . '%';
        }
    
        $this->paginate = [
            'contain' => ['Categories', 'Users'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['date_receive' => 'DESC']
        ];

        $this->processRecurringReceives($userId);

        $receives = $this->paginate($this->Receives);

        $this->set(compact('receives'));
    }

    public function add()
    {
        $receife = $this->Receives->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $data = $this->request->getData();
            
            $data = $this->convertCurrencyFields($data, ['value']);

            $data['user_id'] = $userId;
            $receife = $this->Receives->patchEntity($receife, $data);
            if ($this->Receives->save($receife)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['controller' => 'Receives', 'action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }

        $categories = $this->Receives->Categories->find('list', [
            'limit' => 200,
            'conditions' => [
                'is_receive' => true,
                'is_active' => true,
                'user_id' => $this->Auth->user('id')
            ]
        ]);

        $users = $this->Receives->Users->find('list', ['limit' => 200]);

        $this->set(compact('receife', 'categories', 'users'));
    }

    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');

        $receife = $this->Receives->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $data = $this->convertCurrencyFields($data, ['value']);

            $userId = $this->Auth->user('id');
            $data['user_id'] = $userId;

            $receife = $this->Receives->patchEntity($receife, $data);

            if ($this->Receives->save($receife)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['controller' => 'Receives', 'action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }

        $categories = $this->Receives->Categories->find('list', [
            'limit' => 200,
            'conditions' => [
                'is_receive' => true,
                'is_active' => true,
                'user_id' => $this->Auth->user('id')
            ]
        ]);

        $users = $this->Receives->Users->find('list', ['limit' => 200]);

        $this->set(compact('receife', 'categories', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receife = $this->Receives->get($id);
        if ($this->Receives->delete($receife)) {
            $this->Flash->success(__('O Registro foi deletado!'));
        } else {
            $this->Flash->error(__('O Registro não pode ser deletado, tente novamente!'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
