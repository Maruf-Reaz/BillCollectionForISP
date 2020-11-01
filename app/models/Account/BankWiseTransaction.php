<?php
/**
 * Created by PhpStorm.
 * User: Arman
 * Date: 12/13/2018
 * Time: 2:55 PM
 */

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class BankWiseTransaction extends Model {
	protected static $table_name = 'db_account_bank_wise_transactions';
	protected static $db_fields = [
		'id',
		'bank_id',
		'note',
		'debit',
		'credit',
		'balance',
		'date'
	];

	public $db_object;

	public $id;
	public $bank_id;
	public $note;
	public $debit;
	public $credit;
	public $balance;
	public $date;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getBankWiseTransactionDetails( $bank_id ) {
		$this->db_object->query( 'SELECT db_account_bank_wise_transactions.id,db_account_bank_wise_transactions.bank_id,db_account_bank_wise_transactions.note,
db_account_bank_wise_transactions.debit,db_account_bank_wise_transactions.credit,db_account_bank_wise_transactions.balance,db_account_banks.bank_name,db_account_bank_wise_transactions.date FROM db_account_bank_wise_transactions
JOIN db_account_banks ON db_account_bank_wise_transactions.bank_id=db_account_banks.id WHERE db_account_bank_wise_transactions.bank_id=:bank_id ORDER BY db_account_bank_wise_transactions.id ASC' );
		$this->db_object->bind( 'bank_id', $bank_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getBankWiseTransactionDetailsByDateInterval( $bank_id, $from_date, $to_date ) {
		$this->db_object->query( 'SELECT db_account_bank_wise_transactions.id,db_account_bank_wise_transactions.bank_id,db_account_bank_wise_transactions.note,
db_account_bank_wise_transactions.debit,db_account_bank_wise_transactions.credit,db_account_bank_wise_transactions.balance,db_account_banks.bank_name,db_account_bank_wise_transactions.date FROM db_account_bank_wise_transactions
JOIN db_account_banks ON db_account_bank_wise_transactions.bank_id=db_account_banks.id WHERE db_account_bank_wise_transactions.bank_id=:bank_id AND db_account_bank_wise_transactions.date BETWEEN :from_date AND :to_date ORDER BY db_account_bank_wise_transactions.id ASC' );
		$this->db_object->bind( 'bank_id', $bank_id );
		$this->db_object->bind( 'from_date', $from_date );
		$this->db_object->bind( 'to_date', $to_date );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getPreviousBalance( $bank_id ) {
		$this->db_object->query( 'SELECT * FROM db_account_bank_wise_transactions WHERE bank_id=:bank_id ORDER BY id DESC LIMIT 1' );
		$this->db_object->bind( 'bank_id', $bank_id );
		$result = $this->db_object->single();

		return $result;
	}
}