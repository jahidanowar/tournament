<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	private $userdata = array();

	function __construct(){
		parent::__construct();
		// $this->not_loggedin();
		$this->load->model('tournament_model', 'tm');
		$this->load->model('User_model');
		$this->load->model('Winner_model', 'wm');
		
	}

	public function index()
	{
		$data = array(
            'page'      =>  'home',
            'title'     =>  'Gamerina',
            'not_loggedin' => $this->session->userdata('id')
        );
		$this->render_page($data);
	}

	public function tournament($slug = NULL){
		$this->load->model('Entry_model', 'em');
		if($slug){

			$result = $this->tm->get_by_slug($slug,TRUE);
			$userdata = $this->User_model->get($this->session->userdata('id'));
			if($result){

				$data = array(
					'title'	=>	$result['title'],
					'page'	=>	'view_tournament',
					'expiry' => $this->check_expiry($result['expiry']), //Check The Tournament Expiry
					'event_expiry' => $this->check_expiry_time($result['event_time']), //Check Event Date and Time
					'tournament_data'	=>	$result,
					'winning_prize'		=>	$this->tm->get_winning_prize($result['winning_prize_id']),
					'winning_data'		=>	$this->wm->get_by_tournament($result['id']),
					'not_loggedin'	=>	$this->session->userdata('id'),
					'userdata'		=>	$userdata,
					'entry_data'	=>	$this->em->get_by_tournament($result['id'])
				);
				$this->render_page($data);
			}
			else{
				show_404();
			}

		}
		else{

			$result = $this->tm->get(NULL,TRUE);
				$new_data = array();
				//Rebind Array with New Data
				foreach($result as $key => $value){
					$new_data[$key] = $value;
					$new_data[$key]['winning_prize'] =  $this->tm->get_winning_prize($value['winning_prize_id']);
					$new_data[$key]['winning_data'] = $this->wm->get_by_tournament($value['id']);
				}
				$data = array(
					'page'	=>	'tournaments',
					'title'	=>	'Tournaments',
					'tournaments'	=>	$new_data,
					'not_loggedin'	=>	$this->session->userdata('id')
				);
				$this->render_page($data);
		}
	}

	function check_expiry($expiry_date){
		$ed = strtotime($expiry_date);
		$td = strtotime(date('Y-m-d'));

		if($td>$ed){
			return "expired";
		}
		else{
			$diff = $td-$ed;
			return abs(floor($diff/(60*60*24)));
		}
	}

	function check_expiry_time($timestamp){
		$result = array();

		$ed = strtotime($timestamp);
		$td = time();

		if($td>$ed){
			return "expired";
		}
		else{
			$diff = $td-$ed;
			$days=abs(floor($diff/(60*60*24)));//seconds/minute*minutes/hour*hours/day)
			$hours=round(($diff-$days*60*60*24)/(60*60));
			$result['days'] = $days;
			$result['hours'] = $hours;
			return $result;
		}
	}

}
