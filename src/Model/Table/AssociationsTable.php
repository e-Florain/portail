<?php
// src/Model/Table/AssociationsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;

class AssociationsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id']), [
            'errorField' => 'status',
            'message' => 'L\'id doit être unique'
        ]);
        return $rules;
    }
}
?>