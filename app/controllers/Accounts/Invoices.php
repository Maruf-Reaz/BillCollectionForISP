<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Libraries\Http\Request;
use App\Libraries\Validation;
use App\Models\Account\Invoice;
use App\Models\Location;
use App\Models\Subscriber;

class Invoices extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ]
		] );
	}

	public function index() {
		$invoices = Invoice::GetInstance()->getAllInvoices();
		$data     = [ 'invoices' => $invoices ];
		$this->view( 'accounts/invoices/index', $data );
	}

	public function add() {
		if ( POST ) {
			if ( Request::post( 'month' ) == "" ) {
				die( 'Month should be selected' );
			} else {
				if ( Request::post( 'year' ) == "" ) {
					die( 'Year should be selected' );
				} else {
					if ( Request::post( 'registration_number' ) == "" ) {
						die( 'Registration number should be entered' );
					} else {
						/*-------------------------Backend validation Starts-----------------------------------*/
						$validation = new Validation();
						$validation->name( 'month' )->value( Request::post( 'month' ) )->pattern( 'text' )->required();
						$validation->name( 'year' )->value( Request::post( 'year' ) )->pattern( 'text' )->required();
						$validation->name( 'registration_number' )->value( Request::post( 'registration_number' ) )->pattern( 'text' )->required();
						/*-------------------------Backend validation Ends-----------------------------------*/

						if ( $validation->isSuccess() ) {
							$month               = Request::post( 'month' );
							$year                = Request::post( 'year' );
							$registration_number = Request::post( 'registration_number' );
							$subscriber          = Subscriber::GetInstance()->getByField( 'registration_no', $registration_number );
							if ( Invoice::GetInstance()->doesInvoiceExist( $subscriber->id, $month, $year ) ) {
								die( "Invoice of" . " " . $month . " " . $year . " " . "for" . " " . $registration_number . " " . "is already added" );
							} else {
								$invoice                        = new Invoice();
								$invoice->subscriber_id         = Request::post( 'subscriber_id' );
								$invoice->month                 = Request::post( 'month' );
								$invoice->year                  = Request::post( 'year' );
								$invoice->invoice_number        = trim( date( 'Ymdhis' ) ) . Request::post( 'subscriber_id' );
								$invoice->note                  = "Invoice of" . " " . Request::post( 'month' ) . " " . Request::post( 'year' );
								$invoice->amount                = Request::post( 'amount' );
								$invoice->discount              = Request::post( 'discount' );
								$invoice->amount_after_discount = $invoice->amount - $invoice->discount;
								$invoice->date                  = trim( date( 'Y-m-d' ) );
								if ( $invoice->create() ) {
									redirect( 'accounts/invoices/index' );
								}
							}
						} else {
							redirect( 'accounts/invoices/index' );
						}
					}
				}
			}
		} else {
			$this->view( 'accounts/invoices/add' );
		}
	}

	public function addSingleInvoice() {
		$flag = false;
		if ( Invoice::GetInstance()->doesInvoiceExist( Request::post( 'subscriber_id' ), Request::post( 'month' ), Request::post( 'year' ) ) ) {
			$flag = true;

			return jsonResult( $flag );
		} else {
			$invoice                        = new Invoice();
			$invoice->subscriber_id         = Request::post( 'subscriber_id' );
			$invoice->month                 = Request::post( 'month' );
			$invoice->year                  = Request::post( 'year' );
			$invoice->invoice_number        = trim( date( 'Ymdhis' ) ) . Request::post( 'subscriber_id' );
			$invoice->note                  = "Invoice of" . " " . Request::post( 'month' ) . " " . Request::post( 'year' );
			$invoice->amount                = Request::post( 'amount' );
			$invoice->discount              = Request::post( 'discount' );
			$invoice->amount_after_discount = $invoice->amount - $invoice->discount;
			$invoice->date                  = trim( date( 'Y-m-d' ) );
			if ( $invoice->create() ) {
				$flag = true;
			}

			return jsonResult( $flag );
		}
	}

	public function addMultipleInvoices() {
		if ( POST ) {
			if ( Request::post( 'month' ) == "" ) {
				die( 'Month should be selected' );
			} else {
				if ( Request::post( 'year' ) == "" ) {
					die( 'Year should be selected' );
				} else {
					if ( Request::post( 'location_id' ) == "" ) {
						die( 'Location should be selected' );
					} else {
						$confirmation  = 0;
						$subscriber_id = Request::post( 'subscriber_id' );
						$amount        = Request::post( 'amount' );
						$discount      = Request::post( 'discount' );
						for ( $i = 0; $i < count( $subscriber_id ); $i ++ ) {
							if ( Invoice::GetInstance()->doesInvoiceExist( $subscriber_id[ $i ], Request::post( 'month' ), Request::post( 'year' ) ) ) {
								continue;
							} else {
								$invoice                        = new Invoice();
								$invoice->subscriber_id         = $subscriber_id[ $i ];
								$invoice->month                 = Request::post( 'month' );
								$invoice->year                  = Request::post( 'year' );
								$invoice->invoice_number        = trim( date( 'Ymdhis' ) ) . $subscriber_id[ $i ];
								$invoice->note                  = "Invoice of" . " " . Request::post( 'month' ) . " " . Request::post( 'year' );
								$invoice->amount                = $amount[ $i ];
								$invoice->discount              = floatval( $discount[ $i ] );
								$invoice->amount_after_discount = $invoice->amount - $invoice->discount;
								$invoice->date                  = trim( date( 'Y-m-d' ) );
								if ( $invoice->create() ) {
									$confirmation ++;
								}
							}
						}
						if ( $confirmation != 0 ) {
							redirect( 'accounts/invoices/index' );
						} else {
							die( 'Invoice Already Added! Or Something went wrong!' );
						}
					}
				}
			}
		} else {
			$locations = Location::GetInstance()->getAll();
			$data      = [
				'locations' => $locations
			];
			$this->view( 'accounts/invoices/addinvoices', $data );
		}
	}

	public function doesSubscriberExist() {
		$registration_number = Request::get( 'registration_number' );
		$subscriber          = Subscriber::GetInstance()->isExist( 'registration_no', $registration_number );
		if ( $subscriber == null || $subscriber == false ) {
			return jsonResult( 'No subscriber found with this registration number' );
		} else {
			return jsonResult( true );
		}
	}

	public function getSubscriberByLocation() {
		$location_id = Request::post( 'location_id' );
		$month       = Request::post( 'month' );
		$year        = Request::post( 'year' );
		$subscribers = null;

		$subscribers = Subscriber::GetInstance()->getActiveSubscribersByLocation( $location_id );

		if ( $subscribers != null ) {
			foreach ( $subscribers as $subscriber ) {
				if ( Invoice::GetInstance()->doesInvoiceExist( $subscriber->id, $month, $year ) ) {
					$invoice                  = Invoice::GetInstance()->getByField( 'subscriber_id', $subscriber->id );
					$subscriber->package_cost = $invoice->amount;
					$subscriber->discount     = $invoice->discount;
					$subscriber->flag         = true;
				} else {
					$subscriber->flag = false;
				}
			}
		}

		return jsonResult( $subscribers );
	}

	public function doesInvoiceExist() {
		$month               = Request::post( 'month' );
		$year                = Request::post( 'year' );
		$registration_number = Request::post( 'registration_number' );
		$subscriber          = Subscriber::GetInstance()->getByField( 'registration_no', $registration_number );
		if ( Invoice::GetInstance()->doesInvoiceExist( $subscriber->id, $month, $year ) ) {
			return jsonResult( true );
		} else {
			return jsonResult( false );
		}
	}

	public function getSubscriberByRegistrationNumber() {
		$registration_number = Request::post( 'registration_number' );
		$subscriber          = Invoice::GetInstance()->getFullActiveSubscriberInfoByRegistrationNumber( $registration_number );
		if ( $subscriber == false ) {
			return jsonResult( null );
		} else {
			return jsonResult( $subscriber );
		}
	}

	public function showFullInvoiceInformation( $id = 0 ) {
		if ( $id == 0 ) {
			redirect( 'accounts/invoices/index' );
		} else {
			$invoice = Invoice::GetInstance()->getById( $id );
			$data    = [ 'invoice' => $invoice ];
			$this->view( 'accounts/invoices/show', $data );
		}
	}

}