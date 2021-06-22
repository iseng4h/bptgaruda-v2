<?

class Member extends Controller {


	function index()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		if($this->input->post('simpan'))
		{
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required|matches[passwordconf]');
			$this->form_validation->set_rules('passwordconf','Password Confirmation','required');
			$this->form_validation->set_rules('status','Status','required');			
			$this->form_validation->set_rules('nama','Nama','required');
			$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
			$this->form_validation->set_rules('nohp','No HP','required');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('komisariat','Komisariat','required');
			
			
			$sedang = "simpan";
			
		} else if ($this->input->post('add')) {
			
			$this->form_validation->set_rules('emailnya','Email','required|valid_email');
			
			$sedang = $this->input->post('email');
			
		} else if ($this->input->post('edit') || $this->input->post('del')) {
			
			$this->form_validation->set_rules('memberid','ID','required');
			$this->form_validation->set_rules('emailnya','Email','required|valid_email');
			
			$sedang = $this->input->post('memberid');
			
		} else if ($this->input->post('update')) {
			
			$this->form_validation->set_rules('idnya','ID','required');
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('nama','Nama','required');
			$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
			$this->form_validation->set_rules('hub','Hubungan','required');	
			
			$sedang = "Update penumpang";
			
		} else if ($this->input->post('tambah')) {
			
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('nama','Nama','required');
			$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
			$this->form_validation->set_rules('hub','Hubungan','required');	
			
			$sedang = "tambah penumpang";
		} else if ($this->input->post('search')) {
			$this->form_validation->set_rules('cari','Kata kunci','required');
			
			$sedang = "cari data pribadi";
		}
		
		
		//Process
		if ($this->form_validation->run() == FALSE)
		{

			
			
			if($this->input->post('search')) {
				$data['msg'] = 'DATA PRIBADI';
				$data['cari'] = TRUE;

				$this->load->view('formsearch',$data);
			} else {
				$data['msg'] = "error".$sedang;
				$data['cari'] = FALSE;
				
				$this->load->view('formmember',$data);	
			}
			
		}
		else
		{
			if($this->input->post('simpan'))
			{
				$data = array(
               		'email' => set_value('email'),
               		'password' => set_value('password'),
					'status' => set_value('status'),
               		'nama' => set_value('nama'),
			   		'tgl' => set_value('tgl'),
			   		'nohp' => set_value('nohp'),
			   		'alamat' => set_value('alamat'),
			   		'komisariat' => set_value('komisariat')
			   		
            	);
				
				$this->db->where('email',$this->input->post('email'));
				$this->db->update('users',$data);
				
				$data['msg'] = "Data telah terupdate";
				$data['cari'] = FALSE;
				$this->load->view('formmember',$data);
	
			} else if($this->input->post('edit')){
				
				
				$data['msg'] = $sedang;
				$data['error'] = 'Upload file (max: 100KB, format: JPG)';
				
				$data['memberid'] = $this->input->post('memberid');
				$data['emailnya'] = $this->input->post('emailnya');
				$data['proses'] = 'edit';
				
				$this->load->view('formmemberedit',$data);
				
			} else if($this->input->post('del')){
				
				$id = $sedang;
				$this->db->delete('penumpang', array('id' => $id)); 
				
				$data['msg'] = "Penumpang dengan id $id telah dihapus";
				$data['cari'] = FALSE;
				$this->load->view('formmember',$data);
				
			} else if($this->input->post('update')) {
				$data = array(               		
               		'title' => set_value('title'),
               		'nama' => set_value('nama'),
			   		'tgl' => set_value('tgl'),
			   		'hub' => set_value('hub')	   		
            	);
				
				$this->db->where('id',$this->input->post('idnya'));
				$this->db->update('penumpang',$data);
				
				$data['msg'] = "Data penumpang telah update";
				$data['cari'] = FALSE;
				$this->load->view('formmember',$data);
				
			} else if($this->input->post('add')) {
				
				$data['msg'] = $sedang;
				$data['error'] = 'Upload file';
				
				$data['memberid'] = $this->input->post('memberid');
				$data['emailnya'] = $this->input->post('emailnya');
				$data['proses'] = 'add';
					
				$this->load->view('formmemberedit',$data);
				
			} else if($this->input->post('tambah')) {
				
				$data = array(
					'title' => set_value('title'),		  
               		'email' => set_value('email'),
               		'nama' => set_value('nama'),
			   		'tgl' => set_value('tgl'),
					'hub' => set_value('hub')
			   		
            	);

				$this->db->insert('penumpang', $data); 
				
				$data['msg'] = "Data penumpang telah ditambahkan";
				$data['cari'] = FALSE;
				$this->load->view('formmember',$data);
			} else if($this->input->post('search')) {
				
				if($this->input->post('cari') != "iseng4h@gmail.com") {
					$data['msg'] = $this->input->post('cari');
					$data['cari'] = TRUE;
					$this->load->view('formmember',$data);
					
				} else {
					$data['msg'] = 'DATA PRIBADI';
					$data['cari'] = TRUE;

					$this->load->view('formsearch',$data);
				}
				
			}
		
		}
	}
	
	function datapribadi()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$login = $this->session->userdata('login');
		
		if($login) {
		  //$data['msg'] = set_value('name');
		  $data['msg'] = $this->input->post('cari');
		  $data['cari'] = FALSE;
		  $this->load->view('formmember',$data);	
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}

	function pesantiket()
	{
		$this->load->library('session');
		$this->load->database();
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		
		if($login) {
		  $data['msg'] = '';
		  
		  $this->load->view('formpesantiket',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
		
	}
	
	function statuspemesanan()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		
		if($login) {
		  $data['msg'] = 'PRIBADI';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}

	function do_upload()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$email = $this->input->post('email');
		$memberid = $this->input->post('memberid');
		
		$emailfolder = str_replace("@" ,"_at_",$email);	
		$dirname = "./data/".$emailfolder."/";

		$filename = $this->input->post('tipeupload')."_".$memberid;
		$config['upload_path'] = $dirname;
		$config['file_name'] = $filename;
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '100';
		$config['overwrite'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors(),'memberid' => $memberid, 'emailnya' => $email, 'proses' => 'edit');
			
			$this->load->view('formmemberedit', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data(), 'memberid' => $memberid, 'emailnya' => $email, 'proses' => 'edit', 'error' => '');
			
			$this->load->view('formmemberedit', $data);
		}
	}
	
	function logout()
	{
		$this->load->library('session');
		$this->load->view('logout');	
		
		$this->load->helper('url');
		$this->load->view('home');
	}
}
?>