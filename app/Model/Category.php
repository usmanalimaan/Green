<?php
class Category extends AppModel {
    
    var $name = 'Category'; 
    // public $actsAs = array('Acl' => array('requester'));
    public $useTable = 'oc_product_to_category';
    // example_id is the field name in the database
    public $primaryKey = 'product_id';

}

?>