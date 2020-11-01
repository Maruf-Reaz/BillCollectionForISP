<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Models\Account\Expense;

class Expenses extends Controller {

	public function index() {
		$expenses = Expense::GetInstance()->getAll();
		$data     = [ 'expenses' => $expenses ];
		$this->view( 'accounts/expenses/index', $data );
	}

	public function add() {
		if ( POST ) {
			if ( $_POST['expense_type_id'] == "0" ) {
				die( 'Select Type of Expense' );
			} else {
				$this->expense->expense_type_id = $_POST['expense_type_id'];
				$this->expense->user_id         = 10;
				$this->expense->amount          = $_POST['amount'];
				$this->expense->note            = $_POST['note'];
				$this->expense->date            = $_POST['date'];
				if ( $this->expense->create() ) {
					redirect( 'accounts/expenses/index' );
				}
			}
		} else {
			$expense_types = ( new ExpenseType() )->getAll();

			$accountant_id                     = "10";
			$total_cash_payments_of_accountant = Payment::GetInstance()->getTotalCashPaymentsOfAccountant( $accountant_id );
			$total_incomes_of_accountant       = Income::GetInstance()->getTotalIncomesOfAccountant( $accountant_id );
			$total_expenses_of_accountant      = Expense::GetInstance()->getTotalExpensesOfAccountant( $accountant_id );
			$total_cash_submitted_amount       = ReceivedCash::GetInstance()->getTotalCashSubmittedAmountOfAccountant( $accountant_id );


			$total_cash_payment   = 0;
			$total_income         = 0;
			$total_expense        = 0;
			$total_cash_submitted = 0;

			if ( $total_cash_payments_of_accountant != false ) {
				$total_cash_payment = $total_cash_payments_of_accountant->total_paid_amount;
			}
			if ( $total_incomes_of_accountant != false ) {
				$total_income = $total_incomes_of_accountant->total_amount;
			}
			if ( $total_expenses_of_accountant != false ) {
				$total_expense = $total_expenses_of_accountant->total_amount;
			}
			if ( $total_cash_submitted_amount != false ) {
				$total_cash_submitted = $total_cash_submitted_amount->total_amount;
			}

			$total_cash_outstanding = $total_cash_payment + $total_income - $total_expense - $total_cash_submitted;

			$data = [
				'expense_types' => $expense_types,
				'outstanding'   => $total_cash_outstanding
			];
			$this->view( 'accounts/expenses/add', $data );
		}
	}

	public function edit( $id = 0 ) {
		if ( POST ) {
			$expense                  = new Expense();
			$expense->id              = $_POST['expense_id'];
			$expense->expense_type_id = $_POST['expense_type_id'];
			$expense->user_id         = 10;
			$expense->amount          = $_POST['amount'];
			$expense->note            = $_POST['note'];
			$expense->date            = $_POST['date'];
			if ( $expense->update() ) {
				redirect( 'accounts/expenses/index' );
			}
		} else {
			if ( $id == 0 ) {
				redirect( 'accounts/expenses/index' );
			} else {
				$expense       = $this->expense->getById( $id );
				$expense_types = ( new ExpenseType() )->getAll();
				$data          = [
					'expense'       => $expense,
					'expense_types' => $expense_types
				];
				$this->view( 'accounts/expenses/edit', $data );
			}
		}
	}

}