<?php
class Csvimport extends AppModel {
    
    var $name = 'Csvimport'; 
    // public $actsAs = array('Acl' => array('requester'));
    public $useTable = 'oc_product';
    // example_id is the field name in the database
    public $primaryKey = 'product_id';

    // public function parentNode() {
    //     return null;
    // }
    // public $belongsTo = array(
    //     'User' => array(
    //         'className' => 'User',
    //         'foreignKey' => 'created_user_id'
    //     ),
    //     'ModifiedUser' => array(
    //         'className' => 'User',
    //         'foreignKey' => 'modified_user_id'
    //     )
    // );
}

?>