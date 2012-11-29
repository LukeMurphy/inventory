<?php
class Exhibition extends AppModel {

	var $name = 'Exhibition';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Work' => array(
			'className' => 'Work',
			'joinTable' => 'exhibitions_works',
			'foreignKey' => 'exhibition_id',
			'associationForeignKey' => 'work_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('Work.date_year'),
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>