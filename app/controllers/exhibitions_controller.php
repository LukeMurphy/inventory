<?php
class ExhibitionsController extends AppController {

	var $name = 'Exhibitions';
	var $helpers = array('Html', 'Form','Paginator');
	var $userObject = array();
	var $permissions = array('guest');
	//var $paginate =  array('limit' => 500, 'order' => array('Work.date_year') );
	//var $scaffold;
	//var $components = array('Upload');
	//var $components = array('Attachment');

	/**
	 * Before any Controller action
	 */
	function beforeFilter()
	{

		$this->set('user',$this->userObject);
			
		if( !$this->Session->check('User') ) {
			$this->redirect('/users/login');
		} else {
			// save user data
			$this->userObject = $this->Session->read('User');
			$this->set('user',$this->userObject);
			$this->permissions = array('viewer');

			if($this->userObject['User']['group'] == "editor") {
				$this->permissions = array("editor");
			}
			if($this->userObject['User']['group'] == "admin"){
				$this->permissions = array("editor","admin");
			}
		}

		$this->set('permissions',$this->permissions);
		/*
		 print_r($this->Session);
		 print_r($this->Session->read('User'));
		 echo "<hr>";
		 var_dump($this->permissions);
		 */
	}
	
	function index() {
		$this->Exhibition->recursive = 0;
		$this->set('exhibitions', $this->paginate());
	}

	function view($id = null) {
		Controller::loadModel("Image");
		$this->set('images', $this->Image->find("all"));
		$this->set('imagePath',IMAGE_PATH);
		if (!$id) {
			$this->flash(__('Invalid Exhibition', true), array('action' => 'index'));
		}
		$this->set('exhibition', $this->Exhibition->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Exhibition->create();
			if ($this->Exhibition->save($this->data)) {
				$this->flash(__('Exhibition saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$works = $this->Exhibition->Work->find('list');
		$this->set(compact('works'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Exhibition', true), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Exhibition->save($this->data)) {
				$this->flash(__('The Exhibition has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Exhibition->read(null, $id);
		}
		$works = $this->Exhibition->Work->find('list');
		$this->set(compact('works'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Exhibition', true), array('action' => 'index'));
		}
		if ($this->Exhibition->del($id)) {
			$this->flash(__('Exhibition deleted', true), array('action' => 'index'));
		}
		$this->flash(__('The Exhibition could not be deleted. Please, try again.', true), array('action' => 'index'));
	}

}
?>