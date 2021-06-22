<?php

class Login extends Controller {
	
	function index()
	{
		
		$this->load->library('session');		
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);

		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		$canlogin = FALSE;
		
		$data['msg'] = "";
		
		if($login)
		{
		  $canlogin = TRUE;
		  
		  
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			$sql = "SELECT * FROM users WHERE email = ? AND password = ? AND status = ? LIMIT 1";

			$query = $this->db->query($sql, array($email, $password, '1')); 
		
		
			$row = $query->row();
			
			if (empty($row) || $this->form_validation->run() == FALSE )
			{
				
				$this->load->view('formlogin',$data);
			}
			else
			{
				
					
				$newdata = array(
			                    'email'     => $row->email,
								'level'     => $row->level,
			                    'login' 	=> TRUE
			               );

				$this->session->set_userdata($newdata);
				
				$level = $this->session->userdata('level');
				
				$canlogin = TRUE;
				

			}
		}
		
		
		if($canlogin) {
			 
			if($level == "user") {
					$this->load->view('formmember',$data);
				} else {
				
				
					$this->load->view('formstatuspemesanan',$data);
		  		}
		}
		
	}
}
?>