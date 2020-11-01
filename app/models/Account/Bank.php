<?php
/**
 * Created by PhpStorm.
 * User: Arman
 * Date: 12/13/2018
 * Time: 12:13 PM
 */

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class Bank extends Model {
	protected static $table_name = 'db_account_banks';
	protected static $db_fields = [
		'id',
		'bank_name',
		'account_number',
		'opening_date',
		'note'
	];

	public $db_object;

	public $id;
	public $bank_name;
	public $account_number;
	public $opening_date;
	public $note;

	public function __construct() {
		$this->db_object = new Database();
	}
}