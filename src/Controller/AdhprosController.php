<?php
// src/Controller/AdhsController.php

namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;

class AdhprosController extends AppController
{

    private $list_payment_type = array("Florains", "Chèques", "Espèces", "HelloAsso");
    private $list_keys = array(
        "adh_id" => "Id",
        "adh_years" => "Année.s d'adh",
        "date_adh" => "Date d'adh",
        "orga_name" => "Nom de l'orga",
        "orga_contact" => "Contact",
        "email" => "Email",
        "address" => "Adresse",
        "postcode" => "CP",
        "city" => "Ville",
        "phonenumber" => "Tel",
        "amount" => "Montant",
        "payment_type" => "Paiement",
        "cyclos_account" => "Cyclos",
        "invoice" => "Facture",
        "newsletter" => "NL",
        "annuaire" => "Annuaire"
    );

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

    public function index($trasharg="trash:false")
    {
        $this->loadComponent('Paginator');
        $order = $this->request->getQuery('orderby') ?? "adh_id";
        //$sort = isset($this->request->getQuery('sort')) ? $this->request->getQuery('sort') : "ASC";
        $sort = $this->request->getQuery('sort') ?? "ASC";
        $nbitems_trashed = $this->Adhpros->find()->where(['deleted' => 1])->all()->count();
        $nbitems = $this->Adhpros->find()->where(['deleted' => 0])->all()->count();
        if ($trasharg == "trash:true") {
            $this->set('trash_view', true);
            $adhpros = $this->Paginator->paginate($this->Adhpros->find()->where(['deleted' => 1])->order([$order => $sort]));
        } else {
            $this->set('trash_view', false);
            $adhpros = $this->Paginator->paginate($this->Adhpros->find()->where(['deleted' => 0])->order([$order => $sort]));
        }
        $this->set('nbitems_trashed', $nbitems_trashed);
        $this->set('nbitems', $nbitems);
        $this->set(compact('adhpros'));
    }

    public function indexAjax($trasharg="trash:false", $strarg="", $yearsarg="")
    {
        $str = explode(":", $strarg);
        if (!isset($str[1])) {
            $str[1] = "";
        }
        $this->set('trash_view', "false");
        if ($trasharg == "trash:true") {
            $this->set('trash_view', "true");
            $filters = ['AND' => ['deleted' => 1]];
        }
        else {
            $this->set('trash_view', "false");
            $filters = ['AND' => ['deleted' => 0]];
        }
        $filters_str = ['OR' => [['orga_contact LIKE' => '%'.$str[1].'%'], [' orga_name LIKE' => '%'.$str[1].'%'], ['email LIKE' => '%'.$str[1].'%']]];
        $yearstr = explode(":", $yearsarg);
        if (!isset($yearstr[1])) {
            $yearstr[1] = "";
        } else {
            $filters_years = array();
            $list_years_adh = explode(";", $yearstr[1]);
            foreach ($list_years_adh as $year) {
                if ($year != "") {
                    $filters_years['OR'][] = ['adh_years LIKE' => '%'.$year.'%'];
                }
            }
        }
        $filters_and['AND'][] = $filters_str;
        $this->loadComponent('Paginator');
        $order = $this->request->getQuery('orderby') ?? "adh_id";
        
        $filters['AND'][] = $filters_years;
        $filters['AND'][] = $filters_str;
        //var_dump($filters);
        $sort = $this->request->getQuery('sort') ?? "ASC";
        $query = $this->Adhpros->find()->where($filters)->order([$order => $sort]);
        $nbitems = $this->Adhpros->find()->where($filters)->order([$order => $sort])->count();
        $this->set('nbitems', $nbitems);
        $adhpros = $this->Paginator->paginate($query);
        $this->set(compact('adhpros'));
        $this->viewBuilder()->setLayout('ajax');
    }

