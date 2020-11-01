<?php

namespace App\Controllers;

use App\Libraries\Validation;
use App\Libraries\Controller;
use App\Models\Account\Payment;
use App\Models\Location;
use App\Models\Package;
use App\Models\Subscriber;
use App\Models\File;
use App\Models\User;

class Subscribers extends Controller {
	private $file;

	public function __construct() {
		$this->file = new File();
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->only( [
			'index',
			'viewSubscriber',
			'add',
			'emptyAddView',
			'show',
			'edit',
			'deactivate',
			'activate',
			'viewActiveSubscribers',
			'viewDeActiveSubscribers',
			'viewSubscribersByLocation',
			'getSubscribersByLocation',
			'viewSubscribersByPackage',
			'getSubscribersByPackage',
			'checkOverlap',
			'doesPhoneExist',
			'doesEmailExist',
			'doesPhoneExistExceptId',
			'doesEmailExistExceptId',
			'viewNid',
		] )->hasRole( [
			'index'                     => [ 'Admin' ],
			'viewSubscriber'            => [ 'Admin' ],
			'add'                       => [ 'Admin' ],
			'emptyAddView'              => [ 'Admin' ],
			'show'                      => [ 'Admin' ],
			'edit'                      => [ 'Admin' ],
			'deactivate'                => [ 'Admin' ],
			'activate'                  => [ 'Admin' ],
			'viewActiveSubscribers'     => [ 'Admin' ],
			'viewDeActiveSubscribers'   => [ 'Admin' ],
			'viewSubscribersByLocation' => [ 'Admin' ],
			'getSubscribersByLocation'  => [ 'Admin' ],
			'viewSubscribersByPackage'  => [ 'Admin' ],
			'getSubscribersByPackage'   => [ 'Admin' ],
			'checkOverlap'              => [ 'Admin' ],
			'doesPhoneExist'            => [ 'Admin' ],
			'doesEmailExist'            => [ 'Admin' ],
			'doesPhoneExistExceptId'    => [ 'Admin' ],
			'doesEmailExistExceptId'    => [ 'Admin' ],
			'viewNid'                   => [ 'Admin' ]
		] );
		$this->middleware( [ 'Roles' ] )->only( [ 'getSubscribersByLocationAndAccountant' ] )->hasRole( [
			'getSubscribersByLocationAndAccountant' => [ 'Accountant' ]
		] );
	}

	public function index() {
		$subscribers = Subscriber::GetInstance()->getAllSubscribers();
		if ( $subscribers != null ) {
			foreach ( $subscribers as $subscriber ) {
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
			}
		}
		$data = [
			'subscribers' => $subscribers,
		];
		$this->view( 'subscribers/index', $data );
	}

	public function viewSubscriber( $id = 0 ) {
		$subscriber = Subscriber::GetInstance()->getBySubscriberId( $id );
		$data       = [
			'subscriber' => $subscriber,
		];
		$this->view( 'subscribers/view', $data );


	}

