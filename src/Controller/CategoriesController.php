<?php

namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{

    public function index()
    {
        $userId = $this->Auth->user('id');

        $ativo = $this->request->getQuery('ativo');
        $nome = $this->request->getQuery('nome');

        $conditions = ['Categories.user_id' => $userId];

        if ($ativo != null && $ativo != 3) {
            $conditions['Categories.is_active'] = ($ativo == 1) ? 1 : 0;
        }

        if (!empty($nome)) {
            $conditions['Categories.name LIKE'] = '%' . $nome . '%';
        }

        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => $conditions,
            'limit' => 10,
        ];

        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
    }


    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');

            $data = $this->request->getData();
            $data['user_id'] = $userId;

            $category = $this->Categories->patchEntity($category, $data);

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('O Registro foi salvo!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }
        $users = $this->Categories->Users->find('list', ['limit' => 200]);
        $this->set(compact('category', 'users'));
    }

    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userId = $this->Auth->user('id');

            $data = $this->request->getData();
            if (empty($data['user_id'])) {
                $data['user_id'] = $userId;
            }

            $category = $this->Categories->patchEntity($category, $data);

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('O Registro foi salvo!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }

        $users = $this->Categories->Users->find('list', ['limit' => 200]);
        $this->set(compact('category', 'users'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('O Registro foi deletado!'));
        } else {
            $this->Flash->error(__('O Registro não pode ser deletado, tente novamente!'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
