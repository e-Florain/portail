<?php
// src/Controller/AdhsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;

class AdhsController extends AppController
{
    private $list_payment_type = array("Florains", "Chèques", "Espèces", "HelloAsso");
    private $list_keys = array(
        "adh_id" => "Id",
        "adh_years" => "Année.s d'adh",
        "date_adh" => "Date d'adh",
        "lastname" => "Nom",
        "firstname" => "Prénom",
        "email" => "Email",
        "city" => "Ville",
        "phonenumber" => "Tel",
        "asso" => "Asso",
        "amount" => "Montant",
        "payment_type" => "Paiement",
        "newsletter" => "NL"
    );

    public function index()
    {
        $this->loadComponent('Paginator');
        $this->loadModel('Associations');
        $order = $this->request->getQuery('orderby') ?? "adh_id";
        //$sort = isset($this->request->getQuery('sort')) ? $this->request->getQuery('sort') : "ASC";
        $sort = $this->request->getQuery('sort') ?? "ASC";
        //var_dump($sort);
        $adhs = $this->Paginator->paginate($this->Adhs->find()->order([$order => $sort]));
        $this->set(compact('adhs'));
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        //$this->Flash->success(__('The adh has been saved.'));
       // echo "true ".$order;
    }

    public function add()
    {
        $this->loadModel('Associations');
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        $this->set('list_payment_type', $this->list_payment_type);
        if ($this->request->is('post')) {            
            //$adh = $this->Adhs->newEmptyEntity();
            $data = $this->request->getData();
            if (isset($data["newsletter"])) {
                if ($data["newsletter"] == "on") {
                    $data["newsletter"] = True;
                } else {
                    $data["newsletter"] = False;
                }
            } else {
                $data["newsletter"] = False;
            }
            /*foreach ($assos as $asso) {
                if ($data["asso"] == $asso["name"]) {
                    $data["asso_id"] = $asso["id"];
                }
            }*/
            $tmp = "";
            foreach ($data["adh_years"] as $adh_year) {
                $tmp=$tmp.$adh_year.";";
            }
            var_dump($tmp);
            $data["adh_years"] = $tmp;
            $data["date_adh"] = $data["date_adh"]."00:00:00";
            $adh = $this->Adhs->newEntity($this->request->getData());
            if ($adh->getErrors()) {
                var_dump($adh->getErrors());
            } else {
                $adh = $this->Adhs->patchEntity($adh, $data);
                if ($this->Adhs->save($adh)) {
                    $this->Flash->success(__('The adh has been saved.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    $this->Flash->error(__('Unable to add the adh.'));
                    //return $this->redirect('/adhs/index');
                }
            }
        }
    }

    public function edit($id)
    {
        $this->loadModel('Associations');
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        $adh = $this->Adhs->get($id);
        //var_dump($adh);
        $this->set(compact('adh'));
        $this->set('list_payment_type', $this->list_payment_type);
        if ($this->request->is('post')) {
            //var_dump($this->request->getData());
            $adh = $this->Adhs->newEmptyEntity();
            $data = $this->request->getData();
            //var_dump($data);
            if (isset($data["newsletter"])) {
                if ($data["newsletter"] == "on") {
                    $data["newsletter"] = True;
                } else {
                    $data["newsletter"] = False;
                }
            }
            $tmp = "";
            foreach ($data["adh_years"] as $adh_year) {
                $tmp=$tmp.$adh_year.";";
            }
            $data["adh_years"] = $tmp;
            $adh = $this->Adhs->patchEntity($adh, $data);
            if ($this->Adhs->save($adh)) {
                $this->Flash->success(__('The adh has been modified.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add the adh.'));
                return $this->redirect('/adhs/index');
            }
        }
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
                //var_dump($keys);
                for ($i=1;$i<count($infos);$i++) {
                    $datacsv = str_getcsv($infos[$i]);
                    //var_dump($datacsv);
                    //echo "<br>";
                    //echo count($keys)." ".count($datacsv);
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
        $now = FrozenTime::now();
        $strfile = $now->format('Y-m-d').'_export_particuliers.csv';
        $users = $this->Adhs->find();
        $file = new File($strfile, true, 0644);
        $exportCSV="";
        $i=0;
        foreach($this->list_keys as $key=>$keyname) {
            if ($i==(count($this->list_keys)-1)) {
                $exportCSV=$exportCSV.$key;
            } else {
                $exportCSV=$exportCSV.$key.",";
            }
            $i++;
        }
        $exportCSV=$exportCSV."\n";
        $file->write($exportCSV);
        foreach ($users as $user) {
            if ($user->date_adh != null) {
                $datestr = $user->date_adh->format('Y-m-d');
            } else {
                $datestr="";
            }
            $infos=$user->adh_id.",".$user->adh_years.",".$datestr.",".$user->lastname.",".$user->firstname.",".$user->email.",".$user->city.",".$user->phonenumber.",".$user->asso.",".$user->amount.",".$user->payment_type.",".$user->newsletter."\n";
            $exportCSV=$exportCSV.$infos;
            $file->append($infos);
        }
        $path = $file->path;
        $file->close();
        
        $response = $this->response->withFile(
            $path = $file->path,
            ['download' => true, 'name' => $strfile]
        );
        return $response;
    }
}
?>