<?php
class CategoryDescription extends AppModel {
    
    var $name = 'CategoryDescription'; 
    // public $actsAs = array('Acl' => array('requester'));
    public $useTable = 'oc_category_description';
    // example_id is the field name in the database
    public $primaryKey = 'category_id';

}

?>