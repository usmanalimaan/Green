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
                    //echo "before:".$file['name'][$i];
                    $name = uniqid().".".$name[1];
                    //echo "after:".$name;

                    $ext = substr(strtolower(strrchr($name, '.')), 1); //get the extension
                    $arr_ext = array('csv');  //set allowed extensions
                    //only process if the extension is valid
                    

                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . '/attachments/csvimports/' . $name);
                        //prepare the filename for database entry
                // debug(move_uploaded_file($file['tmp_name'], WWW_ROOT . '/attachments/csvimports/' . $name));
                // exit();
                        


                        $fileOpen  = fopen( WWW_ROOT . '/attachments/csvimports/'. $name, "r");
                        $fileSize = filesize(WWW_ROOT . '/attachments/csvimports/'. $name);
                        $i = 0;
                        $product_id=0;


                        // $fileOpen = fopen( WWW_ROOT . '/attachments/csvimports/'. $name, "r");
                        // debug($fileOpen);
                        //         exit();

                        while (($data = fgetcsv($fileOpen, 10000000, ",")) !== FALSE) {
                            if($i>0) {
                                // $date=date("Y-m-d", strtotime($data[6]) );
                                // debug($data);
                                // exit();
                                $this->request->data['Csvimport']['image']=$data[3];
                                $this->request->data['Csvimport']['price']=$data[5];
                                $this->request->data['Csvimport']['status']='1';
                                $this->request->data['Csvimport']['quantity']='10000';
                                // exit;
                                //$import="INSERT into oc_product(image,price,status,quantity) values('$data[3]','$data[5]','1','10000')";
                                $this->Csvimport->create();
                                  $this->Csvimport->save($this->request->data);
                                  $product_id=$this->Csvimport->getLastInsertId();

                                  // debug($product_id);
                                  $import_discription="INSERT into oc_product_description(product_id,language_id,name,description,csvimport,deep_link) values('$product_id','1','$data[0]','$data[1]','1','$data[7]')";
                                  $cat_id=$this->request->data['Category']['category_id'];
                                  $import_pod_cat="INSERT into oc_product_to_category(product_id,category_id) values('$product_id','$cat_id')";
                                  $import_pod_stor="INSERT into oc_product_to_store(product_id,store_id) values('$product_id','0')";
                                  // $this->request->data['Category']['product_id']=$product_id;
                                // $this->Category->create();
                                  // debug($this->Category->save($this->request->date));
                                  $this->ProductDiscription->query($import_discription);
                                  $this->Category->query($import_pod_cat);
                                  $this->productStore->query($import_pod_stor);

                                // debug($this->request->data);
                                // exit();
                                  // $this->request->data['Category']['product_id']=$product_id;

                                // debug($import_discription);
                                // exit;
                            }
                            $i++;
                        }
                        // $fileOpen->delete();
                        fclose($fileOpen);
                        $file = new File($this->webroot."attachments/csvimports/".$name,false, 0777);
                        $file->delete();
                        // ($this->webroot."attachments/csvimports/".$name).delete();
                        // debug($i);
                        // exit();
                       $message = "Data of $i products uploaded !";
                       $this->Session->setFlash($message, 'success_flesh', array(), 'successfully');
            } else {
                
                $message = 'The Csv File could not be Uploaded. Please, try again.';
                $this->set('message',$message);
                $this->Session->setFlash($message, 'error_flesh', array(), 'error');

            }
        }
    }

    public function download(){

        $this->loadModel('Csvimport');
        $this->response->file(WWW_ROOT.'/attachments/csvimports/sample.csv', array(
            'download' => true, 
            'name' => 'sample.csv'
        ));
        return $this->response;
    }
    public function csvdell(){
        $this->loadModel('ProductDiscription');    
        $this->autoRender=false;
        $deleteAllProductsByCSV="DELETE FROM oc_product, oc_product_description,oc_product_to_category
 USING oc_product_description INNER JOIN oc_product ON 'oc_product_description.product_id' = 'oc_product.product_id' INNER JOIN oc_product_to_category ON 'oc_product_description.product_id' = 'oc_product_to_category.product_id' WHERE 'oc_product_description.csvimport'= '1'
";
        if($this->ProductDiscription->query($deleteAllProductsByCSV))
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
    
}  

?>