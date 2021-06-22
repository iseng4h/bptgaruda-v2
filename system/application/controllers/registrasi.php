<?php

class Registrasi extends Controller {
	
	function index()
	{
	
		function _generateCode($length = 5)
		{
   			$password="";
   			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
   			srand((double)microtime()*1000000);
   			for ($i=0; $i<$length; $i++)
   			{
      			$password .= substr ($chars, rand() % strlen($chars), 1);
   			}
   			return $password;
		}
	
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
		$this->form_validation->set_rules('nohp','No HP','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('komisariat','Komisariat','required');
	

		if ($this->form_validation->run() == FALSE)
		{

			$data['msg'] = "";
			$this->load->view('formregistrasi',$data);
		}
		else
		{
				

			$this->load->database();
			$emailnya = set_value('email');
			$kode = _generateCode();
			
			$emaillink = str_replace("@","_at_",$emailnya);
			
			$data = array(
               'email' => set_value('email'),
               'password' => set_value('password'),
               'nama' => set_value('nama'),
			   'tgl' => set_value('tgl'),
			   'nohp' => set_value('nohp'),
			   'alamat' => set_value('alamat'),
			   'komisariat' => set_value('komisariat'),
			   'activecode' => $kode
            );

			$strsql = $this->db->insert_string('users', $data); 
		
			$res = $this->db->query($strsql);
		
			if (!$res) {
  				// if query returns null
  				$msg = $this->db->_error_message();
  				$num = $this->db->_error_number();

  				$data['msg'] = "Error(".$num.") ".$msg;
  				
				
				$this->form_validation->set_message('email', 'Somebody already used this %s $msg');
				$this->load->view('formregistrasi',$data);
				return FALSE;
			} else {
				
				$data = array(
               		'email' => set_value('email'),
               		'nama' => set_value('nama'),
			   		'tgl' => set_value('tgl')
			   		
            	);

				//$this->db->insert('penumpang', $data); 
				
				$this->load->library('email');

				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;

				$this->email->initialize($config);

				$this->email->from('bptgaruda@ppikansai.org', 'BPT Garuda PPI-Kansai');
				$this->email->to($emailnya);
				$this->email->cc('bptgaruda@ppikansai.org');
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('[BPT Garuda-PPI Kansai] Kode dan link aktivasi');

				$isiemail = "
				Selamat datang di pelayanan reservasi tiket Garuda Indonesia - PPI Kansai.
				
				Berikut adalah kode dan link aktivasi untuk akun anda :
				- User : $emailnya
				- Kode : $kode
				
				Anda dapat mengaktifkan akun anda di http://localhost/bptgaruda/index.php/registrasi
				
				atau dengan mengikuti link berikut:
				* http://www.ppikansai.org/bptgaruda/index.php/menu/activasi/$emaillink/$kode
				
				Terima kasih atas perhatiannya
				
				
				
				BPT Garuda - PPI Kansai
				
				";
				$this->email->message($isiemail);
				$this->email->send();

				//echo $this->email->print_debugger();		
				
				
				$data['email'] = set_value('email');
				$this->load->view('hasilregistrasi',$data);
				return TRUE;
			}
			
			
		}
	}
	
	

	
}
?>