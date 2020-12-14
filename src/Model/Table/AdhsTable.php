<?php
// src/Model/Table/AdhsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;

class AdhsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        //$rules->add($rules->isUnique(['email']));
        //$rules->add($rules->isUnique(['adh_id']));
        $rules->add($rules->isUnique(['email']), [
            'errorField' => 'status',
            'message' => 'L\'email doit être unique'
        ]);
        $rules->add($rules->isUnique(['adh_id']), [
            'errorField' => 'status',
            'message' => 'L\'id doit être unique'
        ]);
        return $rules;
    }
    
}
?>