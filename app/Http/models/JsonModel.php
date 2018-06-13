<?php
namespace App\Http\Models;
class JsonModel 
{	
	var $data = array();
	function echo_json($data)
	{
		return json_encode($data);
	}
}