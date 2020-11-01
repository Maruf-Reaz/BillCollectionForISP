<?php

namespace App\Controllers;

use App\Libraries\Validation;
use App\Libraries\Controller;
use App\Models\Package;


class Packages extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ],
		] );
	}

	public function index() {
		$packages = Package::GetInstance()->getAll();
		$data      = [
			'packages' => $packages,
		];
		$this->view( 'packages/index', $data );
	}

	public function add() {

		if ( POST ) {

			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'cost' )->value( $_POST['cost'] )->pattern( 'int' )->required();
			$validation->name( 'speed' )->value( $_POST['speed'] )->pattern( 'float' )->required();

			/*-------------------------------Validation Ends Here--------------------------*/

			if ( $validation->isSuccess() ) {
				$package        = new Package();
				$package->name  = trim( $_POST['name'] );
				$package->cost  = trim( $_POST['cost'] );
				$package->speed  = trim( $_POST['speed'] );
				$package->notes = trim( $_POST['notes'] );
				if ( $package->create() ) {
					redirect( 'Packages/index' );
				} else {
					die( 'Something went Wrong' );
				}
			} else {
				//Show validation Errors
				echo $validation->displayErrors();

			}
		}
		else{
			$this->view( 'packages/add' );
		}
	}
	public function show( $id = 0 ) {
		$package = new Package();
		$package = $package->getById( $id );
		$data     = [
			'package' => $package,
		];
		$this->view( 'packages/edit', $data );
	}
	public function edit() {

		if ( POST ) {
			$validation = new Validation();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'cost' )->value( $_POST['cost'] )->pattern( 'int' )->required();
			$validation->name( 'speed' )->value( $_POST['speed'] )->pattern( 'float' )->required();

			if ( $validation->isSuccess() ) {
				$package        = new Package();
				$package->id    = trim( $_POST['id'] );
				$package->name = trim( $_POST['name'] );
				$package->cost  = trim( $_POST['cost'] );
				$package->speed  = trim( $_POST['speed'] );
				$package->notes  = trim( $_POST['notes'] );

				if ( $package->update() ) {
					redirect( 'Packages/index' );
				} else {
					die( 'Something went Wrong' );
				}


			} else {
				echo $validation->displayErrors();
			}

		}
	}


}