<?php
class LocationsController extends AppController {

	var $name = 'Locations';
	var $helpers = array('Html', 'Form');
	var $_User = array();
	var $permissions = array('guest');
	//var $scaffold;

	/**
	 * Before any Controller action
	 */
	function beforeFilter() {

		$this->set('user',$this->_User);
			
		if( !$this->Session->check('User') ) {
			$this->redirect('/users/login');
		} else {
			// save user data
			$this->_User = $this->Session->read('User');
			$this->set('user',$this->_User);
			$this->permissions = array('viewer');

			if($this->_User['User']['group'] == "editor") {
				$this->permissions = array("editor");
			}
			if($this->_User['User']['group'] == "admin"){
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
		$this->Location->recursive = 0;
		$this->set('locations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Location.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Location->create();
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('The Location has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Location could not be saved. Please, try again.', true));
			}
		}
		$works = $this->Location->Work->find('list');
		$this->set(compact('works'));
	}

	function edit($id = null) {
		if($this->_User['User']['group'] == "editor"){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Location', true));
				$this->redirect(array('action'=>'index'));
			}
			if (!empty($this->data)) {
				if ($this->Location->save($this->data)) {
					$this->Session->setFlash(__('The Location has been saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('The Location could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Location->read(null, $id);
			}
			$works = $this->Location->Work->find('list');
			$this->set(compact('works'));
		}
	}

	function delete($id = null) {
		
			if ($this->Location->del($id)) {
				$this->Session->setFlash(__('Location deleted', true));
				$this->redirect(array('action'=>'index'));
			}
		/*
		if($this->_User['User']['group'] == "editor"){
			if ($id) {
				$this->Session->setFlash(__('Invalid id for Location', true));
				$this->redirect(array('action'=>'index'));
			}
		}
			*/
	}

}
?>