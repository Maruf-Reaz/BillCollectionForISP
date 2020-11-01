<?php

namespace App\Models;

use App\Libraries\Model;
use App\Libraries\Database;

class Subscriber extends Model {
	protected static $table_name = "db_subscribers";
	protected static $db_fields = [
		'id',
		'name',
		'photo',
		'nid',
		'phone',
		'email',
		'present_address',
		'permanent_address',
		'package_id',
		'location_id',
		'location_serial_no',
		'nid_photo',
		'registration_no',
		'joining_date',
		'deactivation_date',
		'status',
		'notes',
	];
	public $id;
	public $name;
	public $photo;
	public $nid;
	public $phone;
	public $email;
	public $present_address;
	public $permanent_address;
	public $package_id;
	public $location_id;
	public $location_serial_no;
	public $registration_no;
	public $status;
	public $joining_date;
	public $deactivation_date;
	public $nid_photo;
	public $notes;
	protected $db_object;

	public function __construct() {
		$this->db_object = new Database();
	}

	public function getAllSubscribers() {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getBySubscriberId( $id ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE id=:id' );
		$this->db_object->bind( ':id', $id );
		$result = $this->db_object->single();

		return $result;
	}

	public function getAllActiveSubscribers() {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE status=1' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getAllDeactiveSubscribers() {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE status=0' );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getSubscribersByLocation( $location_id ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE location_id=:location_id' );
		$this->db_object->bind( ':location_id', $location_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getActiveSubscribersByLocation( $location_id ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE location_id=:location_id AND status=1' );
		$this->db_object->bind( ':location_id', $location_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function getSubscribersByLocationAndAccountant( $location_id, $accountant_id ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers_view WHERE location_id=:location_id AND status=1 AND accountant_id=:accountant_id ORDER BY location_serial_no ASC' );
		$this->db_object->bind( ':location_id', $location_id );
		$this->db_object->bind( ':accountant_id', $accountant_id );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function updateSerial( $location_id, $location_serial_no ) {
		$this->db_object->query( 'UPDATE db_subscribers SET location_serial_no = location_serial_no + 1 WHERE location_serial_no>=:location_serial_no AND location_id =:location_id' );
		$this->db_object->bind( ':location_id', $location_id );
		$this->db_object->bind( ':location_serial_no', $location_serial_no );
		$this->db_object->execute();
	}

	public function checkOverlapExceptId( $id, $location_id, $location_serial_no ) {
		$this->db_object->query( 'SELECT * FROM db_subscribers WHERE location_id=:location_id AND location_serial_no=:location_serial_no AND id !=:id' );
		$this->db_object->bind( ':id', $id );
		$this->db_object->bind( ':location_id', $location_id );
		$this->db_object->bind( ':location_serial_no', $location_serial_no );
		$result = $this->db_object->resultSet();

		return $result;
	}

	public function checkSerialBeforeAdding( $location_id, $location_serial_no ) {
		$this->db_object->query( 'SELECT MAX(location_serial_no) AS max_loc_sl FROM db_subscribers WHERE location_id=:location_id' );
		$this->db_object->bind( ':location_id', $location_id );
		$result = $this->db_object->single();
		if ( $result->max_loc_sl == null ) {
			$result->max_loc_sl = 0;
		}
		if ( $location_serial_no == $result->max_loc_sl + 1 ) {
			return 0;
		} else {
			return $result->max_loc_sl + 1;
		}
	}

	public function reduceSerial( $old_location_id, $old_location_serial_no ) {
		$this->db_object->query( 'UPDATE db_subscribers SET location_serial_no = location_serial_no -1 WHERE location_serial_no>:old_location_serial_no AND location_id =:location_id' );
		$this->db_object->bind( ':location_id', $old_location_id );
		$this->db_object->bind( ':old_location_serial_no', $old_location_serial_no );
		$this->db_object->execute();
	}

	public function getActiveSubscriberCount() {
		$this->db_object->query( 'SELECT COUNT(id) as active_subscriber_count FROM db_subscribers WHERE status=1' );
		$result = $this->db_object->single();
		return $result->active_subscriber_count;
	}
	public function getTotalSubscriberCount() {
		$this->db_object->query( 'SELECT COUNT(id) as total_subscriber_count FROM db_subscribers ' );
		$result = $this->db_object->single();
		return $result->total_subscriber_count;
	}
	public function getInactiveSubscriberCount() {
		$this->db_object->query( 'SELECT COUNT(id) as inactive_subscriber_count FROM db_subscribers WHERE status=0' );
		$result = $this->db_object->single();
		return $result->inactive_subscriber_count;
	}

}