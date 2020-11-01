<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Libraries\Http\Request;
use App\Libraries\Validation;
use App\Models\Account\Accountant;
use App\Models\Account\Bank;
use App\Models\Account\BankWiseTransaction;
use App\Models\Account\Payment;
use App\Models\Account\PaymentMethod;
use App\Models\Subscriber;
use App\Models\Location;
use App\Models\User;

class Payments extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->only( [
			'index',
			'showPaymentDetails',
			'showPaymentsBySubscriberId',
			'getPaymentsByDateInterval'
		] )->hasRole( [
			'index'                      => [ 'Admin' ],
			'showPaymentDetails'         => [ 'Admin' ],
			'showPaymentsBySubscriberId' => [ 'Admin' ],
			'getPaymentsByDateInterval'  => [ 'Admin' ]
		] );
		$this->middleware( [ 'Roles' ] )->only( [ 'mySubscribers', 'add' ] )->hasRole( [
			'mySubscribers' => [ 'Accountant' ],
			'add'           => [ 'Accountant' ]
		] );
	}

	public function index() {
		$payments = Payment::GetInstance()->getAllPayments();
		$data     = [ 'payments' => $payments ];
		$this->view( 'accounts/payments/index', $data );
	}

	public function showPaymentDetails( $id = 0 ) {
		if ( $id == 0 ) {
			redirect( 'accounts/payments/index' );
		} else {
			$payment = Payment::GetInstance()->getPaymentDetailsById( $id );
			$data    = [ 'payment' => $payment ];
			$this->view( 'accounts/payments/showdetails', $data );
		}
	}

	public function getPaymentsByDateInterval() {
		$fromDate = Request::post( 'fromDate' );
		$toDate   = Request::post( 'toDate' );
		$payments = Payment::GetInstance()->getPaymentsByDateInterval( $fromDate, $toDate );

		return jsonResult( $payments );
	}

	public function showPaymentsBySubscriberId( $subscriber_id = 0 ) {
		if ( $subscriber_id == 0 ) {
			redirect( 'accounts/payments/index' );
		} else {
			$payments = Payment::GetInstance()->getPaymentsBySubscriberId( $subscriber_id );
			$data     = [ 'payments' => $payments ];
			$this->view( 'accounts/payments/showsubscriberwisepaymentdetails', $data );
		}
	}

	public function mySubscribers() {
		$accountant    = User::GetInstance()->getById( User::getLoggedInUserId() );
		$accountant_id = $accountant->designation_id;
		$locations     = Location::GetInstance()->getLocationsByAccountantId( $accountant_id );
		$data          = [
			'locations' => $locations,
		];
		$this->view( 'accounts/payments/mysubscribers', $data );
	}

	public function add( $id = 0 ) {
		if ( POST ) {
			if ( Request::post( 'registration_number' ) == "" ) {
				die( 'Please Enter Registration Number' );
			} else {
				if ( Request::post( 'paid_amount' ) == "" ) {
					die( 'Enter Amount to Be Paid' );
				} else {
					if ( Request::post( 'payment_method_id' ) == "" ) {
						die( 'Select Payment Method' );
					} else {
						/*-------------------------Backend validation Starts-----------------------------------*/
						$validation = new Validation();
						$validation->name( 'registration_number' )->value( Request::post( 'registration_number' ) )->pattern( 'text' )->required();
						$validation->name( 'paid_amount' )->value( Request::post( 'paid_amount' ) )->pattern( 'float' )->required();
						$validation->name( 'payment_method_id' )->value( Request::post( 'payment_method_id' ) )->pattern( 'int' )->required();
						/*-------------------------Backend validation Ends-----------------------------------*/

						if ( $validation->isSuccess() ) {
							$payment                    = new Payment();
							$payment->subscriber_id     = Request::post( 'subscriber_id' );
							$payment->amount            = Request::post( 'paid_amount' );
							$payment->discount          = Request::post( 'discount' );
							$payment->payment_method_id = Request::post( 'payment_method_id' );
							$accountant                 = User::GetInstance()->getById( User::getLoggedInUserId() );
							$accountant_id              = $accountant->designation_id;
							$payment->accountant_id     = $accountant_id;
							$payment->date              = Request::post( 'date' );

							if ( Request::post( 'bank_id' ) == "" ) {
								$payment->bank_id = null;
							} else {
								/*-------------------------Backend validation Starts-----------------------------------*/
								$validation->name( 'bank_id' )->value( Request::post( 'bank_id' ) )->pattern( 'int' )->required();
								/*-------------------------Backend validation Ends-----------------------------------*/

								if ( $validation->isSuccess() ) {
									$bank               = Bank::GetInstance()->getById( Request::post( 'bank_id' ) );
									$payment->bank_id   = $bank->id;
									$payment->bank_name = $bank->bank_name;

									$bank_wise_transaction          = new BankWiseTransaction();
									$bank_wise_transaction->bank_id = Request::post( 'bank_id' );
									$bank_wise_transaction->note    = trim( "Payment Received" );
									$bank_wise_transaction->debit   = Request::post( 'paid_amount' );
									$bank_wise_transaction->credit  = 0;
									$previous_balance_of_bank       = BankWiseTransaction::GetInstance()->getPreviousBalance( Request::post( 'bank_id' ) );
									if ( $previous_balance_of_bank == false ) {
										$bank_wise_transaction->balance = $bank_wise_transaction->debit - $bank_wise_transaction->credit;
									} else {
										$bank_wise_transaction->balance = $previous_balance_of_bank->balance + $bank_wise_transaction->debit - $bank_wise_transaction->credit;
									}
									$bank_wise_transaction->date = Request::post( 'date' );
									$bank_wise_transaction->create();
								} else {
									$payment->bank_id = null;
								}
							}

							if ( $payment->create() ) {
								$payment_method                      = PaymentMethod::GetInstance()->getById( $payment->payment_method_id );
								$payment->payment_method_name        = $payment_method->payment_method_name;
								$subscriber                          = Subscriber::GetInstance()->getById( $payment->subscriber_id );
								$payment->subscriber_name            = $subscriber->name;
								$payment->subscriber_registration_no = $subscriber->registration_no;
								$payment->subscriber_contact_number  = $subscriber->phone;
								$payment->subscriber_email           = $subscriber->email;
								$accountant                          = Accountant::GetInstance()->getById( $payment->accountant_id );
								$payment->accountant_name            = $accountant->accountant_name;
								$payment->accountant_contact_number  = $accountant->contact_number;
								$payment->accountant_email           = $accountant->email;

								$data = [ 'payment' => $payment ];
								$this->view( 'accounts/payments/showdetails', $data );
							}
						} else {
							redirect( 'accounts/payments/index' );
						}
					}
				}
			}
		} else {
			if ( $id == 0 ) {
				redirect( 'accounts/payments/index' );
			} else {
				$payment_methods        = PaymentMethod::GetInstance()->getAll();
				$banks                  = Bank::GetInstance()->getAll();
				$subscriber             = Subscriber::GetInstance()->getById( $id );
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $id );
				$data                   = [
					'payment_methods' => $payment_methods,
					'banks'           => $banks,
					'subscriber'      => $subscriber
				];
				$this->view( 'accounts/payments/add', $data );
			}
		}
	}

}