<?php

namespace App\Models;

use App\Libraries\Model;
use App\Libraries\Database;

class Package extends Model {
	protected static $table_name = "db_packages";
	protected static $db_fields = [
		'id',
		'name',
		'cost',
		'notes',
		'speed',
	];
	public $id;
	public $name;
	public $cost;
	public $notes;
	public $speed;
	protected $db_object;
	public function __construct() {
		$this->db_object = new Database();
	}

}