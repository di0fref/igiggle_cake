<?php
App::uses('AppController', 'Controller');
/**
 * Widgets Controller
 *
 */
App::uses('AjaxResponse', 'Http');

class WidgetsController extends AppController
{
	public $components = array(
		'RequestHandler'
	);

	public $scaffold;

	function getWidgetsExp()
	{
		$response = new AjaxResponse();

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
		$response->setData($result);
		$this->set("response", $response->get());
		$this->set('_serialize', array("response"));
	}

	function setWidgetDataExp()
	{
		$response = new AjaxResponse();

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
		$response->setMessage("Widget configuration saved");
		$this->set("response", $response->get());
		$this->set('_serialize', array("response"));

	}

	function WidgetErrorHandler()
	{
	}

	function addWidget()
	{
		$response = new AjaxResponse();

		$widget_save_data = $this->request->data;
		$widget_save_data["user_id"] = 1;

		$this->viewClass = "json";
		$response->setMessage("Widget added successfully.");
		set_error_handler(array(&$this, "WidgetErrorHandler"));
		try {
			$data = file_get_contents($this->request->data["url"]);
			$x = new SimpleXmlElement($data);

			$this->Widget->create();
			if (!$this->Widget->save(array("Widget" => $widget_save_data))) {
				$response->setStatus(false);
				$response->setMessage("Unable to add new Widget.");
			}
		} catch (Exception $e) {
			$response->setStatus(false);
			$response->setMessage("Error parsing xml::" . $this->request->data["url"] . ".");
		}
		$this->set("response", $response->get());
		$this->set('_serialize', array("response"));

	}

	function removeWidget()
	{
		$this->viewClass = "json";
		$response = new AjaxResponse();
		$response->setMessage("Widget removed.");
		if (!$this->Widget->delete($this->request->data["id"])) {
			$response->setStatus(false);
			$response->setMessage("Unable to delete Widget.");
		}
		$this->set("response", $response->get());
		$this->set('_serialize', array("response"));
	}

	public function getWidgetData()
	{
		$response = new AjaxResponse();

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
		set_error_handler(array(&$this, "WidgetErrorHandler"));
		try {
			$data = file_get_contents($result["Widget"]["url"]);
			$xml = new SimpleXmlElement($data);

			$widgetData = array(
				"xml" => $xml,
				"nr_of_articles" => $result["Widget"]["nr_of_articles_cond"]
			);
			$this->set("data", $widgetData);
		} catch (Exception $e) {
			$response->setStatus(false);
			$response->setMessage("Error loading feed::" . $result["Widget"]["url"]);
			$this->set("response", $response->get());
			$this->set('_serialize', array("response"));
		}

		$this->render("entry");
	}

	function saveWidgetSettings()
	{

		$response = new AjaxResponse();

		$this->viewClass = "json";
		$response->setMessage("Widget saved successfully.");

		$widget_save_data = array(
			"id" => $this->request->data["id"],
			"nr_of_articles" => $this->request->data["nr_of_articles"]

		);
		if (!$this->Widget->save($widget_save_data)) {
			$response->setMessage("Unable to save Widget settings.");
			$response->setStatus(false);
		}
		$this->set("response", $response->get());
		$this->set('_serialize', array("response"));
	}

	function addWidgetForm()
	{

	}

	function editWidgetForm()
	{
		$result = $this->Widget->find("first", array(
				"conditions" => array(
					"id" => $this->request->data["id"]
				),
				"fields" => array(
					"nr_of_articles_cond",
				)
			)
		);
		$this->set("data", $result);
	}

	function add()
	{
		if ($this->request->is('post')) {
			$this->Widget->create();
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The Widget has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The Widget could not be saved. Please, try again.'));
		}else{
			//$user = new User();
			//$users = $user->find("all", array("fields" => array("username", "id")));
			//$this->set("user_id_options", $users);
		}
	}

	function edit($id = null)
	{
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid Widget'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The Widget has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		} else {
			$this->request->data = $this->Widget->read(null, $id);
		}
	}

	function view($id = null)
	{
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid Widget'));
		}
		$this->set('widget', $this->Widget->read(null, $id));
	}

	function index()
	{
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}

}
