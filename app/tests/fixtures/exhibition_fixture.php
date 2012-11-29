<?php 
/* SVN FILE: $Id$ */
/* Exhibition Fixture generated on: 2011-08-04 16:47:12 : 1312476432*/

class ExhibitionFixture extends CakeTestFixture {
	var $name = 'Exhibition';
	var $table = 'exhibitions';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'work_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'Title' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'note' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id' => 1,
		'work_id' => 1,
		'Title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
	));
}
?>