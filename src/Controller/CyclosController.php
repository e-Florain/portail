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
        $file = "changes.json";
        $path = "../../cyclos-python/json" . DS . $file;
        $file = new File($path);
        $contents = $file->read();
        $infos = json_decode($contents, JSON_OBJECT_AS_ARRAY);
        //var_dump($infos);
        /*foreach($infos as $info) {
            var_dump($info);
        }*/
        $this->set(compact('infos'));

    }
}