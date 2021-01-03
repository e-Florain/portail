<?php
// src/Controller/AdhsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;

class CyclosController extends AppController
{
    public function index()
    {   
        $path = "../../cyclos-python/json";
        $dir = new Folder($path);
        $files = array_reverse($dir->find('.*\.json',true));
        $this->set(compact('files'));
    }

    public function seechanges()
    {
        if ($this->request->is('post')) {            
            $data = $this->request->getData();
            $filename=$data["filename"];
            $path = "../../cyclos-python/json" . DS . $filename;
            $file = new File($path);
            $contents = $file->read();
            $infos = json_decode($contents, JSON_OBJECT_AS_ARRAY);
            $this->set(compact('infos'));
            $this->set(compact('filename'));
        }
    }

    public function checkchanges()
    {
        $output = shell_exec('python3 /home/www/cyclos-python/sync.py -simulate');
        echo "<pre>$output</pre>";
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