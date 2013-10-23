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
		$this->viewClass = "json";
		$widgets = $this->request->input('json_decode');
		foreach ($widgets as $widget) {
			$save_data = array(
				"id" => $widget->id,
				"_column" => $widget->column,
				"_order" => $widget->order,
			);
			$this->Widget->save($save_data);
		}
		$this->set("message", array("Widget configuration saved"));
		$this->set('_serialize', array("message"));

	}

	function addWidget()
	{
		$response = new AjaxResponse();

		$this->viewClass = "json";
		$response->setMessage("Widget added sucessfully.");

		try {
			$data = file_get_contents($this->request->data["url"]);
			$x = new SimpleXmlElement($data);

			$this->Widget->create();
			if(!$this->Widget->save(array("Widget" => $this->request->data))){
				$response->setMessage("Unable to add new Widget.");
			}
		} catch (Exception $e) {
			$response->setMessage("Error parsing xml::" . $this->request->data["url"].".");
		}
		$this->set("message", $response->get());
		$this->set('_serialize', array("message"));

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
