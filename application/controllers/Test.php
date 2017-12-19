<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->helper('tipos');
		$this->load->model('spot_model');
		$data['row'] = $this->spot_model->get_by_id('1');
		$this->load->view('test_view',$data);
	}

}

/* End of file test.php */
/* Location: ./application/controllers/test.php */