<?php

namespace App\Controllers\Accounts;

use App\Libraries\Controller;
use App\Libraries\Http\Request;
use App\Libraries\Validation;
use App\Models\Account\Accountant;
use App\Models\File;

class Accountants extends Controller {

	public function __construct() {
		$this->middleware( [ 'Authentication' ] )->all();
		$this->middleware( [ 'Roles' ] )->all()->hasRole( [
			'all' => [ 'Admin' ]
		] );
	}

	public function index() {
		$accountants = Accountant::GetInstance()->getAll();
		$data        = [
			'accountants' => $accountants,
		];
		$this->view( 'accounts/accountants/index', $data );
	}

	public function doesNidNumberExist() {
		$nid_number = Request::get( 'nid_number' );

		$flag = Accountant::GetInstance()->isExist( 'nid_number', $nid_number );

		if ( $flag == true ) {
			return jsonResult( 'NID number already exists' );
		} else {
			return jsonResult( true );
		}
	}

	public function doesContactNumberExist() {
		$contact_number = Request::get( 'contact_number' );

		$flag = Accountant::GetInstance()->isExist( 'contact_number', $contact_number );

		if ( $flag == true ) {
			return jsonResult( 'Contact number already exists' );
		} else {
			return jsonResult( true );
		}
	}

	public function doesEmailExist() {
		$email = Request::get( 'email' );

		$flag = Accountant::GetInstance()->isExist( 'email', $email );

		if ( $flag == true ) {
			return jsonResult( 'Email already exists' );
		} else {
			return jsonResult( true );
		}
	}

	public function doesPhotoExist() {
		$photo_name = Request::get( 'photo' );

		$flag = Accountant::GetInstance()->isExist( 'photo', $photo_name );

		if ( $flag == true ) {
			return jsonResult( 'Photo already exists. Please rename the file if needed' );
		} else {
			return jsonResult( true );
		}
	}

	public function add() {
		if ( POST ) {
			/*-------------------------Generating Student Registration No-------------------------*/
			$last_id_from_db = Accountant::GetInstance()->getLastAccountantId();
			if ( $last_id_from_db == false ) {
				$accountant_serial = sprintf( "%06s", 1 );
			} else {
				$accountant_serial = sprintf( "%06s", $last_id_from_db->id + 1 );
			}
			$registration_no = 'A' . $accountant_serial;
			/*-------------------------Generating registration No code ends here---------------------------------*/

			/*-------------------------Backend validation Starts-----------------------------------*/
			$validation = new Validation();
			$validation->name( 'accountant_name' )->value( Request::post( 'accountant_name' ) )->pattern( 'text' )->required();
			$validation->name( 'nid_number' )->value( Request::post( 'nid_number' ) )->pattern( 'text' )->required();
			$validation->name( 'email' )->value( Request::post( 'email' ) )->pattern( 'email' )->required();
			$validation->name( 'contact_number' )->value( Request::post( 'contact_number' ) )->pattern( 'tel' )->required();
			$validation->name( 'gender' )->value( Request::post( 'gender' ) )->pattern( 'text' )->required();
			$validation->name( 'blood_group' )->value( Request::post( 'blood_group' ) )->pattern( 'text' )->required();
			$validation->name( 'educational_qualification' )->value( Request::post( 'educational_qualification' ) )->pattern( 'text' )->required();
			$validation->name( 'present_address' )->value( Request::post( 'present_address' ) )->pattern( 'text' )->required();
			$validation->name( 'permanent_address' )->value( Request::post( 'permanent_address' ) )->pattern( 'text' )->required();
			$validation->name( 'file_name' )->value( $_FILES['photo']['name'] )->pattern( 'file' )->required();
			/*-------------------------Backend validation Ends-----------------------------------*/

			if ( $validation->isSuccess() ) {
				if ( Accountant::GetInstance()->isExist( 'nid_number', Request::post( 'nid_number' ) ) ) {
					redirect( 'accounts/accountants/index' );
				} else {
					if ( Accountant::GetInstance()->isExist( 'email', Request::post( 'email' ) ) ) {
						redirect( 'accounts/accountants/index' );
					} else {
						if ( Accountant::GetInstance()->isExist( 'contact_number', Request::post( 'contact_number' ) ) ) {
							redirect( 'accounts/accountants/index' );
						} else {
							if ( Accountant::GetInstance()->isExist( 'photo', $_FILES['photo']['name'] ) ) {
								redirect( 'accounts/accountants/index' );
							} else {
								$accountant                            = new Accountant();
								$file                                  = new File();
								$accountant->registration_no           = $registration_no;
								$accountant->accountant_name           = Request::post( 'accountant_name' );
								$accountant->nid_number                = Request::post( 'nid_number' );
								$accountant->email                     = Request::post( 'email' );
								$accountant->contact_number            = Request::post( 'contact_number' );
								$accountant->gender                    = Request::post( 'gender' );
								$accountant->blood_group               = Request::post( 'blood_group' );
								$accountant->educational_qualification = Request::post( 'educational_qualification' );
								$accountant->present_address           = Request::post( 'present_address' );
								$accountant->permanent_address         = Request::post( 'permanent_address' );

								if ( $file->attach_file( $_FILES['photo'] ) ) {
									$file->upload_dir = 'images/accountants';
									//First save the file in directory
									if ( $file->save() ) {
										$accountant->photo = $file->file_name;
										//Save the accountant
										if ( $accountant->create() ) {
											redirect( 'accounts/accountants/index' );
										} else {
											die( 'Something went Wrong' );
										}
									} else {
										$file->destroy();
									}
								} else {
									die( 'Something went wrong' );
								}
							}
						}
					}
				}
			} else {
				redirect( 'accounts/accountants/index' );
			}
		} else {
			$this->view( 'accounts/accountants/add' );
		}
	}

