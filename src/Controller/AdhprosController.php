<?php
// src/Controller/AdhsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class AdhprosController extends AppController
{

    private $list_payment_type = array("Florains", "Chèques", "Espèces", "HelloAsso");
    private $list_keys = array(
        "adh_id" => "Id",
        "date_adh" => "Date d'adh",
        "orga_name" => "Nom de l'orga",
        "orga_contact" => "Contact",
        "email" => "Email",
        "address" => "Adresse",
        "postcode" => "CP",
        "city" => "Ville",
        "phonenumber" => "Tel",
        "asso" => "Asso",
        "amount" => "Montant",
        "payment_type" => "Paiement",
        "invoice" => "Facture",
        "newsletter" => "NL",
        "annuaire" => "Annuaire"
    );

    public function index()
    {
        $this->loadModel('Associations');
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        $this->loadComponent('Paginator');
        $order = $this->request->getQuery('orderby') ?? "adh_id";
        //$sort = isset($this->request->getQuery('sort')) ? $this->request->getQuery('sort') : "ASC";
        $sort = $this->request->getQuery('sort') ?? "ASC";
        //var_dump($sort);
        $adhpros = $this->Paginator->paginate($this->Adhpros->find()->order([$order => $sort]));
        $this->set(compact('adhpros'));
    }

    public function add()
    {
        $this->loadModel('Associations');
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        $this->set('list_payment_type', $this->list_payment_type);
        if ($this->request->is('post')) {            
            $adhpro = $this->Adhpros->newEmptyEntity();
            $data = $this->request->getData();
            var_dump($data);
            if (isset($data["newsletter"])) {
                if ($data["newsletter"] == "on") {
                    $data["newsletter"] = True;
                } else {
                    $data["newsletter"] = False;
                }
            }
            if (isset($data["invoice"])) {
                if ($data["invoice"] == "on") {
                    $data["invoice"] = True;
                } else {
                    $data["invoice"] = False;
                }
            }
            if (isset($data["annuaire"])) {
                if ($data["annuaire"] == "on") {
                    $data["annuaire"] = True;
                } else {
                    $data["annuaire"] = False;
                }
            }
            $data["date_adh"] = $data["date_adh"]."00:00:00";
            $adh = $this->Adhpros->patchEntity($adhpro, $data);
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été ajouté.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('Erreur : Impossible d\'ajouter l\'adhérent.'));
                return $this->redirect('/adhs/index');
            } 
        }
    }

    public function edit($id)
    {
        $this->loadModel('Associations');
        $assos = $this->Associations->find();
        $this->set('assos', $assos);
        $adhpro = $this->Adhpros->get($id);
        $this->set(compact('adhpro'));
        $this->set('list_payment_type', $this->list_payment_type);
        //var_dump($adhpro);
        if ($this->request->is('post')) {
            var_dump($this->request->getData());
            $adhpro = $this->Adhpros->newEmptyEntity();
            $data = $this->request->getData();
            if (isset($data["newsletter"])) {
                if ($data["newsletter"] == "on") {
                    $data["newsletter"] = True;
                } else {
                    $data["newsletter"] = False;
                }
            }
            if (isset($data["invoice"])) {
                if ($data["invoice"] == "on") {
                    $data["invoice"] = True;
                } else {
                    $data["invoice"] = False;
                }
            }
            if (isset($data["annuaire"])) {
                if ($data["annuaire"] == "on") {
                    $data["annuaire"] = True;
                } else {
                    $data["annuaire"] = False;
                }
            }
            $adhpro = $this->Adhpros->patchEntity($adhpro, $data);
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été modifié.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('Erreur : Impossible de modifier l\'adhérent.'));
                return $this->redirect('/adhpros/index');
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
                for ($i=1;$i<count($infos);$i++) {
                    $datacsv = str_getcsv($infos[$i]);
                    if (count($keys) == count($datacsv)) {
                        $data = array_combine($keys, $datacsv); 
                        if ($data != FALSE) {
                            $adhpro = $this->Adhpros->newEmptyEntity();
                            $adhpro = $this->Adhpros->patchEntity($adhpro, $data);
                            //var_dump($adhpro);
                            if ($this->Adhpros->save($adhpro)) {
                                $data['imported'] = 1;
                                $data['msgerr'] = '';
                            } else {
                                $errors = $adhpro->getErrors()["status"];
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
        $users = $this->Adhpros->find();
        $file = new File('export.csv', true, 0644);
        $exportCSV="";

        foreach($this->list_keys as $key=>$keyname) {
            $exportCSV=$exportCSV.$key.",";
        }
        $exportCSV=$exportCSV."\n";
        $file->write($exportCSV);
        //$file->write("adh_id,date_adh,orga_name,orga_contact,email,address,postcode,city,phonenumber,asso,amount,payment_type,invoice,newsletter,annuaire\n");
        //$exportCSV=$exportCSV."adh_id,date_adh,orga_name,orga_contact,email,address,postcode,city,phonenumber,asso,amount,payment_type,invoice,newsletter,annuaire\n";
        foreach ($users as $user) {
            if ($user->date_adh != null) {
                $datestr = $user->date_adh->format('Y-m-d');
            } else {
                $datestr="";
            }
            $infos=$user->adh_id.",".$datestr.",".$user->orga_name.",".$user->orga_contact.",".$user->email.",".$user->address.",".$user->postcode.",".$user->city.",".$user->phonenumber.",".$user->asso.",".$user->amount.",".$user->payment_type.",".$user->invoice.",".$user->newsletter.",".$user->annuaire."\n";
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