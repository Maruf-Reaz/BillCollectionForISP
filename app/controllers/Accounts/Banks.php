<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Libraries\Http\Request;
use App\Libraries\Validation;
use App\Models\Account\Bank;
use App\Models\Account\BankWiseTransaction;

class Banks extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ]
		] );
	}

	public function index() {
		$banks = Bank::GetInstance()->getAll();
		$data  = [ 'banks' => $banks ];
		$this->view( 'accounts/banks/index', $data );
	}

	public function add() {
		if ( POST ) {
			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'bank_name' )->value( Request::post( 'bank_name' ) )->pattern( 'text' )->required();
			$validation->name( 'account_number' )->value( Request::post( 'account_number' ) )->pattern( 'text' )->required();
			$validation->name( 'opening_date' )->value( Request::post( 'opening_date' ) )->pattern( 'date_ymd' )->required();
			$validation->name( 'note' )->value( Request::post( 'note' ) )->pattern( 'text' );
			/*-------------------------Backend validation Ends-----------------------------------*/

			if ( $validation->isSuccess() ) {
				$bank                 = new Bank();
				$bank->bank_name      = Request::post( 'bank_name' );
				$bank->account_number = Request::post( 'account_number' );
				$bank->opening_date   = Request::post( 'opening_date' );
				$bank->note           = Request::post( 'note' );
				if ( $bank->create() ) {
					redirect( 'accounts/banks/index' );
				}
			} else {
				redirect( 'accounts/payments/index' );
			}
		} else {
			$this->view( 'accounts/banks/add' );
		}
	}

	public function edit( $id = 0 ) {
		if ( POST ) {
			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'bank_id' )->value( Request::post( 'bank_id' ) )->pattern( 'int' )->required();
			$validation->name( 'bank_name' )->value( Request::post( 'bank_name' ) )->pattern( 'text' )->required();
			$validation->name( 'account_number' )->value( Request::post( 'account_number' ) )->pattern( 'text' )->required();
			$validation->name( 'opening_date' )->value( Request::post( 'opening_date' ) )->pattern( 'date_ymd' )->required();
			$validation->name( 'note' )->value( Request::post( 'note' ) )->pattern( 'text' );
			/*-------------------------Backend validation Ends-----------------------------------*/

			if ( $validation->isSuccess() ) {
				$bank                 = new Bank();
				$bank->id             = Request::post( 'bank_id' );
				$bank->bank_name      = Request::post( 'bank_name' );
				$bank->account_number = Request::post( 'account_number' );
				$bank->opening_date   = Request::post( 'opening_date' );
				$bank->note           = Request::post( 'note' );
				if ( $bank->update() ) {
					redirect( 'accounts/banks/index' );
				}
			} else {
				redirect( 'accounts/banks/index' );
			}
		} else {
			$bank = Bank::GetInstance()->getById( $id );
			if ( $bank->id == null ) {
				redirect( 'accounts/banks/index' );
			} else {
				$data['bank'] = $bank;
				$this->view( 'accounts/banks/edit', $data );
			}
		}
	}

	public function deposit( $id = 0 ) {
		if ( POST ) {
			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'bank_id' )->value( Request::post( 'bank_id' ) )->pattern( 'int' )->required();
			$validation->name( 'amount' )->value( Request::post( 'amount' ) )->pattern( 'float' )->required();
			$validation->name( 'note' )->value( Request::post( 'note' ) )->pattern( 'text' )->required();
			/*-------------------------Backend validation Ends-----------------------------------*/

			if ( $validation->isSuccess() ) {
				$bank_wise_transaction          = new BankWiseTransaction();
				$bank_wise_transaction->bank_id = Request::post( 'bank_id' );
				$bank_wise_transaction->note    = Request::post( 'note' );
				$bank_wise_transaction->debit   = Request::post( 'amount' );
				$bank_wise_transaction->credit  = 0;

				$previous_balance_of_bank = BankWiseTransaction::GetInstance()->getPreviousBalance( Request::post( 'bank_id' ) );
				if ( $previous_balance_of_bank == false ) {
					$bank_wise_transaction->balance = $bank_wise_transaction->debit - $bank_wise_transaction->credit;
				} else {
					$bank_wise_transaction->balance = $previous_balance_of_bank->balance + $bank_wise_transaction->debit - $bank_wise_transaction->credit;
				}
				$bank_wise_transaction->date = trim( date( 'Y-m-d' ) );

				if ( $bank_wise_transaction->create() ) {
					$bank_wise_transaction_details = BankWiseTransaction::GetInstance()->getBankWiseTransactionDetails( Request::post( 'bank_id' ) );
					$data                          = [ 'bank_wise_transaction_details' => $bank_wise_transaction_details ];
					$this->view( 'accounts/banks/showtransactiondetails', $data );
				}
			} else {
				redirect( 'accounts/banks/index' );
			}
		} else {
			$bank = Bank::GetInstance()->getById( $id );
			if ( $bank->id == null ) {
				redirect( 'accounts/banks/index' );
			} else {
				$data = [ 'bank' => $bank ];
				$this->view( 'accounts/banks/deposit', $data );
			}
		}
	}

	public function withdraw( $id = 0 ) {
		if ( POST ) {
			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'bank_id' )->value( Request::post( 'bank_id' ) )->pattern( 'int' )->required();
			$validation->name( 'amount' )->value( Request::post( 'amount' ) )->pattern( 'float' )->required();
			$validation->name( 'note' )->value( Request::post( 'note' ) )->pattern( 'text' )->required();
			/*-------------------------Backend validation Ends-----------------------------------*/

			if ( $validation->isSuccess() ) {
				$bank_wise_transaction          = new BankWiseTransaction();
				$bank_wise_transaction->bank_id = Request::post( 'bank_id' );
				$bank_wise_transaction->note    = Request::post( 'note' );
				$bank_wise_transaction->debit   = 0;
				$bank_wise_transaction->credit  = Request::post( 'amount' );

				$previous_balance_of_bank = BankWiseTransaction::GetInstance()->getPreviousBalance( Request::post( 'bank_id' ) );
				if ( $previous_balance_of_bank == false ) {
					$bank_wise_transaction->balance = $bank_wise_transaction->debit - $bank_wise_transaction->credit;
				} else {
					$bank_wise_transaction->balance = $previous_balance_of_bank->balance + $bank_wise_transaction->debit - $bank_wise_transaction->credit;
				}
				$bank_wise_transaction->date = trim( date( 'Y-m-d' ) );

				if ( $bank_wise_transaction->create() ) {
					$bank_wise_transaction_details = BankWiseTransaction::GetInstance()->getBankWiseTransactionDetails( Request::post( 'bank_id' ) );
					$data                          = [ 'bank_wise_transaction_details' => $bank_wise_transaction_details ];
					$this->view( 'accounts/banks/showtransactiondetails', $data );
				}
			} else {
				redirect( 'accounts/banks/index' );
			}
		} else {
			$bank = Bank::GetInstance()->getById( $id );
			if ( $bank->id == null ) {
				redirect( 'accounts/banks/index' );
			} else {
				$previous_balance_of_bank = BankWiseTransaction::GetInstance()->getPreviousBalance( $id );
				if ( $previous_balance_of_bank == false ) {
					$previous_balance = 0;
				} else {
					$previous_balance = $previous_balance_of_bank->balance;
				}
				$data = [
					'bank'             => $bank,
					'previous_balance' => $previous_balance
				];
				$this->view( 'accounts/banks/withdraw', $data );
			}
		}
	}

	public function showBankDetails( $id = 0 ) {
		if ( $id == 0 ) {
			redirect( 'accounts/banks/index' );
		} else {
			$bank_wise_transaction_details = BankWiseTransaction::GetInstance()->getBankWiseTransactionDetails( $id );
			$data                          = [
				'id'                            => $id,
				'bank_wise_transaction_details' => $bank_wise_transaction_details
			];
			$this->view( 'accounts/banks/showTransactionDetails', $data );
		}
	}

	public function showBankDetailsByDateInterval() {
		$bank_id                       = Request::post( 'bankId' );
		$from_date                     = Request::post( 'fromDate' );
		$to_date                       = Request::post( 'toDate' );
		$bank_wise_transaction_details = BankWiseTransaction::GetInstance()->getBankWiseTransactionDetailsByDateInterval( $bank_id, $from_date, $to_date );

		return jsonResult( $bank_wise_transaction_details );
	}

}