<?php
namespace App\Controller;

use App\Controller\AppController;

class CreditCardsController extends AppController
{
    public function index()
    {
        $userId = $this->Auth->user('id');
        $name = $this->request->getQuery('name');
        $conditions = ['user_id' => $userId];
    
        if (!empty($name)) {
            $conditions['name LIKE'] = '%' . $name . '%';
        }
    
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['name' => 'ASC']
        ];
    
        $creditCards = $this->paginate($this->CreditCards);
    
        $this->set(compact('creditCards'));
    }
    

    public function add()
    {
        $creditCards = $this->CreditCards->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $data = $this->request->getData();

            $data = $this->convertCurrencyFields($data, ['credit_limit']);

            $data['user_id'] = $userId;
            $creditCards = $this->CreditCards->patchEntity($creditCards, $data);
            $creditCards->limit_utility = 0;

            if ($this->CreditCards->save($creditCards)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCards', 'users'));
    }

    public function edit($id = null)
    {
        $creditCards = $this->CreditCards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $userId = $this->Auth->user('id');
            $data['user_id'] = $userId;
            $data = $this->convertCurrencyFields($data, ['credit_limit', 'limit_utility']);
            $creditCards = $this->creditCards->patchEntity($creditCards, $data);
            if ($this->CreditCards->save($creditCards)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }
        $users = $this->CreditCards->Users->find('list', ['limit' => 200]);
        $this->set(compact('creditCards', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $creditCards = $this->CreditCards->get($id);
        if ($this->CreditCards->delete($creditCards)) {
            $this->Flash->success(__('O Registro foi deletado.'));
        } else {
            $this->Flash->error(__('O Registro não pode ser deletado!'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
