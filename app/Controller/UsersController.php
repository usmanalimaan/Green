<?php

class UsersController extends AppController
{
	function beforeFilter() {
    parent::beforeFilter();
        $this->layout = 'index';
  }
	public function index() {
		$Users=$this->User->find('all');
		// debug($Users);
		$this->set('Users',$Users);
		if ($this->request->is('post')) {
            $this->User->create();
            $this->User->save($this->request->data);
         
		
	}
}
	public function add() {
		if ($this->request->is('post')) {
            $this->User->create();
            $this->User->save($this->request->data);
            // if ($this->User->save($this->request->data)) {
            //     $this->Session->setFlash(__('The user has been created'));
            //      $this->redirect(array('action' => 'index'));
            // } else {
            //     $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            // }   
        }

		
	}

}