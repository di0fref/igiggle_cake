<?php
App::uses('AppController', 'Controller');
/**
 * Widgets Controller
 *
 */
class WidgetsController extends AppController
{
	public $components = array(
		'RequestHandler'
	);

	public $scaffold;

	function getWidgetsExp()
	{
		$this->viewClass = "json";
		$result = $this->Widget->find("all",
			array(
				"conditions" => array(
					"user_id" => 1,
				),
				"order" => array(
					"_column" => "asc",
					"_order" => "asc"
				)
			)

		);
		$this->set("result", $result);
		$this->set('_serialize', array("result"));
	}

	function setWidgetDataExp()
	{
		$data = $this->request->input('json_decode');
		die(json_encode($this->Widget->setWidgetDataExp($data)));
	}

	function addWidget()
	{
		die(json_encode($this->Widget->addWidget($this->request->data)));
	}

	function removeWidget()
	{
		die($this->Widget->removeWidget($this->request->data["id"]));
	}

	public function getWidgetData()
	{
		$result = $this->Widget->find("first", array(
				"conditions" => array(
					"id" => $this->request->data("id"),
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
			$this->set("data", $response);
		} catch (Exception $e) {
			echo "Error loading feed::" . $result["Widget"]["url"];
		}

		$this->render("entry");
	}

	function saveWidgetSettings()
	{
		die($this->Widget->saveWidgetSettings($this->request->data));
	}

	function addWidgetForm()
	{

	}

	public function widgetEditForm()
	{
		$this->set("data", $this->Widget->getWidgetEditForm($this->request->data("id")));
	}
}