	public function doesNidNumberExistEdit() {
		$id         = Request::get( 'id' );
		$nid_number = Request::get( 'nid_number' );

		$accountant = Accountant::GetInstance()->getById( $id );

		if ( $accountant->nid_number == $nid_number ) {
			return jsonResult( true );
		} else {
			$flag = Accountant::GetInstance()->isExist( 'nid_number', $nid_number );
			if ( $flag == true ) {
				return jsonResult( 'NID number already exists' );
			} else {
				return jsonResult( true );
			}
		}
	}

	public function doesContactNumberExistEdit() {
		$id             = Request::get( 'id' );
		$contact_number = Request::get( 'contact_number' );

		$accountant = Accountant::GetInstance()->getById( $id );

		if ( $accountant->contact_number == $contact_number ) {
			return jsonResult( true );
		} else {
			$flag = Accountant::GetInstance()->isExist( 'contact_number', $contact_number );
			if ( $flag == true ) {
				return jsonResult( 'Contact number already exists' );
			} else {
				return jsonResult( true );
			}
		}
	}

	public function doesEmailExistEdit() {
		$id    = Request::get( 'id' );
		$email = Request::get( 'email' );

		$accountant = Accountant::GetInstance()->getById( $id );

		if ( $accountant->email == $email ) {
			return jsonResult( true );
		} else {
			$flag = Accountant::GetInstance()->isExist( 'email', $email );
			if ( $flag == true ) {
				return jsonResult( 'Email already exists' );
			} else {
				return jsonResult( true );
			}
		}
	}

	public function edit( $id = 0 ) {
		if ( POST ) {
			$validation = new Validation();
			$validation->name( 'accountant_name' )->value( Request::post( 'accountant_name' ) )->pattern( 'text' )->required();
			$validation->name( 'nid_number' )->value( Request::post( 'nid_number' ) )->pattern( 'text' )->required();
			$validation->name( 'email' )->value( Request::post( 'email' ) )->pattern( 'email' )->required();
			$validation->name( 'contact_number' )->value( Request::post( 'contact_number' ) )->pattern( 'tel' )->required();
			$validation->name( 'gender' )->value( Request::post( 'gender' ) )->pattern( 'text' )->required();
			$validation->name( 'blood_group' )->value( Request::post( 'blood_group' ) )->pattern( 'text' )->required();
			$validation->name( 'educational_qualification' )->value( Request::post( 'educational_qualification' ) )->pattern( 'text' )->required();
			$validation->name( 'present_address' )->value( Request::post( 'present_address' ) )->pattern( 'text' )->required();
			$validation->name( 'permanent_address' )->value( Request::post( 'permanent_address' ) )->pattern( 'text' )->required();
			$validation->name( 'file_name' )->value( $_FILES['photo']['name'] )->pattern( 'file' );

			if ( $validation->isSuccess() ) {

				$previous_accountant = Accountant::GetInstance()->getById( Request::post( 'id' ) );

				$accountant                            = new Accountant();
				$accountant->id                        = Request::post( 'id' );
				$accountant->registration_no           = $previous_accountant->registration_no;
				$accountant->accountant_name           = Request::post( 'accountant_name' );
				$accountant->nid_number                = Request::post( 'nid_number' );
				$accountant->email                     = Request::post( 'email' );
				$accountant->contact_number            = Request::post( 'contact_number' );
				$accountant->gender                    = Request::post( 'gender' );
				$accountant->blood_group               = Request::post( 'blood_group' );
				$accountant->educational_qualification = Request::post( 'educational_qualification' );
				$accountant->present_address           = Request::post( 'present_address' );
				$accountant->permanent_address         = Request::post( 'permanent_address' );

				$old_file = new File();
				$new_file = new File();
				//attaching file , this method will work as a validation method for future
				//returns false if there are no files given
				if ( $new_file->attach_file( $_FILES['photo'] ) ) {
					//New File directoy
					$new_file->upload_dir = 'images/accountants';
					// old file information
					$old_file->upload_dir = 'images/accountants';
					$old_file->file_name  = $_POST['oldPhoto'];
					$accountant->photo    = $new_file->file_name;
					if ( $accountant->update() ) {
						//Destroy the old file
						if ( $old_file->destroy() ) {
							//Save the new File
							if ( $new_file->save() ) {
								redirect( 'accounts/accountants/index' );
							} else {
								$old_file->destroy();
							}
						} else {
							die( 'Couldnt delete the old file' );
						}
					} else {
						die( 'Something went Wrong' );
					}
				} else {
					$accountant->photo = $_POST['oldPhoto'];
					if ( $accountant->update() ) {
						redirect( 'accounts/accountants/index' );
					} else {
						die( 'Something went Wrong' );
					}
				}
				if ( $accountant->update() ) {
					redirect( 'accounts/accountants/index' );
				};
			} else {
				redirect( 'accounts/accountants/index' );
			}
		} else {
			$accountant = Accountant::GetInstance()->getById( $id );
			if ( $accountant->id == null ) {
				redirect( 'accounts/accountants/index' );
			} else {
				$data['accountant'] = $accountant;
				$this->view( 'accounts/accountants/edit', $data );
			}
		}
	}

	public function viewProfile( $id = 0 ) {
		$accountant = Accountant::GetInstance()->getById( $id );
		if ( $accountant->id == null ) {
			redirect( 'accounts/accountants/index' );
		} else {
			$data['accountant'] = $accountant;
			$this->view( 'accounts/accountants/view', $data );
		}
	}
}