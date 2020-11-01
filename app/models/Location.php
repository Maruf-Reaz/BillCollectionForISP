<?php

namespace App\Models;

use App\Libraries\Model;
use App\Libraries\Database;

class Location extends Model {
	protected static $table_name = "db_locations";
	protected static $db_fields = [
		'id',
		'name',
		'accountant_id',
		'notes',
	];

	public $id;
	public $name;
	public $accountant_id;
	public $notes;

	protected $db_object;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getAll() {
		$this->db_object->query( 'SELECT * FROM db_locations_view' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getLocationsByAccountantId($accountant_id) {
		$this->db_object->query( 'SELECT * FROM db_locations_view WHERE accountant_id=:accountant_id' );
		$this->db_object->bind( ':accountant_id', $accountant_id );
		$result = $this->db_object->resultSet();
		return $result;

	}


}