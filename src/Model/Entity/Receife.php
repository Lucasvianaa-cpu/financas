<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class Receife extends Entity
{

    protected $_accessible = [
        'description' => true,
        'value' => true,
        'date_receive' => true,
        'status' => true,
        'is_recurring' => true,
        'category_id' => true,
        'user_id' => true,
        'category' => true,
        'user' => true,
    ];
}
