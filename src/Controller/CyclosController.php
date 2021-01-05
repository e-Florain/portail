<?php
// src/Controller/AdhsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;

class CyclosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        if (isset($_SESSION["Auth"])) {
            if ($_SESSION["Auth"]->role == 'root') {
                $this->Auth->allow();
            } elseif ($_SESSION["Auth"]->role == 'admin') {
                $this->Auth->allow();
            } else {
                $this->Auth->allow(['index']);
            }
        }
    }

    public function index()
    {   
        $path = "../../cyclos-python/json";
        $dir = new Folder($path);
        $filesadhpros = array_reverse($dir->find('.*adhpros-changes\.json',true));
        $this->set(compact('filesadhpros'));
        $filesadhs = array_reverse($dir->find('.*adhs-changes\.json',true));
        $this->set(compact('filesadhs'));
    }

    public function seechanges($type)
    {
        if ($this->request->is('post')) {            
            $data = $this->request->getData();
            $filename=$data["filename".$type];
            $path = "../../cyclos-python/json" . DS . $filename;
            $file = new File($path);
            $contents = $file->read();
            $infos = json_decode($contents, JSON_OBJECT_AS_ARRAY);
            $this->set(compact('infos'));
            $this->set(compact('filename'));
        }
    }

    public function checkchanges($type)
    {
        $output = shell_exec('python3 /home/www/cyclos-python/sync.py -simulate --'.$type);
        $this->set(compact('output'));
        $this->viewBuilder()->setLayout('ajax');
    }

    public function applychanges($jsonfile)
    {
        $output = shell_exec('python3 /home/www/cyclos-python/sync.py -apply '.$jsonfile);
        $this->set(compact('jsonfile'));
        $this->set(compact('output'));
    }

    public function spinner()
    {
        $this->viewBuilder()->setLayout('ajax');
    }
}