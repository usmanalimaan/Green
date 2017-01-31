<?php
App::uses('File', 'Utility');
class CsvimportsController extends AppController {

    var $name = 'Csvimports';
    public function import(){

        $this->loadModel('ProductDiscription');    
        $this->loadModel('CategoryDescription');    
        $this->loadModel('Category');    
        $this->loadModel('productStore');    
        // $this->loadModel('Customer');
        $someinfo=$this->CategoryDescription->find('all');
        $this->set('someinfo',$someinfo);
        // debug($someinfo);
        // exit();

        if ($this->request->is('post', 'put')) {
            if (!empty($this->request->data)) {
                // debug($this->request->data);
                // exit();
                $fields;
                $file = $this->request->data['Csvimport']['file_name'];
                $name = explode(".", $file['name']);
                $name = uniqid().".".$name[1];
                    $ext = substr(strtolower(strrchr($name, '.')), 1); //get the extension
                    $arr_ext = array('csv');  //set allowed extensions
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . '/attachments/csvimports/' . $name);
                        //prepare the filename for database entry
                // debug(move_uploaded_file($file['tmp_name'], WWW_ROOT . '/attachments/csvimports/' . $name));
                // exit();



                    $fileOpen  = fopen( WWW_ROOT . '/attachments/csvimports/'. $name, "r");
                    $fileSize = filesize(WWW_ROOT . '/attachments/csvimports/'. $name);
                    $i = 0;
                    $product_id=0;

                    while (($data = fgetcsv($fileOpen, 10000000, ",")) !== FALSE) {
                        if($i>0) {
                                // $date=date("Y-m-d", strtotime($data[6]) );
                                // debug($data);
                                // exit();
                            $this->request->data['Csvimport']['image']=$data[3];
                            $this->request->data['Csvimport']['price']=$data[5];
                            $this->request->data['Csvimport']['status']='1';
                            $this->request->data['Csvimport']['quantity']='10000';
                            $this->Csvimport->create();
                            $this->Csvimport->save($this->request->data);
                            $product_id=$this->Csvimport->getLastInsertId();
                            $import_discription="INSERT into oc_product_description(product_id,language_id,name,description,csvimport,deep_link) values('$product_id','1','$data[0]','$data[1]','1','$data[7]')";
                            $cat_id=$this->request->data['Category']['category_id'];
                            $import_pod_cat="INSERT into oc_product_to_category(product_id,category_id) values('$product_id','$cat_id')";
                            $this->ProductDiscription->query($import_discription);
                            $this->Category->query($import_pod_cat);
                        }
                        $i++;
                    }
                    fclose($fileOpen);
                    unlink(WWW_ROOT . '/attachments/csvimports/'. $name);
                    $message = "Data of $i products uploaded !";
                    $this->Session->setFlash($message, 'success_flesh', array(), 'successfully');
                } else {

                    $message = 'The Csv File could not be Uploaded. Please, try again.';
                    $this->set('message',$message);
                    $this->Session->setFlash($message, 'error_flesh', array(), 'error');

                }
            }
        }
        public function csvdell(){
            $this->autoRender=false;
            $deleteAllProductsByCSV="";
            $this->loadModel('ProductDiscription');    
            $deleteAllProductsByCSV="DELETE FROM p,pd,pc using  oc_product_description as pd 
            inner join oc_product as p on pd.product_id=p.product_id
            inner join oc_product_to_category as pc on pd.product_id=pc.product_id
            WHERE pd.csvimport= 1
            ";
            if(is_array($this->ProductDiscription->query($deleteAllProductsByCSV)) or ($this->ProductDiscription->query($deleteAllProductsByCSV)))
            {
                $message = 'The whole previous data uploaded by Csvimport is deleted now';
                $this->Session->setFlash($message, 'success_flesh', array(), 'successfully');
            }
            else{
                $message='The whole previous data uploaded by Csvimport is not deleted! Please try again';
                $this->Session->setFlash($message, 'error_flesh', array(), 'error');
            }
            $this->redirect(array('action'=>'import'));
        }

        public function dellcat()
        {
            $data='';

            $this->loadModel('CategoryDescription');
            $cd=$this->CategoryDescription->find('all');
        // debug($cd);
            foreach ($cd as $key => $value) {
                $data[$key]['0']=$value['CategoryDescription']['category_id'];
                $data[$key]['1']=$value['CategoryDescription']['name'];
                $cat_id=$value['CategoryDescription']['category_id'];
                $Csvimport_products="select * FROM oc_product_description as pd inner join oc_product as p on pd.product_id=p.product_id inner join oc_product_to_category as pc on pd.product_id=pc.product_id WHERE pd.csvimport= 1 AND pc.category_id=$cat_id
                ";
                $data[$key]['2']= count($this->CategoryDescription->query($Csvimport_products));
                $Vender_Products="select * from oc_product_to_category where oc_product_to_category.category_id=$cat_id
                ";
                $data[$key]['3']= count($this->CategoryDescription->query($Vender_Products));
            }
        // debug($data);
        // exit();
            $this->set('categories',$data);
        // debug($this->CategoryDescription->query($category_products));
        }
        public function delete($id=null)
        {

            $this->loadModel('CategoryDescription');
            $this->autoRender=false;
            $dell_product_wrt_cat="DELETE FROM p,pd,pc using  oc_product_description as pd 
            inner join oc_product as p on pd.product_id=p.product_id
            inner join oc_product_to_category as pc on pd.product_id=pc.product_id
            WHERE pd.csvimport= 1 and pc.category_id=$id";
            debug($this->CategoryDescription->query($dell_product_wrt_cat));
            if(is_array($this->CategoryDescription->query($dell_product_wrt_cat)) or ($this->CategoryDescription->query($dell_product_wrt_cat)))
            {
                $message = 'Data uploaded by Csvimport is deleted now';
                $this->Session->setFlash($message, 'success_flesh', array(), 'successfully');
            }
            else{
                $message='Data uploaded by Csvimport is not deleted! Please try again';
                $this->Session->setFlash($message, 'error_flesh', array(), 'error');
            }
            $this->redirect(array('action'=>'dellcat'));
        }
    }  

    ?>