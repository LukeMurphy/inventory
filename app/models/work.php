<?php
class Work extends AppModel {

	var $name = 'Work';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'work_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'work_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Exhibition' => array(
			'className' => 'Exhibition',
			'joinTable' => 'exhibitions_works',
			'foreignKey' => 'work_id',
			'associationForeignKey' => 'exhibition_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
/*<?php
class Work extends AppModel {

	var $name = 'Work';
	var $validate = array(
	//'inventory_id' => array('notempty'),
		'title' => array('notempty'),
		'date_year' => array('notempty'),
		'height' => array('numeric'),
		'width' => array('numeric')
	);
	
		var $hasAndBelongsToMany  = array(
		'Exhibition' => array(
			'className' => 'Exhibition',
			'joinTable' => 'exhibitions_works',
			'foreignKey' => 'work_id',
			'associationForeignKey'  => 'exhibition_id'
			)
			);
	
	var $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'work_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT Image.* from images as Image WHERE Image.work_id = {$__cakeID__$};',
			'counterQuery' => ''
			),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'work_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT Location.* from locations as Location WHERE Location.work_id = {$__cakeID__$};',
			'counterQuery' => '')
			);
}
?>
*/
?>