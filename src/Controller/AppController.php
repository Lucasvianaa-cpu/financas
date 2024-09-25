<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;


class AppController extends Controller
{

    public $helpers = [
        'Form' => [
            'className' => 'Form2'
        ]
    ];

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Receives');
        $this->loadModel('Expenses');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'userModel' => 'Users'
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ],
            'storage' => 'Session',
            'authorize' => 'Controller'
        ]);
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function removerAcentos($str)
    {
        $acentos = array('á', 'à', 'â', 'ã', 'é', 'è', 'ê', 'í', 'ì', 'î', 'ó', 'ò', 'ô', 'õ', 'ú', 'ù', 'û', 'ç', 'Á', 'À', 'Â', 'Ã', 'É', 'È', 'Ê', 'Í', 'Ì', 'Î', 'Ó', 'Ò', 'Ô', 'Õ', 'Ú', 'Ù', 'Û', 'Ç');
        $semAcentos = array('a', 'a', 'a', 'a', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'c', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'C');
        $str = str_replace($acentos, $semAcentos, $str);
        return $str;
    }

    //Gera registros recorrentes
    public function processRecurringReceives($userId)
    {
        $receivesRecurring = $this->Receives->find('all', [
            'conditions' => ['is_recurring' => true, 'user_id' => $userId]
        ])->toArray();

        $today = new FrozenDate(date('Y-m-d'));

        foreach ($receivesRecurring as $recurring) {
            $date_recurring = $recurring->date_receive->modify('+1 month');

            if ($date_recurring == $today) {
                $receife = $this->Receives->newEntity();

                $receife = $this->Receives->patchEntity($receife, $recurring->toArray());

                unset($receife->id);
                $receife->date_receive = $date_recurring;

                if ($this->Receives->save($receife)) {
                    $recurring->is_recurring = false;
                    $this->Receives->save($recurring);
                    $this->Flash->success(__('Registro recorrente lançado com sucesso.'));
                }
            }
        }
    }

    // Notifica 1 vez para despesas pendentes
    public function notifyUpcomingExpenses($userId)
    {
        $expenses = $this->Expenses->find('all', [
            'conditions' => ['user_id' => $userId]
        ])->toArray();

        $now = new FrozenTime();
        $todayFormatted = $now->format('Y-m-d');
        $threeDaysLater = $now->addDays(3);

        foreach ($expenses as $expense) {
            $expenseMaturityDate = new FrozenTime($expense->date_maturity);

            if ($expense->status === false && $expenseMaturityDate <= $threeDaysLater && $expenseMaturityDate->format('Y-m-d') >= $todayFormatted) {
                $lastNotified = $expense->last_notified ? new FrozenTime($expense->last_notified) : null;

                if ($expenseMaturityDate->format('Y-m-d') === $todayFormatted) {
                    if ($lastNotified === null || $lastNotified->addMinutes(10) <= $now) {
                        $message = sprintf(__('A despesa %s está vencendo hoje!'), h($expense->description));
                        $this->Flash->warning($message);
                        $expense = $this->Expenses->patchEntity($expense, ['last_notified' => $now]);
                        if (!$this->Expenses->save($expense)) {
                            $this->Flash->error(__('Não foi possível atualizar a despesa.'));
                        }
                    }
                } else {
                    if ($lastNotified === null || $lastNotified->addMinutes(10) <= $now) {
                        $message = sprintf(__('A despesa %s está vencendo em breve!'), h($expense->description));
                        $this->Flash->warning($message);
                        $expense = $this->Expenses->patchEntity($expense, ['last_notified' => $now]);
                        if (!$this->Expenses->save($expense)) {
                            $this->Flash->error(__('Não foi possível atualizar a despesa.'));
                        }
                    }
                }
            }
        }
    }


    public function convertCurrencyFields(array $data, array $fields)
    {
        foreach ($fields as $field) {
            if (!empty($data[$field])) {
                $data[$field] = preg_replace('/\./', '', $data[$field]);
                $data[$field] = str_replace(',', '.', $data[$field]);
                $data[$field] = (float) $data[$field];
            }
        }
        return $data;
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');

        $current_user = $this->Auth->user();
        $this->set('current_user', $current_user);
    }
}
