<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity
{

    protected $_accessible = [
        'name' => true,
        'is_active' => true,
        'is_pay' => true,
        'is_receive' => true,
        'user_id' => true,
        'user' => true,
        'expenses' => true,
        'receives' => true,
    ];
}
