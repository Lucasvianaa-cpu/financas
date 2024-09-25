<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{

    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'created_at' => true,
        'categories' => true,
        'credit_cards' => true,
        'expenses' => true,
        'receives' => true,
        'shopping_cards' => true,
    ];

    protected $_hidden = [
        'password',
    ];
}
