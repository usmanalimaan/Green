<?php
class productStore extends AppModel {
    
    var $name = 'productStore'; 
    // public $actsAs = array('Acl' => array('requester'));
    public $useTable = 'oc_product_to_store';
    // example_id is the field name in the database
    public $primaryKey = 'product_id';

}

?>