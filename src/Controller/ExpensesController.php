<?php

namespace App\Controller;

use App\Controller\AppController;
use DateTime;

class ExpensesController extends AppController
{
    public function index()
    {
        $userId = $this->Auth->user('id');
        $this->notifyUpcomingExpenses($userId);

        $status = $this->request->getQuery('status');
        $dateMaturity = $this->request->getQuery('data_vencimento');
        $description = $this->request->getQuery('description');

        $conditions = ['Expenses.user_id' => $userId];

        if ($status !== null) {
            $conditions['Expenses.status'] = ($status == 1) ? 1 : 0;
        }

        if (!empty($dateMaturity)) {
            $date = DateTime::createFromFormat('d/m/Y', $dateMaturity);
            if ($date) {
                $formattedDate = $date->format('Y/m/d');
                $conditions['Expenses.date_maturity'] = $formattedDate;
            }
        }

        if (!empty($description)) {
            $conditions['Expenses.description LIKE'] = '%' . $description . '%';
        }

        $this->paginate = [
            'contain' => ['Categories', 'Users'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['date_maturity' => 'DESC']
        ];

        $expenses = $this->paginate($this->Expenses);

        $this->set(compact('expenses'));
    }


    public function add()
    {
        $expense = $this->Expenses->newEntity();
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            $data = $this->request->getData();
            $data = $this->convertCurrencyFields($data, ['value']);

            $data['user_id'] = $userId;
            $expense = $this->Expenses->patchEntity($expense, $data);

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }

        $categories = $this->Expenses->Categories->find('list', [
            'limit' => 200,
            'conditions' => [
                'is_pay' => true,
                'is_active' => true,
                'user_id' => $this->Auth->user('id')
            ]
        ]);

        $users = $this->Expenses->Users->find('list', ['limit' => 200]);

        $this->set(compact('expense', 'categories', 'users'));
    }

    public function edit($id = null)
    {
        $expense = $this->Expenses->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userId = $this->Auth->user('id');

            $data = $this->request->getData();
            $data = $this->convertCurrencyFields($data, ['value']);

            $data['user_id'] = $userId;

            $expense = $this->Expenses->patchEntity($expense, $data);

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('O Registro foi salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Registro não pode ser salvo, tente novamente!'));
        }

        $categories = $this->Expenses->Categories->find('list', [
            'limit' => 200,
            'conditions' => [
                'is_pay' => true,
                'is_active' => true,
                'user_id' => $this->Auth->user('id')
            ]
        ]);

        $users = $this->Expenses->Users->find('list', ['limit' => 200]);

        $this->set(compact('expense', 'categories', 'users'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expense = $this->Expenses->get($id);
        if ($this->Expenses->delete($expense)) {
            $this->Flash->success(__('O Registro foi deletado!'));
        } else {
            $this->Flash->error(__('O Registro não pode ser deletado, tente novamente!'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reportsExpenseMonthly()
    {
        $this->loadModel('Expenses');
        $this->loadModel('Categories');
    
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
    
        $expenses = $this->Expenses->find()
            ->contain(['Categories'])
            ->where([
                'Expenses.user_id' => $userId,
                'Expenses.date_maturity >=' => $startDate->format('Y-m-d'),
                'Expenses.date_maturity <=' => $endDate->format('Y-m-d')
            ])
            ->all();
    
        $reportData = [];
        foreach ($expenses as $expense) {
            $categoryId = $expense->category_id;
            if (!isset($reportData[$categoryId])) {
                $reportData[$categoryId] = [
                    'category' => $expense->category->name,
                    'expenses' => [],
                    'total' => 0
                ];
            }
            $reportData[$categoryId]['expenses'][] = $expense;
            $reportData[$categoryId]['total'] += $expense->value;
        }
    
        $this->set(compact('reportData', 'startDate', 'endDate'));
    }

}
