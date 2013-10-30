<?php
App::uses('AppModel', 'Model');
/**
 * Widget Model
 *
 */
class Widget extends AppModel
{
	public $user_id = 1;
	public $virtualFields = array(
		'nr_of_articles_cond' => 'IFNULL(nr_of_articles, 10)'
	);
	public $belohngsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
