<?php

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class Accountant extends Model {
	protected static $table_name = 'db_account_accountants';
	protected static $db_fields = [
		'id',
		'registration_no',
		'photo',
		'accountant_name',
		'nid_number',
		'email',
		'contact_number',
		'educational_qualification',
		'gender',
		'blood_group',
		'present_address',
		'permanent_address'
	];

	public $db_object;

	public $id;
	public $registration_no;
	public $photo;
	public $accountant_name;
	public $nid_number;
	public $email;
	public $contact_number;
	public $educational_qualification;
	public $gender;
	public $blood_group;
	public $present_address;
	public $permanent_address;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getLastAccountantId() {
		$this->db_object->query( 'SELECT * FROM db_account_accountants ORDER BY id DESC LIMIT 1' );
		$result = $this->db_object->single();

		return $result;
	}
}