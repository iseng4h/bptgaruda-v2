<?php

class Menu extends Controller {

	function Menu()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->helper('url');
		$this->load->library('session');

		$this->load->view('home');
	}
	
	function hargatiket()
	{
		$this->load->library('session');
		$this->load->helper('url');

		$this->load->database();
		
		$prefs = array (
               'show_next_prev'  => TRUE,
               'next_prev_url'   => '/bptgaruda/index.php/menu/hargatiket/',
               'start_day'    => 'monday',
               'month_type'   => 'long',
               'day_type'     => 'short'
            
         );
				
				$prefs['template'] = '

   {table_open}<table border="1" cellpadding="0" cellspacing="0" width=500>{/table_open}

   {heading_row_start}<tr bgcolor="#CCCCCC">{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr>{/week_row_start}
   {week_day_cell}<td align=center bgcolor="#CCCCCC">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr>{/cal_row_start}
   {cal_cell_start}<td align=center bgcolor="#CCCCCC" valign=center halign=center>{/cal_cell_start}

   {cal_cell_content}{content}{/cal_cell_content}
   {cal_cell_content_today}{content}{/cal_cell_content_today}

   {cal_cell_no_content}{day}{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
			
		$this->load->library('calendar', $prefs);
		
		

		$this->load->view('welcome_message');
	}
	
	
	

	
	function activasi()
	{
		$this->load->library('session');
		
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));		
		$this->load->library('form_validation');
		
		$doaktivasi = FALSE;
		
		if($this->input->post('newuser')) {
			
			
			
			$this->form_validation->set_rules('aktivasiemail','Email aktivasi','required');
			$this->form_validation->set_rules('aktivasikode','Kode aktivasi','required');
			
			if ($this->form_validation->run() == FALSE)
			{

				
				
				$doaktivasi = FALSE;
			}
			else
			{
				
				$email = $this->input->post('activasiemail');
				$code = $this->input->post('aktivasikode');
				
				$doaktivasi = TRUE;
			}
		
		} else {
			//http://192.168.11.20/index.php/menu/activasi/q_dhiluna_at_yahoo.com/hkocY
		
			$email = $this->uri->segment(3, 0);
			$code  = $this->uri->segment(4, 0);
		
			$email = str_replace("_at_" ,"@",$email);
			
			$doaktivasi=TRUE;
		
		}
		
		
		if($doaktivasi) {
		
			$this->load->database();
		
		
			$sql = "SELECT * FROM users WHERE email = ? AND activecode = ? AND status = ? LIMIT 1";

			$query = $this->db->query($sql, array($email, $code, '0' )); 
		
		
			$row = $query->row();
		
			if (empty($row))
			{
				$this->load->helper(array('form', 'url'));
		
				$this->load->library('form_validation');	
			
				$data['msg'] = "Aktivasi gagal";
				$this->load->view('formregistrasi', $data);
			
			} else {
					
				$data = array(
			                    'email' => $row->email,
								'nama'  => $row->nama,
			                    'tgl' 	=> $row->tgl
			               );

				$this->db->insert('penumpang', $data); 
			
				$this->db->where('email',$row->email);
				$this->db->update('users',array('status' => '1'));
		
				//$this->load->helper(array('form', 'url'));		
				//$this->load->library('form_validation');	
				
				$this->Bpt_model->mkdir_data($row->email);
								
				$data['msg'] = $row->email." telah aktif";
				$this->load->view('formlogin',$data);
			
			}
		} else { //end do aktivasi
		
			$data['msg'] = "Aktivasi gagal terus";
			$this->load->view('formregistrasi', $data);
		}
	}
	
	function cekharga()
	{
		$this->load->view('cekharga');	
	}
	
	function caridatapribadi()
	{
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = 'DATA PRIBADI';
		  $data['cari'] = TRUE;
		  
		  $this->load->view('formsearch',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
		
	}
	
	function caritransaksi()
	{
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = 'TRANSAKSI';
		  $data['cari'] = TRUE;
		  
		  $this->load->view('formsearch',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
		
	}

	function faq()
	{
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
	
		
		$this->load->view('faq');
	}
	
	function logout()
	{
		$this->load->library('session');
		$this->load->view('logout');	
		
		$this->load->helper('url');
		$this->load->view('home');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
