<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Libraries\Http\Request;
use App\Models\Account\Accountant;
use App\Models\Account\Invoice;
use App\Models\Account\Payment;
use Carbon\Carbon;

class Reports extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ]
		] );
	}

	public function index() {
		$this->view( 'accounts/reports/index' );
	}

	public function getMonthWiseInvoice() {
		$invoices            = Invoice::GetInstance()->getInvoiceOfParticularMonth( Request::post( 'month' ), Request::post( 'year' ) );
		$accounts_receivable = 0;
		if ( $invoices != null ) {
			foreach ( $invoices as $invoice ) {
				$accounts_receivable += $invoice->amount_after_discount;
			}
		}
		if ( $accounts_receivable == 0 ) {
			return jsonResult( null );
		} else {
			return jsonResult( $accounts_receivable );
		}
	}

	public function getAccountantWiseDetails() {
		$month_in_number = Carbon::parse( Request::post( 'month' ) )->month;
		$year            = Request::post( 'year' );
		$month           = Carbon::create( $year, $month_in_number, 1 );
		$number_of_days  = $month->daysInMonth;
		$start_date      = $month->format( 'Y' ) . '-' . $month->format( 'm' ) . '-' . '1';
		$end_date        = $month->format( 'Y' ) . '-' . $month->format( 'm' ) . '-' . $number_of_days;

		$invoices            = Invoice::GetInstance()->getInvoiceOfParticularMonth( Request::post( 'month' ), Request::post( 'year' ) );
		$accounts_receivable = 0;
		if ( $invoices != null ) {
			foreach ( $invoices as $invoice ) {
				$accounts_receivable += $invoice->amount_after_discount;
			}
		}

		$accountants = Accountant::GetInstance()->getAll();
		foreach ( $accountants as $accountant ) {
			$invoice_of_accountant = Invoice::GetInstance()->getInvoiceOfParticularMonthOfParticularAccountant( Request::post( 'month' ), Request::post( 'year' ), $accountant->id );
			if ( $invoice_of_accountant == false ) {
				$accountant->invoice_amount = 0;
			} else {
				$accountant->invoice_amount = $invoice_of_accountant->total_amount_after_discount;
			}

			$payments       = Payment::GetInstance()->getPaymentsByDateIntervalForParticularAccountant( $accountant->id, $start_date, $end_date );
			$total_amount   = 0;
			$total_discount = 0;
			if ( $payments == null ) {
				$accountant->received_amount = $total_amount;
				$accountant->discount        = $total_discount;
			} else {
				foreach ( $payments as $payment ) {
					$total_amount   += $payment->amount;
					$total_discount += $payment->discount;
				}
				$accountant->received_amount = $total_amount;
				$accountant->discount        = $total_discount;
			}
			$accountant->remaining_amount                = $accountant->invoice_amount - $accountant->received_amount - $accountant->discount;
			$accountant->remaining_amount_after_payments = $accounts_receivable - $accountant->received_amount - $accountant->discount;
			$accounts_receivable                         = $accounts_receivable - $accountant->received_amount - $accountant->discount;
		}

		return jsonResult( $accountants );
	}

}