<?php

class Jadwal extends Controller {
	
	function index()
	{
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('timeoftrip','Type of Journey','required');
		$this->form_validation->set_rules('Depart','Departure City','required');
		$this->form_validation->set_rules('Arrive','Arrival City','required');
		$this->form_validation->set_rules('DOn','Departure date','required');
		$this->form_validation->set_rules('DMonth','Departure month','required');
		$this->form_validation->set_rules('DYear','Departure year','required');
		$this->form_validation->set_rules('ROn','Return date','required');
		$this->form_validation->set_rules('RMonth','Return month','required');
		$this->form_validation->set_rules('RYear','Return year','required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('cekjadwal');
		}
		else
		{
			$this->load->view('hasiljadwal');
		}
	}
}
?>