<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;


class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->hasMany('Categories', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('CreditCards', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Expenses', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Receives', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('ShoppingCards', [
            'foreignKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }

     public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !empty($entity->password)) {
            $hasher = new DefaultPasswordHasher();
            $entity->password = $hasher->hash($entity->password);
        }
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
