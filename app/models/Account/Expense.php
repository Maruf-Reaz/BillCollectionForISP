<?php

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class Expense extends Model {
	protected static $table_name = 'db_account_expenses';
	protected static $db_fields = [
		'id',
		'expense_name',
		'amount',
		'date'
	];

	public $db_object;

	public $id;
	public $expense_name;
	public $amount;
	public $date;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getAll() {
		$this->db_object->query( "SELECT * FROM db_account_expenses ORDER BY id DESC" );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getById( $id = 0 ) {
		$this->db_object->query( "SELECT db_account_expenses.id,
										db_account_expenses.expense_type_id,
										db_account_expense_types.expense_type_name,									  
										db_account_expenses.date,
										db_account_expenses.user_id,
										db_account_expenses.amount,
										db_account_expenses.note
										FROM db_account_expenses
										JOIN db_account_expense_types
										ON db_account_expenses.expense_type_id=db_account_expense_types.id
										WHERE db_account_expenses.id=:id" );
		$this->db_object->bind( ':id', $id );
		$result = $this->db_object->single();

		return $result;
	}

}