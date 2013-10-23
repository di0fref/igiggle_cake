<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fref
 * Date: 10/23/13
 * Time: 16:48
 */

/*
* Class: 
* Author: Fredrik Fahlstad
*/
class AjaxResponse implements Serializable
{
	protected $message = "";
	protected $status = true; /* Ok as default */

	public function __construct()
	{
	}

	function serialize()
	{
		return json_encode(array(
				"status" => $this->status,
				"message" => $this->message
			)
		);

	}

	function get()
	{
		return array(
			"status" => $this->status,
			"message" => $this->message
		);
	}

	function unserialize($string)
	{
		return json_decode($string);
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}


}