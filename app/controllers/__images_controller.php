<?php
class ImagesController extends AppController {

	var $name = 'Images';
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
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
		$this->set('ImageLoc', $this->Image->loc);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Image.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
		$this->set('imagePath',IMAGE_PATH);
	}

	function add() {
		if($this->_User['User']['group'] == "editor"){
			if (!empty($this->data)) {
				$this->Image->create();
				if ($this->Image->save($this->data)) {
					$this->Session->setFlash(__('The Image has been saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('The Image could not be saved. Please, try again.', true));
				}
			}
			$works = $this->Image->Work->find('list');
			$this->set(compact('works'));
			$this->set('imagePath',IMAGE_PATH);
		}
	}

	function edit($id = null) {
		$this->set('image', $this->Image->read(null, $id));
		$this->set('imagePath',IMAGE_PATH);
		if($this->_User['User']['group'] == "editor"){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Image', true));
				$this->redirect(array('action'=>'index'));
			}
			if (!empty($this->data)) {
				if ($this->Image->save($this->data)) {
					$this->Session->setFlash(__('The Image has been saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('The Image could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Image->read(null, $id);
			}
			$works = $this->Image->Work->find('list');
			$this->set(compact('works'));
		}
	}

	function delete($id = null) {
		if($this->_User['User']['group'] == "editor"){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Image', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Image->del($id)) {
				$this->Session->setFlash(__('Image deleted', true));
				$this->redirect(array('action'=>'index'));
			}
		}
	}

}
?>