<?php
// src/Model/Table/AssociationsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AssociationsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
}
?>