<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CreditCardsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('credit_cards');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('operator')
            ->maxLength('operator', 50)
            ->requirePresence('operator', 'create')
            ->notEmptyString('operator');

        $validator
            ->decimal('credit_limit')
            ->requirePresence('credit_limit', 'create')
            ->notEmptyString('credit_limit');

        $validator
            ->decimal('limit_utility')
            ->requirePresence('limit_utility', 'create')
            ->notEmptyString('limit_utility');
            
        return $validator;
    }
}