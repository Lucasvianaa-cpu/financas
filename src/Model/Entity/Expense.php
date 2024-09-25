<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Expense extends Entity
{
    protected $_accessible = [
        'description' => true,
        'value' => true,
        'date_maturity' => true,
        'status' => true,
        'last_notified' => true,
        'category_id' => true,
        'user_id' => true,
        'category' => true,
        'user' => true,
    ];
}
