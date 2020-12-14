<?php
// src/Model/Entity/Association.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Association extends Entity
{
    protected $_accessible = [
        '*' => true
        //'id' => false
    ];
}
?>