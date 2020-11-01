<?php

namespace App\Models\Account;

use App\Libraries\Database;
use App\Libraries\Model;
use App\Models\Subscriber;
use Carbon\Carbon;

class Payment extends Model {
	protected static $table_name = 'db_account_payments';
	protected static $db_fields = [
		'id',
		'subscriber_id',
		'amount',
		'discount',
		'payment_method_id',
		'bank_id',
		'accountant_id',
		'date'
	];

	public $db_object;

	public $id;
	public $subscriber_id;
	public $amount;
	public $discount;
	public $payment_method_id;
	public $bank_id;
	public $accountant_id;
	public $date;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getAllPayments() {
		$this->db_object->query( 'SELECT * FROM db_account_payments_view' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getPaymentDetailsById( $id = 0 ) {
		$this->db_object->query( 'SELECT * FROM db_account_payments_view WHERE id=:id' );
		$this->db_object->bind( ':id', $id );
		$result = $this->db_object->single();

		return $result;
	}

	public function getPaymentsByDateInterval( $fromDate, $toDate ) {
		$this->db_object->query( 'SELECT * FROM db_account_payments_view WHERE date between :fromDate and :toDate' );
		$this->db_object->bind( ':fromDate', $fromDate );
		$this->db_object->bind( ':toDate', $toDate );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getCurrentDueAmountOfSubscriber( $subscriber_id ) {
		$last_invoice = Invoice::GetInstance()->getLastInvoiceOfSubscriber( $subscriber_id );
		if ( $last_invoice == false ) {
			$generated_amount = 0;
		} else {
			$generated_amount = $last_invoice->amount;
		}

		$month          = Carbon::now();
		$number_of_days = $month->daysInMonth;
		$start_date     = $month->format( 'Y' ) . '-' . $month->format( 'm' ) . '-' . '1';
		$end_date       = $month->format( 'Y' ) . '-' . $month->format( 'm' ) . '-' . $number_of_days;
		$payments       = $this->getPaymentsByDateIntervalForParticularSubscriber( $subscriber_id, $start_date, $end_date );
		$paid_amount    = 0;
		$total_discount = 0;
		if ( $payments != null ) {
			foreach ( $payments as $payment ) {
				$paid_amount += $payment->amount;
				$total_discount += $payment->discount;
			}
		}

		$current_due = $generated_amount - $paid_amount - $total_discount;

		return $current_due;
	}

	public function getPaymentsByDateIntervalForParticularSubscriber( $subscriber_id, $fromDate, $toDate ) {
		$this->db_object->query( 'SELECT * FROM db_account_payments_view WHERE subscriber_id=:subscriber_id AND date between :fromDate and :toDate' );
		$this->db_object->bind( ':subscriber_id', $subscriber_id );
		$this->db_object->bind( ':fromDate', $fromDate );
		$this->db_object->bind( ':toDate', $toDate );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getPaymentsByDateIntervalForParticularAccountant( $accountant_id, $from_date, $to_date ) {
		$this->db_object->query( 'SELECT * FROM db_account_payments WHERE DATE BETWEEN :from_date AND :to_date AND accountant_id=:accountant_id' );
		$this->db_object->bind( ':accountant_id', $accountant_id );
		$this->db_object->bind( ':from_date', $from_date );
		$this->db_object->bind( ':to_date', $to_date );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getDueAmountOfSubscriber( $subscriber_id ) {
		$generated_amount = 0;
		$paid_amount      = 0;

		$invoices = Invoice::GetInstance()->getInvoicesBySubscriberId( $subscriber_id );
		if ( $invoices != null ) {
			foreach ( $invoices as $invoice ) {
				$generated_amount += $invoice->amount_after_discount;
			}
		}

		$payments = $this->getPaymentsBySubscriberId( $subscriber_id );
		if ( $payments != null ) {
			foreach ( $payments as $payment ) {
				$paid_amount += ( $payment->amount + $payment->discount );
			}
		}

		$due_amount = $generated_amount - $paid_amount;

		return $due_amount;
	}

	public function getPaymentsBySubscriberId( $subscriber_id ) {
		$this->db_object->query( 'SELECT * FROM db_account_payments_view WHERE subscriber_id=:subscriber_id' );
		$this->db_object->bind( ':subscriber_id', $subscriber_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getCountOfSubscriberWithDue() {
		$count       = 0;
		$subscribers = Subscriber::GetInstance()->getAllActiveSubscribers();
		foreach ( $subscribers as $subscriber ) {
			$due_amount = $this->getDueAmountOfSubscriber( $subscriber->id );
			if ( (float) $due_amount > 0 ) {
				$count ++;
			}
		}

		return $count;
	}

}