	public function add() {

		if ( POST ) {

			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'nid' )->value( $_POST['nid'] )->pattern( 'text' )->required();
			$validation->name( 'phone' )->value( $_POST['phone'] )->pattern( 'text' )->required();
			$validation->name( 'email' )->value( $_POST['email'] )->pattern( 'text' )->required();
			$validation->name( 'present_address' )->value( $_POST['present_address'] )->pattern( 'text' )->required();
			$validation->name( 'permanent_address' )->value( $_POST['permanent_address'] )->pattern( 'text' )->required();
			$validation->name( 'package_id' )->value( $_POST['package_id'] )->pattern( 'int' )->required();
			$validation->name( 'location_id' )->value( $_POST['location_id'] )->pattern( 'int' )->required();
			$validation->name( 'location_serial_no' )->value( $_POST['location_serial_no'] )->pattern( 'int' )->required();
			$validation->name( 'photo' )->value( $_FILES['photo']['name'] )->pattern( 'file' )->required();
			$validation->name( 'nid_photo' )->value( $_FILES['nid_photo']['name'] )->pattern( 'file' )->required();
			/*-------------------------------Validation Ends Here--------------------------*/

			if ( $validation->isSuccess() ) {
				$subscriber                     = new Subscriber();
				$subscriber->name               = trim( $_POST['name'] );
				$subscriber->nid                = trim( $_POST['nid'] );
				$subscriber->phone              = trim( $_POST['phone'] );
				$subscriber->email              = trim( $_POST['email'] );
				$subscriber->present_address    = trim( $_POST['present_address'] );
				$subscriber->permanent_address  = trim( $_POST['permanent_address'] );
				$subscriber->package_id         = trim( $_POST['package_id'] );
				$subscriber->location_id        = trim( $_POST['location_id'] );
				$subscriber->location_serial_no = trim( $_POST['location_serial_no'] );
				$subscriber->registration_no    = 00000;
				$subscriber->status             = 1;
				$subscriber->joining_date       = trim( $_POST['joining_date'] );
				$subscriber->deactivation_date  = "";
				$subscriber->notes              = trim( $_POST['notes'] );
				$nid_file                       = new File();
				if ( $this->file->attach_file( $_FILES['photo'] ) && $nid_file->attach_file( $_FILES['nid_photo'] ) ) {
					$this->file->upload_dir = 'images/subscribers';
					$nid_file->upload_dir   = 'images/subscriber_nid';
					$this->file->file_name  = $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";
					$nid_file->file_name    = "NID" . $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";
					if ( $this->file->save() && $nid_file->save() ) {
						$subscriber->photo     = $this->file->file_name;
						$subscriber->nid_photo = $nid_file->file_name;
						$temp                  = [
							'location_id'        => $subscriber->location_id,
							'location_serial_no' => $subscriber->location_serial_no,
						];
						if ( Subscriber::GetInstance()->fieldsExist( $temp ) ) {

							Subscriber::GetInstance()->updateSerial( $subscriber->location_id, $subscriber->location_serial_no );
						}
						/*------------------------Save the Student-------------------------*/
						if ( $subscriber->create() ) {
							$message = "Subscriber Added Successfully";
							$type    = "success";
							$this->emptyAddView( $message, $type );
						} else {
							$message = "Subscriber Was not Saved";
							$type    = "danger";
							$this->emptyAddView( $message, $type );
						}
					} else {
						$message = "Subscriber Was not Saved";
						$type    = "warning";
						$this->emptyAddView( $message, $type );
					}
				} else {
					$message = "Something Went Wrong";
					$type    = "danger";
					$this->emptyAddView( $message, $type );
				}


			} else {
				$subscribers = Subscriber::GetInstance()->getAllSubscribers();
				$data        = [
					'subscribers' => $subscribers,
				];
				$this->view( 'subscribers/index', $data );

			}
		} else {
			$message = 0;
			$type    = 0;
			$this->emptyAddView( $message, $type );

		}
	}

	private function emptyAddView( $message, $type ) {
		$packages  = Package::GetInstance()->getAll();
		$locations = Location::GetInstance()->getAll();
		$data      = [

			'packages'  => $packages,
			'locations' => $locations,
			'message'   => $message,
			'type'      => $type,
		];
		$this->view( 'subscribers/add', $data );
	}

	public function show( $id = 0 ) {
		$subscriber = new Subscriber();
		$subscriber = $subscriber->getBySubscriberId( $id );
		$data       = [
			'subscriber' => $subscriber,
		];
		$this->view( 'subscribers/edit', $data );
	}

	public function edit() {

		if ( POST ) {
			$validation = new Validation();
			$validation->name( 'name' )->value( $_POST['name'] )->pattern( 'text' )->required();
			$validation->name( 'nid' )->value( $_POST['nid'] )->pattern( 'text' )->required();
			$validation->name( 'phone' )->value( $_POST['phone'] )->pattern( 'text' )->required();
			$validation->name( 'email' )->value( $_POST['email'] )->pattern( 'text' )->required();
			$validation->name( 'email' )->value( $_POST['email'] )->pattern( 'text' )->required();
			$validation->name( 'present_address' )->value( $_POST['present_address'] )->pattern( 'text' )->required();
			$validation->name( 'permanent_address' )->value( $_POST['permanent_address'] )->pattern( 'text' )->required();
			$validation->name( 'package_id' )->value( $_POST['package_id'] )->pattern( 'int' )->required();
			$validation->name( 'location_id' )->value( $_POST['location_id'] )->pattern( 'int' )->required();
			$validation->name( 'location_serial_no' )->value( $_POST['location_serial_no'] )->pattern( 'int' )->required();


			if ( $validation->isSuccess() ) {
				$subscriber                     = new Subscriber();
				$subscriber->id                 = trim( $_POST['id'] );
				$subscriber->name               = trim( $_POST['name'] );
				$subscriber->nid                = trim( $_POST['nid'] );
				$subscriber->phone              = trim( $_POST['phone'] );
				$subscriber->email              = trim( $_POST['email'] );
				$subscriber->present_address    = trim( $_POST['present_address'] );
				$subscriber->permanent_address  = trim( $_POST['permanent_address'] );
				$subscriber->package_id         = trim( $_POST['package_id'] );
				$subscriber->location_id        = trim( $_POST['location_id'] );
				$subscriber->location_serial_no = trim( $_POST['location_serial_no'] );
				$subscriber->registration_no    = 00000;
				$subscriber->status             = 1;
				$subscriber->joining_date       = trim( $_POST['joining_date'] );
				$subscriber->deactivation_date  = "";
				$subscriber->notes              = trim( $_POST['notes'] );
				$new_file                       = new File();
				$nid_file                       = new File();
				$nid_old_file                   = new File();
				if ( $new_file->attach_file( $_FILES['photo'] ) && $nid_file->attach_file( $_FILES['nid_photo'] ) ) {
					//New File directory
					$new_file->upload_dir = 'images/subscribers';
					$nid_file->upload_dir = 'images/subscriber_nid';
					$new_file->file_name  = $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";
					$nid_file->file_name  = "NID" . $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";

					$this->file->upload_dir   = 'images/subscribers';
					$nid_old_file->upload_dir = 'images/subscriber_nid';
					$this->file->file_name    = $_POST['oldPhoto'];
					$nid_old_file->file_name  = $_POST['nid_old_photo'];
					$subscriber->photo        = $new_file->file_name;
					$subscriber->nid_photo    = $nid_file->file_name;
					if ( $subscriber->update() ) {
						//Destroy the old file
						if ( $this->file->destroy() && $nid_old_file->destroy() ) {
							//Save the new File
							if ( $new_file->save() && $nid_file->save() ) {
								redirect( 'subscribers/index' );
							} else {
								$new_file->destroy();
								$nid_file->destroy();
							}
						} else {
							die( 'Could not delete the file' );
						}
					} else {
						die( 'Something went Wrong' );
					}
				} else if ( $new_file->attach_file( $_FILES['photo'] ) ) {
					//New File directory
					$new_file->upload_dir = 'images/subscribers';
					$new_file->file_name  = $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";

					$this->file->upload_dir = 'images/subscribers';

					$this->file->file_name = $_POST['oldPhoto'];

					$subscriber->photo     = $new_file->file_name;
					$subscriber->nid_photo = $_POST['nid_old_photo'];
					if ( $subscriber->update() ) {
						//Destroy the old file
						if ( $this->file->destroy() ) {
							//Save the new File
							if ( $new_file->save() ) {
								redirect( 'subscribers/index' );
							} else {
								$new_file->destroy();
							}
						} else {
							die( 'Could not delete the file' );
						}
					} else {
						die( 'Something went Wrong' );
					}
				} else if ( $nid_file->attach_file( $_FILES['nid_photo'] ) ) {
					//New File directory
					$nid_file->upload_dir     = 'images/subscriber_nid';
					$nid_file->file_name      = "NID" . $subscriber->location_id . $subscriber->registration_no . $subscriber->location_serial_no . ".jpg";
					$nid_old_file->upload_dir = 'images/subscriber_nid';
					$nid_old_file->file_name  = $_POST['nid_old_photo'];
					$subscriber->photo        = $_POST['oldPhoto'];
					$subscriber->nid_photo    = $nid_file->file_name;
					if ( $subscriber->update() ) {
						//Destroy the old file
						if ( $nid_old_file->destroy() ) {
							//Save the new File
							if ( $nid_file->save() ) {
								redirect( 'subscribers/index' );
							} else {
								$nid_file->destroy();
							}
						} else {
							die( 'Could not delete the file' );
						}
					} else {
						die( 'Something went Wrong' );
					}
				} else {
					$subscriber->photo = $_POST['oldPhoto'];
					$subscriber->photo = $_POST['nid_old_photo'];
					if ( $subscriber->update() ) {
						redirect( 'subscribers/index' );
					} else {
						die( 'Something went Wrong' );
					}
				}
			} else {
				echo $validation->displayErrors();
			}
		}
	}

	public function deactivate( $id = 0 ) {
		if ( POST ) {

			$subscriber                    = Subscriber::GetInstance()->getById( $id );
			$subscriber->deactivation_date = trim( $_POST['deactivation_date'] );
			$subscriber->status            = 0;
			$subscriber->package_id        = 0;
			if ( $subscriber->deactivation_date == "" ) {
				$subscriber->deactivation_date = date( date( "Y/m/d" ) );
			}

			/*------------------------Save Subscriber Deactivation-------------------------*/
			if ( $subscriber->update() ) {
				redirect( 'Subscribers/viewDeActiveSubscribers' );
			} else {
				die( 'Something went Wrong' );
			}
		} else {
			$subscriber = new Subscriber();
			$subscriber = $subscriber->getBySubscriberId( $id );
			$data       = [
				'subscriber' => $subscriber,
			];
			$this->view( 'subscribers/deactivate', $data );

		}
	}

	public function activate( $id = 0 ) {
		if ( POST ) {

			$subscriber                    = Subscriber::GetInstance()->getById( $id );
			$subscriber->deactivation_date = trim( $_POST['joining_date'] );
			$subscriber->status            = 1;
			$subscriber->package_id        = trim( $_POST['package_id'] );
			if ( $subscriber->joining_date == "" ) {
				$subscriber->deactivation_date = date( date( "Y/m/d" ) );
			}

			/*------------------------Save Subscriber Deactivation-------------------------*/
			if ( $subscriber->update() ) {
				redirect( 'Subscribers/viewActiveSubscribers' );
			} else {
				die( 'Something went Wrong' );
			}
		} else {
			$packages   = Package::GetInstance()->getAll();
			$subscriber = new Subscriber();
			$subscriber = $subscriber->getBySubscriberId( $id );
			$data       = [
				'subscriber' => $subscriber,
				'packages'   => $packages,
			];
			$this->view( 'subscribers/activate', $data );

		}
	}

	public function viewActiveSubscribers() {
		$subscribers = Subscriber::GetInstance()->getAllActiveSubscribers();
		if ( $subscribers != null ) {
			foreach ( $subscribers as $subscriber ) {
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
			}
		}
		$data = [
			'subscribers' => $subscribers,
		];
		$this->view( 'subscribers/view_active_subscribers', $data );
	}

	public function viewDeActiveSubscribers() {
		$subscribers = Subscriber::GetInstance()->getAllDeactiveSubscribers();
		if ( $subscribers != null ) {
			foreach ( $subscribers as $subscriber ) {
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
			}
		}
		$data = [
			'subscribers' => $subscribers,
		];
		$this->view( 'subscribers/view_deactive_subscribers', $data );
	}

	public function viewSubscribersByLocation() {
		$locations = Location::GetInstance()->getAll();
		$data      = [
			'locations' => $locations,
		];
		$this->view( 'subscribers/view_subscribers_by_location', $data );
	}

	public function getSubscribersByLocation() {
		$subscribers_by_location = Subscriber::GetInstance()->getSubscribersByLocation( $_POST['location_id'] );
		if ( $subscribers_by_location != null ) {
			foreach ( $subscribers_by_location as $subscriber ) {
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
			}
		}

		return jsonResult( $subscribers_by_location );

	}

	public function viewSubscribersByPackage() {
		$packages = Package::GetInstance()->getAll();
		$data     = [
			'packages' => $packages,
		];
		$this->view( 'subscribers/view_subscribers_by_package', $data );
	}

	public function getSubscribersByPackage() {
		$subscribers_by_package = Subscriber::GetInstance()->getSubscribersByLocation( $_POST['package_id'] );
		if ( $subscribers_by_package != null ) {
			foreach ( $subscribers_by_package as $subscriber ) {
				$subscriber->due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
			}
		}

		return jsonResult( $subscribers_by_package );

	}

	public function checkOverlap() {
		$location_id        = $_POST['location_id'];
		$location_serial_no = $_POST['location_serial_no'];
		$data               = [
			'location_id'        => $location_id,
			'location_serial_no' => $location_serial_no,
		];

		$result       = new Subscriber();
		$result->type = 0;

		if ( Subscriber::GetInstance()->fieldsExist( $data ) ) {
			$result->type = 1;
		} else if ( Subscriber::GetInstance()->checkSerialBeforeAdding( $location_id, $location_serial_no ) != 0 ) {
			$result->type    = 2;
			$loc             = Subscriber::GetInstance()->checkSerialBeforeAdding( $location_id, $location_serial_no );
			$result->message = "Serial Should be " . $loc;
		}

		return jsonResult( $result );

	}

	public function doesPhoneExist() {
		$check = Subscriber::GetInstance()->isExist( 'phone', $_GET['phone'] );
		if ( $check == true ) {
			return jsonResult( "Phone Number Already exists in database" );
		} else {
			return jsonResult( true );
		}

	}

	public function doesEmailExist() {
		$check = Subscriber::GetInstance()->isExist( 'email', $_GET['email'] );
		if ( $check == true ) {
			return jsonResult( "Email Address Already exists in database" );
		} else {
			return jsonResult( true );
		}

	}

	public function doesPhoneExistExceptId() {
		$check = Subscriber::GetInstance()->isExistsExceptId( 'phone', $_GET['phone'], $_GET['id'] );
		if ( $check == true ) {
			return jsonResult( "Phone Number Already exists in database" );
		} else {
			return jsonResult( true );
		}

	}

	/* public function checkOverlapExceptId() {
		$id        = $_POST['id'];
		$location_id        = $_POST['location_id'];
		$location_serial_no = $_POST['location_serial_no'];

		$result = new Subscriber();
		$result->type =0;
		if ( Subscriber::GetInstance()->checkOverlapExceptId($id,$location_id,$location_serial_no )!=null ) {
			$result->type =1;
		}
		//Work  eeded heere
		else if (Subscriber::GetInstance()->checkSerialBeforeAdding($location_id ,$location_serial_no)!=0){
			$result->type =2;
			$loc = Subscriber::GetInstance()->checkSerialBeforeAdding($location_id ,$location_serial_no);
			$result->message ="Serial Should be ".$loc;
		}
		return jsonResult( $result );

	}*/

	public function doesEmailExistExceptId() {
		$check = Subscriber::GetInstance()->isExistsExceptId( 'email', $_GET['email'], (int) $_GET['id'] );
		if ( $check == true ) {
			return jsonResult( "Email Address Already exists in database" );
		} else {
			return jsonResult( true );
		}

	}

	public function getSubscribersByLocationAndAccountant() {
		$accountant                             = User::GetInstance()->getById( User::getLoggedInUserId() );
		$accountant_id                          = $accountant->designation_id;
		$subscribers_by_location_and_accountant = Subscriber::GetInstance()->getSubscribersByLocationAndAccountant( $_POST['location_id'], $accountant_id );

		if ( $subscribers_by_location_and_accountant != null ) {
			foreach ( $subscribers_by_location_and_accountant as $subscriber ) {
				$subscriber->current_due_amount = Payment::GetInstance()->getCurrentDueAmountOfSubscriber( $subscriber->id );
				$subscriber->due_amount         = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
				$due_amount                     = $subscriber->due_amount - $subscriber->current_due_amount;
				if ( (float) $due_amount < 0 ) {
					$subscriber->previous_due_amount = Payment::GetInstance()->getDueAmountOfSubscriber( $subscriber->id );
					$subscriber->due_amount          = $subscriber->previous_due_amount + $subscriber->current_due_amount;
				} else {
					$subscriber->previous_due_amount = $subscriber->due_amount - $subscriber->current_due_amount;
				}
			}
		}

		return jsonResult( $subscribers_by_location_and_accountant );
	}

	public function viewNid() {

		$this->view( 'subscribers/nid' );
	}
}