<?php 
/* SVN FILE: $Id$ */
/* ExhibitionsController Test cases generated on: 2011-08-04 16:46:34 : 1312476394*/
App::import('Controller', 'Exhibitions');

class TestExhibitions extends ExhibitionsController {
	var $autoRender = false;
}

class ExhibitionsControllerTest extends CakeTestCase {
	var $Exhibitions = null;

	function startTest() {
		$this->Exhibitions = new TestExhibitions();
		$this->Exhibitions->constructClasses();
	}

	function testExhibitionsControllerInstance() {
		$this->assertTrue(is_a($this->Exhibitions, 'ExhibitionsController'));
	}

	function endTest() {
		unset($this->Exhibitions);
	}
}
?>