    public function add()
    {
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
            } else {
                $data["newsletter"] = False;
            }
            if (isset($data["invoice"])) {
                if ($data["invoice"] == "on") {
                    $data["invoice"] = True;
                } else {
                    $data["invoice"] = False;
                }
            } else {
                $data["invoice"] = False;
            }
            if (isset($data["annuaire"])) {
                if ($data["annuaire"] == "on") {
                    $data["annuaire"] = True;
                } else {
                    $data["annuaire"] = False;
                }
            } else {
                $data["annuaire"] = False;
            }
            if (isset($data["cyclos_account"])) {
                if ($data["cyclos_account"] == "on") {
                    $data["cyclos_account"] = True;
                } else {
                    $data["cyclos_account"] = False;
                }
            } else {
                $data["cyclos_account"] = False;
            }
            $data["date_adh"] = $data["date_adh"]."00:00:00";
            $adh = $this->Adhpros->patchEntity($adhpro, $data);
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été ajouté.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $errors = $adh->getErrors();
                if (isset($errors["status"])) {
                    $err = array_values($errors["status"])[0];
                    if (isset($err)) {
                        $this->Flash->error(__('Erreur : '.$err));
                    } else {
                        $this->Flash->error(__('Erreur : Impossible d\'ajouter l\'adhérent.'));
                    } 
                } else {
                    $this->Flash->error(__('Erreur : Impossible d\'ajouter l\'adhérent.'));
                }
                //return $this->redirect('/adhs/index');
            }
        }
    }

    public function edit($id)
    {
        $adhpro = $this->Adhpros->get($id);
        $this->set(compact('adhpro'));
        $this->set('list_payment_type', $this->list_payment_type);
        //var_dump($adhpro);
        if ($this->request->is('post')) {
            //var_dump($this->request->getData());
            //$adhpro = $this->Adhpros->newEmptyEntity();
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
            if (isset($data["invoice"])) {
                if ($data["invoice"] == "on") {
                    $data["invoice"] = True;
                } else {
                    $data["invoice"] = False;
                }
            } else {
                $data["invoice"] = False;
            }
            if (isset($data["annuaire"])) {
                if ($data["annuaire"] == "on") {
                    $data["annuaire"] = True;
                } else {
                    $data["annuaire"] = False;
                }
            } else {
                $data["annuaire"] = False;
            }
            if (isset($data["cyclos_account"])) {
                if ($data["cyclos_account"] == "on") {
                    $data["cyclos_account"] = True;
                } else {
                    $data["cyclos_account"] = False;
                }
            } else {
                $data["cyclos_account"] = False;
            }
            $data["date_adh"] = $data["date_adh"]."00:00:00";
            $adhpro = $this->Adhpros->patchEntity($adhpro, $data);
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur : Impossible de modifier l\'adhérent.'));
                return $this->redirect('/adhpros/index');
            }
        }
    }

    public function applyYears($id, $years)
    {
        $adhpro = $this->Adhpros->get($id);
        $yeararr1 = explode(";", $adhpro["adh_years"]);
        $yeararr2 = explode(";", $years);
        $tmp = "";
        $arr = array_filter(array_unique(array_merge($yeararr1, $yeararr2)));
        foreach ($arr as $adh_year) {
            $tmp=$tmp.$adh_year.";";
        }
        $adhpro["adh_years"] = $tmp;
        if ($this->Adhpros->save($adhpro)) {
            $this->Flash->success(__('L\'adhérent a été modifié.'));
            //return $this->redirect('/adhs/index');
        }
        //$this->viewBuilder()->setLayout('ajax');
    }

    public function delete($id) {
        $adhpro = $this->Adhpros->get($id);
        if ($adhpro['deleted'] == 1) {
            $result = $this->Adhpros->delete($adhpro);
            $this->Flash->success(__('L\'adhérent a été effacé.'));
            return $this->redirect('/adhpros/index/trash:true');
        } else {
            $adhpro['deleted'] = 1;
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été effacé.'));
                return $this->redirect('/adhpros/index');
            } else {
                $this->Flash->error(__('Erreur : Impossible d\'effacer l\'adhérent.'));
                return $this->redirect('/adhpros/index');
            }
        }
    }

    public function restore($id)
    {
        $adhpro = $this->Adhpros->get($id);
        if ($adhpro['deleted'] == 1) {
            $adhpro['deleted'] = 0;
            if ($this->Adhpros->save($adhpro)) {
                $this->Flash->success(__('L\'adhérent a été restauré.'));
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
                        //var_dump($data);
                        if ($data != FALSE) {
                            $adhpro = $this->Adhpros->newEmptyEntity();
                            $data["date_adh"] = $data["date_adh"]."00:00:00";
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
        $now = FrozenTime::now();
        $strfile = $now->format('Y-m-d').'_export_pros.csv';
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
        //$file->write("adh_id,date_adh,orga_name,orga_contact,email,address,postcode,city,phonenumber,asso,amount,payment_type,invoice,newsletter,annuaire\n");
        //$exportCSV=$exportCSV."adh_id,date_adh,orga_name,orga_contact,email,address,postcode,city,phonenumber,asso,amount,payment_type,invoice,newsletter,annuaire\n";
        foreach ($users as $user) {
            if ($user->date_adh != null) {
                $datestr = $user->date_adh->format('Y-m-d');
            } else {
                $datestr="";
            }
            $infos=$user->adh_id.",".$user->adh_years.",".$datestr.",".$user->orga_name.",".$user->orga_contact.",".$user->email.",".$user->address.",".$user->postcode.",".$user->city.",".$user->phonenumber.",".$user->amount.",".$user->payment_type.",".$user->cyclos_account.",".$user->invoice.",".$user->newsletter.",".$user->annuaire."\n";
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