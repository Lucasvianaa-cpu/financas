<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class CreditCard extends Entity
{

    protected $_accessible = [
        'name' => true,
        'operator' => true,
        'credit_limit' => true,
        'limit_utility' => true,
        'user_id' => true,
        'user' => true,
    ];
}
