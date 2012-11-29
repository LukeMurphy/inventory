<?php 
/* SVN FILE: $Id$ */
/* Exhibition Test cases generated on: 2011-08-04 16:47:12 : 1312476432*/
App::import('Model', 'Exhibition');

class ExhibitionTestCase extends CakeTestCase {
	var $Exhibition = null;
	var $fixtures = array('app.exhibition', 'app.work');

	function startTest() {
		$this->Exhibition =& ClassRegistry::init('Exhibition');
	}

	function testExhibitionInstance() {
		$this->assertTrue(is_a($this->Exhibition, 'Exhibition'));
	}

	function testExhibitionFind() {
		$this->Exhibition->recursive = -1;
		$results = $this->Exhibition->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Exhibition' => array(
			'id' => 1,
			'work_id' => 1,
			'Title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		));
		$this->assertEqual($results, $expected);
	}
}
?>