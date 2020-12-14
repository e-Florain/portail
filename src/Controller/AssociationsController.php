<?php
// src/Controller/AssociationsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class AssociationsController extends AppController
{
    private $list_keys = array(
        "id" => "Id",
        "name" => "Nom",
        "activite" => "Activité"
    );

    public function index()
    {
        $this->loadComponent('Paginator');
        $order = $this->request->getQuery('orderby') ?? "id";
        //$sort = isset($this->request->getQuery('sort')) ? $this->request->getQuery('sort') : "ASC";
        $sort = $this->request->getQuery('sort') ?? "ASC";
        //var_dump($sort);
        $assos = $this->Paginator->paginate($this->Associations->find()->order([$order => $sort]));
        //var_dump($assos);
        $this->set(compact('assos'));
        
        //$this->Flash->success(__('The adh has been saved.'));
       // echo "true ".$order;
    }

    public function add()
    {
        if ($this->request->is('post')) {            
            $asso = $this->Associations->newEmptyEntity();
            $data = $this->request->getData();
            $asso = $this->Associations->patchEntity($asso, $data);
            if ($this->Associations->save($asso)) {
                $this->Flash->success(__('The association has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('Unable to add the association.'));
                return $this->redirect('/associations/index');
            } 
        }
    }

    public function edit($id)
    {
        $asso = $this->Associations->get($id);
        //var_dump($adh);
        $this->set(compact('asso'));
        if ($this->request->is('post')) {
            //var_dump($this->request->getData());
            $asso = $this->Associations->newEmptyEntity();
            $data = $this->request->getData();
            //var_dump($data);
            $asso = $this->Associations->patchEntity($asso, $data);
            if ($this->Associations->save($asso)) {
                $this->Flash->success(__('The association has been modified.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add the association.'));
                return $this->redirect('/associations/index');
            }
        }
    }

    public function delete($id)
    {
        $asso = $this->Associations->get($id);
        $result = $this->Associations->delete($asso);
        $this->Flash->success(__('The association has been deleted.'));
        return $this->redirect('/associations/index');
    }

    public function search()
    {
        $assos = $this->Associations->find()->all();

        $this->set(compact('assos'));
        //$this->viewBuilder()->setOption('serialize', 'assos');
        $this->viewBuilder()->setLayout('ajax');
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($assos));

    }

    public function importexport()
    {

    }

    public function import()
    {
        $uploadDatas = array();
        if ($this->request->is('post')) {
            $data = $this->request->getData()["uploadfile"];
            
            if(!empty($data)){
                $fileName = $data->getClientFilename();
                //var_dump($fileName);
                $stream = $data->getStream();
                $infos = explode("\n", $stream);
                $data = array();
                $i=0;
                $keys = str_getcsv($infos[0]);
                //var_dump($infos);
                for ($i=1;$i<count($infos);$i++) {
                    $datacsv = str_getcsv($infos[$i]);
                    if (count($keys) == count($datacsv)) {
                        $data = array_combine($keys, $datacsv); 
                        if ($data != FALSE) {
                            $adh = $this->Adhs->newEmptyEntity();
                            $adh = $this->Adhs->patchEntity($adh, $data);
                            //var_dump($adh);
                            if ($this->Adhs->save($adh)) {
                                $data['imported'] = 1;
                                $data['msgerr'] = '';
                            } else {
                                $errors = $adh->getErrors()["status"];
                                $data['msgerr'] = array_shift($errors);
                                $data['imported'] = 0;
                            }
                            $uploadDatas[] = $data;
                        }
                    }
                }

                $this->set('list_keys', $this->list_keys);
                $this->set(compact('uploadDatas'));
            }else{
                $this->Flash->error(__('Unable to upload file, please try again.'));
            }
        }
    }

    public function export()
    {
        $assos = $this->Associations->find();
        $file = new File('export.csv', true, 0644);
        $exportCSV="";

        foreach($this->list_keys as $key=>$keyname) {
            $exportCSV=$exportCSV.$key.",";
        }
        $exportCSV=$exportCSV."\n";
        $file->write($exportCSV);
        foreach ($assos as $asso) {
            $infos=$asso->id.",".$asso->name.",".$asso->activite."\n";
            $exportCSV=$exportCSV.$infos;
            $file->append($infos);
        }
        $path = $file->path;
        $file->close();
        
        $response = $this->response->withFile(
            $path = $file->path,
            ['download' => true, 'name' => 'export.csv']
        );
        return $response;
    }

}
?>