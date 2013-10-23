<?php
App::uses('AppModel', 'Model');
/**
 * Widget Model
 *
 */
class Widget extends AppModel
{
	protected $config_table = "widgets";
	protected $widget_data_table = "widgets";
	protected $database = "s6411_igiggle";
	protected $widget_config_field = "config";
	public $user_id = 1;
	public $title;
	public $id;
	public $_order;
	public $_column;

	public $virtualFields = array(
		'nr_of_articles_cond' => 'IFNULL(nr_of_articles, 10)'
	);

	function __construct()
	{
		mysql_connect("localhost", "root", "");
		mysql_select_db($this->database);

		parent::__construct();
	}

	function getWidgetsExp()
	{

	}

	function setWidgetDataExp($data)
	{
		foreach ($data as $key => $widget) {
			$sql = "update widgets set _column = '{$widget->column}', _order = '{$widget->order}' where id = '{$widget->id}'";
			mysql_query($sql);
		}
	}

	function addWidgetErrorhandler()
	{
	}

	function addWidget($request)
	{
		set_error_handler(array(&$this, "addWidgetErrorhandler"));
		try {
			$data = file_get_contents($request["url"]);
			$x = new SimpleXmlElement($data);
		} catch (Exception $e) {
			return array("message" => "Error parsing xml::" . $request["url"]);
		}

		$sql = "INSERT INTO {$this->widget_data_table} (id, user_id, title, url) VALUES('{$request["id"]}', 1, '{$request["title"]}', '{$request["url"]}')";
		mysql_query($sql);

		return array("message" => true);
	}

	function removeWidget($id)
	{
		$sql = "DELETE FROM {$this->widget_data_table} WHERE id = '{$id}'";
		mysql_query($sql);
	}

	function saveWidgetSettings($request)
	{
		$sql = "UPDATE widget_data set nr_of_articles = '{$request["nr_of_articles"]}' WHERE id='{$request["id"]}'";
		return mysql_query($sql);
	}

	function setWidgetData($value)
	{
		$rs = mysql_query("SELECT * FROM {$this->config_table} WHERE user_id='{$this->user_id}'");
		if (mysql_numrows($rs) == 0)
			mysql_query("INSERT INTO {$this->config_table} ({$this->widget_config_field},user_id) VALUES('$value','{$this->user_id}')");
		else
			mysql_query("UPDATE {$this->config_table} SET {$this->widget_config_field}='$value' WHERE user_id='{$this->user_id}'");
		echo "OK";

	}

	function getWidgetData($widget_id)
	{

		$result = $this->find("first", array(
				"conditions" => array(
					"id" => $widget_id,
				),
				"fields" => array(
					"nr_of_articles_cond",
					"url",
					"id",
				)
			)
		);

		try {
			$data = file_get_contents($result["Widget"]["url"]);
			$xml = new SimpleXmlElement($data);
			$response = array(
				"xml" => $xml,
				"nr_of_articles" => $result["Widget"]["nr_of_articles_cond"]
			);
		} catch (Exception $e) {
			echo "Error loading feed::" . $result["Widget"]["url"];
		}

		$this->layout = 'entry';
		return $response;

	}

	function getWidgets()
	{
		$field = "config";
		$sql = "SELECT {$this->widget_config_field} FROM {$this->config_table} WHERE user_id='{$this->user_id}'";
		$rs = mysql_query($sql);

		if ($row = mysql_fetch_row($rs))
			return $row[0];
		else
			return "";
	}

	function getWidgetEditForm($id)
	{
		$sql = "SELECT IFNULL(nr_of_articles, 10) FROM {$this->widget_data_table} where id = '{$id}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$this->layout = 'widget_edit_form';
		return $row[0];
	}
}
