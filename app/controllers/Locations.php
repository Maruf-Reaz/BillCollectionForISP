<?php

namespace App\Controllers;

use App\Libraries\Validation;
use App\Libraries\Controller;
use App\Models\Account\Accountant;
use App\Models\Location;


class Locations extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ],
		] );
	}

	public function index() {
		$locations = Location::GetInstance()->getAll();
		$data      = [
			'locations' => $locations,
		];
		$this->view( 'locations/index', $data );
	}

	public function add() {

		if ( POST ) {
			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'accountant_id' )->value( $_POST['accountant_id'] )->pattern( 'int' )->required();
			/*-------------------------------Validation Ends Here--------------------------*/

			if ( $validation->isSuccess() ) {
				$location                = new Location();
				$location->name          = trim( $_POST['name'] );
				$location->accountant_id = trim( $_POST['accountant_id'] );
				$location->notes         = trim( $_POST['notes'] );
				if ( $location->create() ) {
					redirect( 'Locations/index' );
				} else {
					die( 'Something went Wrong' );
				}
			} else {
				//Show validation Errors
				echo $validation->displayErrors();
			}
		} else {
			$accountants = Accountant::GetInstance()->getAll();
			$data        = [ 'accountants' => $accountants ];
			$this->view( 'locations/add', $data );
		}
	}

	public function show( $id = 0 ) {
		$location    = new Location();
		$accountants = Accountant::GetInstance()->getAll();
		$location    = $location->getById( $id );
		$data        = [
			'location'    => $location,
			'accountants' => $accountants
		];
		$this->view( 'locations/edit', $data );
	}

	public function edit() {

		if ( POST ) {
			$validation = new Validation();
			$validation->name( 'id' )->value( $_POST['id'] )->pattern( 'int' )->required();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'accountant_id' )->value( $_POST['accountant_id'] )->pattern( 'int' )->required();

			if ( $validation->isSuccess() ) {
				$location                = new Location();
				$location->id            = trim( $_POST['id'] );
				$location->name          = trim( $_POST['name'] );
				$location->accountant_id = trim( $_POST['accountant_id'] );
				$location->notes         = trim( $_POST['notes'] );

				if ( $location->update() ) {
					redirect( 'Locations/index' );
				} else {
					die( 'Something went Wrong' );
				}
			} else {
				echo $validation->displayErrors();
			}
		}
	}
}