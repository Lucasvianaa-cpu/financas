<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->current_user = $this->Auth->user('id');

        $this->Auth->allow(['adicionar']);
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function dashboard()
    {
        $this->loadModel('Expenses');
        $this->loadModel('Receives');
        $this->loadModel('ShoppingCards');

        $userId = $this->Auth->user('id');
        
        $this->processRecurringReceives($userId);
        $this->notifyUpcomingExpenses($userId);

        $totalExpenses = 0.00;
        $totalReceives = 0.00;
        $totalShoppingCards = 0.00;

        $today = FrozenTime::now();
        $firstDayOfMonth = $today->firstOfMonth();
        $lastDayOfMonth = $today->lastOfMonth();

        $expenses = $this->Expenses->find('all')
            ->where([
                'user_id' => $userId,
                'date_maturity >=' => $firstDayOfMonth,
                'date_maturity <=' => $lastDayOfMonth
            ]);
        $totalExpenses = $expenses->sumOf('value');

        $receives = $this->Receives->find('all')
            ->where([
                'user_id' => $userId,
                'date_receive >=' => $firstDayOfMonth,
                'date_receive <=' => $lastDayOfMonth
            ]);
        $totalReceives = $receives->sumOf('value');

        $shoppingCards = $this->ShoppingCards->find('all')
            ->where([
                'user_id' => $userId,
                'date_shopping >=' => $firstDayOfMonth,
                'date_shopping <=' => $lastDayOfMonth
            ]);
        $totalShoppingCards = $shoppingCards->sumOf('value_total');

        $saldoMensal = $totalReceives - $totalExpenses;

        $saldoMensalPorMes = [];
        $year = $today->year;
        for ($i = 1; $i <= 12; $i++) {
            $startDate = new FrozenTime("$year-$i-01");
            $endDate = $startDate->endOfMonth();

            $monthlyExpenses = $this->Expenses->find('all')
                ->where([
                    'user_id' => $userId,
                    'date_maturity >=' => $startDate,
                    'date_maturity <=' => $endDate
                ])->sumOf('value');

            $monthlyReceives = $this->Receives->find('all')
                ->where([
                    'user_id' => $userId,
                    'date_receive >=' => $startDate,
                    'date_receive <=' => $endDate
                ])->sumOf('value');

            $saldoMensalPorMes[$i] = $monthlyReceives - $monthlyExpenses;
        }

        $user = $this->Users->get($userId);
        $this->set(compact('user', 'totalExpenses', 'totalReceives', 'totalShoppingCards', 'saldoMensal', 'saldoMensalPorMes'));
    }


    public function reportsSaldo()
    {
        $userId = $this->Auth->user('id');
        $this->loadModel('Expenses');
        $this->loadModel('Receives');

        $today = FrozenTime::now();
        $startDate = $today->startOfMonth();
        $endDate = $today->endOfMonth();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['start_date'])) {
                $startDate = new FrozenTime($data['start_date']);
            }
            if (!empty($data['end_date'])) {
                $endDate = new FrozenTime($data['end_date']);
            }
        }

        $endDate = $endDate->endOfDay();

        $expenses = $this->Expenses->find('all')
            ->where([
                'user_id' => $userId,
                'date_maturity >=' => $startDate,
                'date_maturity <=' => $endDate
            ]);
        $totalExpenses = $expenses->sumOf('value');

        $receives = $this->Receives->find('all')
            ->where([
                'user_id' => $userId,
                'date_receive >=' => $startDate,
                'date_receive <=' => $endDate
            ]);
        $totalReceives = $receives->sumOf('value');

        $saldoMensal = $totalReceives - $totalExpenses;

        $this->set(compact('startDate', 'endDate', 'totalExpenses', 'totalReceives', 'saldoMensal'));
    }


    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
            } else {
                $this->Flash->error(__('E-mail ou senha incorretos! Por favor, tente novamente.'));
            }
        }
    }

    public function adicionar()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registro cadastrado com sucesso!'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Não foi possivel realizar o cadastro, tente novamente.'));
        }
        $this->set(compact('user'));
    }

    public function sair()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Categories', 'CreditCards', 'Expenses', 'Receives', 'ShoppingCards'],
        ]);

        $this->set('user', $user);
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
