<?php
/**
 * Created by PhpStorm.
 * User: Arman
 * Date: 12/11/2018
 * Time: 1:35 PM
 */

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class PaymentMethod extends Model {
	protected static $table_name = 'db_account_payment_methods';
	protected static $db_fields = [
		'id',
		'payment_method_name'
	];

	public $db_object;

	public $id;
	public $payment_method_name;

	public function __construct() {
		$this->db_object = new Database();
	}
}