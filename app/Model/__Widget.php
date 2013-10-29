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
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function __construct()
	{
		parent::__construct();
	}

}
