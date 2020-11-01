<?php

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;

class Invoice extends Model {
	protected static $table_name = 'db_account_invoices';
	protected static $db_fields = [
		'id',
		'subscriber_id',
		'month',
		'year',
		'invoice_number',
		'note',
		'amount',
		'discount',
		'amount_after_discount',
		'date'
	];

	public $db_object;

	public $id;
	public $subscriber_id;
	public $month;
	public $year;
	public $invoice_number;
	public $note;
	public $amount;
	public $discount;
	public $amount_after_discount;
	public $date;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getAllInvoices() {
		$this->db_object->query( 'SELECT db_account_invoices.id,db_account_invoices.subscriber_id,db_account_invoices.month,
db_account_invoices.year,db_account_invoices.invoice_number,db_account_invoices.note,db_account_invoices.amount,db_account_invoices.discount,db_account_invoices.amount_after_discount,
db_account_invoices.date,db_subscribers.name AS subscriber_name,db_subscribers.registration_no FROM db_account_invoices
JOIN db_subscribers ON db_account_invoices.subscriber_id=db_subscribers.id ORDER BY db_account_invoices.id DESC' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getById( $id ) {
		$this->db_object->query( 'SELECT db_account_invoices.id,db_account_invoices.subscriber_id,db_account_invoices.month,db_account_invoices.year,db_account_invoices.invoice_number,db_account_invoices.note,
db_account_invoices.amount,db_account_invoices.discount,db_account_invoices.amount_after_discount,db_account_invoices.date,db_subscribers.name AS subscriber_name,db_subscribers.registration_no,
db_subscribers.joining_date,db_locations.name AS location_name FROM db_account_invoices
JOIN db_subscribers ON db_account_invoices.subscriber_id=db_subscribers.id JOIN db_locations ON db_subscribers.location_id=db_locations.id WHERE db_account_invoices.id=:id' );
		$this->db_object->bind( 'id', $id );
		$result = $this->db_object->single();

		return $result;
	}

	public function doesInvoiceExist( $subscriber_id, $month, $year ) {
		$this->db_object->query( 'SELECT * FROM db_account_invoices WHERE subscriber_id=:subscriber_id AND month=:month AND year=:year' );
		$this->db_object->bind( ':subscriber_id', $subscriber_id );
		$this->db_object->bind( ':month', $month );
		$this->db_object->bind( ':year', $year );

		$result = $this->db_object->single();

		if ( $result != null ) {
			return true;
		} else {
			return false;
		}
	}

	public function getFullActiveSubscriberInfoByRegistrationNumber( $registration_number ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE registration_no=:registration_number' );
		$this->db_object->bind( ':registration_number', $registration_number );
		$result = $this->db_object->single();

		return $result;
	}

	public function getInvoicesBySubscriberId( $subscriber_id ) {
		$this->db_object->query( 'SELECT * FROM db_account_invoices WHERE subscriber_id=:subscriber_id' );
		$this->db_object->bind( ':subscriber_id', $subscriber_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getInvoiceOfParticularMonth( $month, $year ) {
		$this->db_object->query( 'SELECT * FROM db_account_invoices WHERE month=:month  AND year=:year' );
		$this->db_object->bind( ':month', $month );
		$this->db_object->bind( ':year', $year );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getInvoiceOfParticularMonthOfParticularAccountant( $month, $year, $accountant_id ) {
		$this->db_object->query( 'SELECT SUM(amount_after_discount) AS total_amount_after_discount FROM db_account_invoices
JOIN db_subscribers ON db_account_invoices.subscriber_id=db_subscribers.id JOIN db_locations ON db_subscribers.location_id=db_locations.id
WHERE db_account_invoices.month=:month AND db_account_invoices.year=:year AND db_locations.accountant_id=:accountant_id GROUP BY db_locations.accountant_id' );
		$this->db_object->bind( ':month', $month );
		$this->db_object->bind( ':year', $year );
		$this->db_object->bind( ':accountant_id', $accountant_id );
		$result = $this->db_object->single();

		return $result;
	}

	public function getLastInvoiceOfSubscriber( $subscriber_id ) {
		$this->db_object->query( 'SELECT * FROM db_account_invoices WHERE subscriber_id=:subscriber_id ORDER BY id DESC LIMIT 1' );
		$this->db_object->bind( ':subscriber_id', $subscriber_id );
		$result = $this->db_object->single();

		return $result;
	}

}