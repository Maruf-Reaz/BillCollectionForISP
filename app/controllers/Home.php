<?php
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 8/15/2018
 * Time: 11:03 PM
 */

namespace App\Controllers;

use App\Libraries\Controller;
use App\Models\Account\Payment;
use App\Models\Subscriber;

class Home extends Controller {

	public function __construct() {
		$this->middleware( 'Authentication' )->except( [ 'about' ] );
	}

	public function index() {
		if ( isLoggedIn() ) {
			//redirect('posts/index');
		}
		$total_subscriber_count    = Subscriber::GetInstance()->getTotalSubscriberCount();
		$active_subscriber_count   = Subscriber::GetInstance()->getActiveSubscriberCount();
		$inactive_subscriber_count = Subscriber::GetInstance()->getInactiveSubscriberCount();
		$subscriber_with_due_count = Payment::GetInstance()->getCountOfSubscriberWithDue();
		$data                      = [
			'title'                     => 'welcome',
			'active_subscriber_count'   => $active_subscriber_count,
			'total_subscriber_count'    => $total_subscriber_count,
			'inactive_subscriber_count' => $inactive_subscriber_count,
			'subscriber_with_due_count' => $subscriber_with_due_count
		];
		$this->view( 'home/index', $data );
	}

	public function about() {
		$data = [ 'title' => 'welcome to about' ];
		$this->view( 'home/about', $data );
	}

	public function notFound() {

		$this->view( 'home/404' );
	}

	public function accessDenied() {

		$this->view( 'home/access_denied' );
	}

	public function home() {
		$data = [];
		$this->view( 'layouts/index', $data );
	}
}
