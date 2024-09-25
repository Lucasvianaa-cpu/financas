<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ShoppingCardsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('shopping_cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CreditCards', [
            'foreignKey' => 'credit_card_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('date_shopping')
            ->requirePresence('date_shopping', 'create')
            ->notEmptyDate('date_shopping');

        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->boolean('is_parcel')
            ->notEmptyString('is_parcel');

        $validator
            ->integer('parcel_number')
            ->allowEmptyString('parcel_number');


        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }


    public function afterSave($event, $entity, $options)
    {
        if (!empty($entity->credit_card_id)) {
            $creditCard = $this->CreditCards->get($entity->credit_card_id);

            if ($entity->isNew()) {

                $creditCard->limit_utility += floatval($entity->value_total);
                $this->CreditCards->save($creditCard);
            } else {

                $oldCreditCardId = $entity->getOriginal('credit_card_id');
                $oldValueTotal = $entity->getOriginal('value_total');

                if ($oldCreditCardId && $oldCreditCardId != $entity->credit_card_id) {
                    $oldCreditCard = $this->CreditCards->get($oldCreditCardId);
                    $oldCreditCard->limit_utility -= $oldValueTotal;

                    if ($this->CreditCards->save($oldCreditCard)) {
                    } else {
                    };
                }

                $creditCard->limit_utility += $entity->value_total;
                $this->CreditCards->save($creditCard);
            }
        }
    }

    public function afterDelete($event, $entity, $options)
    {
        if (!empty($entity->credit_card_id)) {
            $creditCard = $this->CreditCards->get($entity->credit_card_id);

            $creditCard->limit_utility -= floatval($entity->value_total);
            $this->CreditCards->save($creditCard);
        }
    }
    
}
