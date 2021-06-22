<?php

class Pesantiket extends Controller {
	
	function index()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login) {
		    
			if ($this->input->post('TIKET') == "BOOKING" || $this->input->post('TIKET') == "CHECK SCHEDULE") 
			{
				
				$this->form_validation->set_rules('timeoftrip','Type of Journey','required');
				$this->form_validation->set_rules('Depart','Departure City','required');
				$this->form_validation->set_rules('Arrive','Arrival City','required');
				$this->form_validation->set_rules('DOn','Departure date','required');
				$this->form_validation->set_rules('DMonth','Departure month','required');
				$this->form_validation->set_rules('DYear','Departure year','required');
				$this->form_validation->set_rules('ROn','Return date','required');
				$this->form_validation->set_rules('RMonth','Return month','required');
				$this->form_validation->set_rules('RYear','Return year','required');
			
			} else if ($this->input->post('TIKET') == "CONFIRM BOOKING") {
				
				$this->form_validation->set_rules('email','Email','required');
				$this->form_validation->set_rules('tgldepart','Tgl Depart','required');
				
				$this->form_validation->set_rules('depart','Depart','required');
				$this->form_validation->set_rules('arrive','Arrive','required');
				$this->form_validation->set_rules('tipe','Type','required');
				$this->form_validation->set_rules('stop','Stop','required');
				$this->form_validation->set_rules('kuitansi','Kuitansi','required');
				$this->form_validation->set_rules('menu','Menu','required');
				
				if($this->input->post('tipe') != "OW") {
				  $this->form_validation->set_rules('tglarrive','Tgl Arrive','required');
				}
				
			} else if ($this->input->post('pemesanan') == "Konfirm") {

					$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');
					$this->form_validation->set_rules('tglinvoiceout','Tanggal akan membayar','required');

			} else if ($this->input->post('pemesanan') == "Invoice") {

					$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');
					$this->form_validation->set_rules('invoice','Invoice Action','required');

			} else if ($this->input->post('pemesanan') == "Bayar") {

					$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');

			} else if ($this->input->post('pemesanan') == "Transfer") {

					$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');

			} else if ($this->input->post('pemesanan') == "Tiket") {

					$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');

			} else if ($this->input->post('pemesanan') == "Lihat" || $this->input->post('pemesanan') == "Batal"  || $this->input->post('pemesanan') == "Konfirm Batal" || $this->input->post('pemesanan') == "Hapus" ) {
				
				$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');
				
			} else if ($this->input->post('pemesanan') == "Kode") {
			
				$this->form_validation->set_rules('tiketid','Tiket ID Pemesanan','required');
				$this->form_validation->set_rules('kode','Kode Booking','required');
				
			} else if ($this->input->post('search') == "search") {

				$this->form_validation->set_rules('cari','Tiket ID Pemesanan','required');
				
			} else if ($this->input->post('pemesanan') == "Edit Transaksi") {

					$this->form_validation->set_rules('tiketid','Tiket ID','required');
					//$this->form_validation->set_rules('email','Email','required');
					$this->form_validation->set_rules('tgldepart','Tgl Depart','required');

					$this->form_validation->set_rules('depart','Depart','required');
					$this->form_validation->set_rules('arrive','Arrive','required');
					$this->form_validation->set_rules('tipe','Type','required');
					$this->form_validation->set_rules('stop','Stop','required');
					$this->form_validation->set_rules('kuitansi','Kuitansi','required');
					$this->form_validation->set_rules('menu','Menu','required');

					if($this->input->post('tipe') != "OW") {
					  $this->form_validation->set_rules('tglarrive','Tgl Arrive','required');
					}
					
					/*
					$this->form_validation->set_rules('invoice1','Invoice 1','required');
					$this->form_validation->set_rules('invoice2','Invoice 2','required');
					$this->form_validation->set_rules('tglinvoiceout','Tgl invoice out','required');
					$this->form_validation->set_rules('tglinvoicedeadline','Tgl invoice deadline','required');
					$this->form_validation->set_rules('tiket','Tiket','required');
					*/
			}	
				
			
			//Work
			if ($this->form_validation->run() == TRUE)
			{
				//$data['msg'] = 'Perhatikan jadwal penerbangan dengan teliti';
				
				if ($this->input->post('search') == "search") {
					
					$data['msg'] = 'cari';
  
					$this->load->view('formstatuspemesanan', $data);
					
				} else if($this->input->post('TIKET') == "BOOKING"){
					$data['msg'] = 'Proses booking';
					$this->load->view('formbookingtiket', $data);	

				} else if ($this->input->post('TIKET') == "CONFIRM BOOKING") {
				
					$pax = 0;
					if ($this->input->post('penumpang1')) $pax++;
					if ($this->input->post('penumpang2')) $pax++;
					if ($this->input->post('penumpang3')) $pax++;
					if ($this->input->post('penumpang4')) $pax++;
					if ($this->input->post('penumpang5')) $pax++;
					if ($this->input->post('penumpang6')) $pax++;
					if ($this->input->post('penumpang7')) $pax++;
					if ($this->input->post('penumpang8')) $pax++;
					if ($this->input->post('penumpang9')) $pax++;
					
					if($pax!=0) {
				  	  $data = array(
               			'email' => $this->input->post('email'),
						'status' => '1. BOOKING',
						'pax' => $pax,
						'tgldepart' => $this->input->post('tgldepart'),
						'tglarrive' => $this->input->post('tglarrive'),
						'depart' => $this->input->post('depart'),
						'arrive' => $this->input->post('arrive'),
						'tipe' => $this->input->post('tipe'),
						'stop' => $this->input->post('stop'),
						'kuitansi' => $this->input->post('kuitansi'),
						'menu' => $this->input->post('menu'),
						'penumpang1' => $this->input->post('penumpang1'),
						'penumpang2' => $this->input->post('penumpang2'),
						'penumpang3' => $this->input->post('penumpang3'),
						'penumpang4' => $this->input->post('penumpang4'),
						'penumpang5' => $this->input->post('penumpang5'),
               			'penumpang6' => $this->input->post('penumpang6'),
						'penumpang7' => $this->input->post('penumpang7'),
						'penumpang8' => $this->input->post('penumpang8'),
						'penumpang9' => $this->input->post('penumpang9'),
						'tglpesan' => date("Y-m-d : H:i:s", time())  
               			
            		   );

					   $this->db->insert('tiket', $data); 
					
					   $data['msg'] = 'PRIBADI';
					   $this->load->view('formstatuspemesanan',$data);
					
				   	} else { //pax=0
					   	$data['msg'] = 'Anda tidak memilih penumpang !!! ';	
					  	$this->load->view('formpesantiket', $data);	
					}
				
				} else if ($this->input->post('pemesanan') == "Kode") {

						$data = array(
	              			 'kode' => $this->input->post('kode'),
	            			 'status' => '2. WAITING',
	               			 'tglkode' => date("Y-m-d : H:i:s", time())
	            		);

						$id = $this->input->post('tiketid');

						$this->db->where('id', $id);
						$this->db->update('tiket', $data);

						$data['msg'] = "PRIBADI";
						$this->load->view('formstatuspemesanan');

					
				} else if($this->input->post('pemesanan') == "Konfirm"){
							
							$tglinvoiceout = $this->input->post('tglinvoiceout');
							$tgldepart = $this->input->post('tgldepart');
							
							//$berapahari = (strtotime($tgldepart)-strtotime($tglinvoiceout))/86400;
							
							if($tglinvoiceout == "7")
							{
								 
								$date = explode("-", $tgldepart);
								$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-7,$date[0]));
								
								
								$date = explode("-",$tglinvoiceout);
								$hariinvoiceout = date("D",mktime(0,0,0,$date[1],$date[2],$date[0]));
								
								
								switch ($hariinvoiceout) {
									case "Mon":							
										$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-4,$date[0]));
										break;
									case "Wed":
										$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-1,$date[0]));
										break;
									case "Fri":
										$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-3,$date[0]));
										break;
									case "Sat":
										$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-2,$date[0]));
										break;
									case "Sun":
										$tglinvoiceout = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-3,$date[0]));
										break;
								}
								
								$date = explode("-",$tglinvoiceout);
								$tglinvoicedeadline = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]+7,$date[0]));
								
							} else {
								
								$tglinvoiceout = date("Y-m-d", time());
								
								$berapahari = (strtotime($tgldepart)-strtotime($tglinvoiceout))/86400;
								
								if($berapahari > 7){
									$date = explode("-",$tglinvoiceout);
									$tglinvoicedeadline = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]+7,$date[0]));
								} else {
									$date = explode("-",$tgldepart);
									$tglinvoicedeadline = date("Y-m-d",mktime(0,0,0,$date[1],$date[2]-1,$date[0]));
								}			
							}
							
					  		$data = array(

		            			 'status' => '3. KONFIRM',
								 'tglinvoiceout' => $tglinvoiceout,
								 'tglinvoicedeadline' => $tglinvoicedeadline,
		               			 'tglkonfirm' => date("Y-m-d : H:i:s", time())
		            		);

							$id = $this->input->post('tiketid');

							$this->db->where('id', $id);
							$this->db->update('tiket', $data);

							$data['msg'] = 'PRIBADI';
							$this->load->view('formstatuspemesanan');	

				} else if($this->input->post('pemesanan') == "Invoice") {
						
						if($this->input->post('invoice') == "cek invoice"){
							
							$data['msg'] = $this->input->post('invoice');
							$this->load->view('forminvoice',$data);
								
						} else {
							
							//Create PDF Invoice
							$this->load->plugin('to_pdf');
							$this->load->helper('file'); 
							
							$id = $this->input->post('tiketid');
							$kode = $this->input->post('kode');
							$email = $this->input->post('email');
							
							$emailfolder = str_replace("@" ,"_at_",$email);	
							$dirname = "data/".$emailfolder."/";
							
							$filename = $dirname."invoice_".$kode.".pdf";
							$bptfilename = "bptdata/invoice_bpt_".$kode.".pdf";
							
							// page info here, db calls, etc.  
							$data = array(

				            	'status' => '4. INVOICE',
								'invoice1' => $filename,
								'invoice2' => $bptfilename,
				               	'tglinvoice' => date("Y-m-d : H:i:s", time())
				            );

							$this->db->where('id', $id);
							$this->db->update('tiket', $data);

							$datapdf['title'] = 'INVOICE';
							//$datapdf['content'] = 'Some content...';
							$html = $this->load->view('invoice', $datapdf, true);
							pdf_create($html, $bptfilename, FALSE);
							
							$html = $this->load->view('invoiceppi', $datapdf, true);
							pdf_create($html, $filename, FALSE);
							
							$data['msg'] = $this->input->post('invoice');
							$this->load->view('forminvoice',$data);
						}

				} else if ($this->input->post('pemesanan') == "Bayar") {
						
						$id = $this->input->post('tiketid');

						$data = array(
			            	'status' => '5. BAYAR',
			               	'tglbayar' => date("Y-m-d : H:i:s", time())
			            );

						$this->db->where('id', $id);
						$this->db->update('tiket', $data);
						
						$data['msg'] = 'PRIBADI';
						$this->load->view('formstatuspemesanan',$data);

				} else if ($this->input->post('pemesanan') == "Transfer") {

						$id = $this->input->post('tiketid');

						$data = array(
					          	'status' => '6. TRANSFER',
					            'tgltransfer' => date("Y-m-d : H:i:s", time())
					    );

						$this->db->where('id', $id);
						$this->db->update('tiket', $data);

						$data['msg'] = 'PRIBADI';
						$this->load->view('formstatuspemesanan',$data);

				} else if ($this->input->post('pemesanan') == "Tiket") {

						$id = $this->input->post('tiketid');
						$email = $this->input->post('email');
						$kodebooking = $this->input->post('kodebooking');

						//Create pdf tiket
						$this->load->plugin('to_pdf');
						$this->load->helper('file');

						$emailfolder = str_replace("@" ,"_at_",$email);	
						$dirname = "data/".$emailfolder."/";

						$tiketfilename = $dirname."tiket_".$kodebooking.".pdf";

						$data = array(
							'status' => '7. TIKET',
							'tiket' => $tiketfilename,
							'tgltiket' => date("Y-m-d : H:i:s", time())
						);

						//Site tiket
						//http://www.garuda-indonesia.com/cgi-bin/ti_p1chkstshq.cgi?button=  Check Status  &bookcode=QB6XYL

						$this->db->where('id', $id);
						$this->db->update('tiket', $data);
						
											
						$datapdf['kodebooking'] = $kodebooking;
						
						$html = $this->load->view('tiket', $datapdf, true);
						pdf_create($html, $tiketfilename, FALSE);
						
						$data['msg'] = 'PRIBADI';
						$this->load->view('formstatuspemesanan',$data);

				} else if ($this->input->post('pemesanan') == "Lihat" || $this->input->post('pemesanan') == "Batal") {

					   if ($this->input->post('pemesanan') == "Lihat") {
					   	 $data['msg'] = "Lihat";
					   } else {
					     $data['msg'] = "Batal";
					   }

					   $this->load->view('formdetilstatuspemesanan', $data);

				} else if ($this->input->post('pemesanan') == "Konfirm Batal") {

						$id = $this->input->post('tiketid');
							if($this->input->post('kode') == '') {
								$this->db->delete('tiket', array('id' => $id));
							} else { 
								$data = array(

		            			 'status' => '9. CANCEL',
								 'cancel' => $this->input->post("cancel"),
		               			 'tglcancel' => date("Y-m-d : H:i:s", time())
		            			);

								$id = $this->input->post('tiketid');

								$this->db->where('id', $id);
								$this->db->update('tiket', $data);
							}
						$data['msg'] = "PRIBADI";
						$this->load->view('formstatuspemesanan',$data);

				} else if ($this->input->post('pemesanan') == "Hapus") {

						$id = $this->input->post('tiketid');
				
						$this->db->delete('tiket', array('id' => $id));

						$data['msg'] = "9. CANCEL";
						$this->load->view('formstatuspemesanan',$data);
						
				} else if ($this->input->post('pemesanan') == "Edit Transaksi") {

						$pax = 0;
						if ($this->input->post('penumpang1')) $pax++;
						if ($this->input->post('penumpang2')) $pax++;
						if ($this->input->post('penumpang3')) $pax++;
						if ($this->input->post('penumpang4')) $pax++;
						if ($this->input->post('penumpang5')) $pax++;
						if ($this->input->post('penumpang6')) $pax++;
						if ($this->input->post('penumpang7')) $pax++;
						if ($this->input->post('penumpang8')) $pax++;
						if ($this->input->post('penumpang9')) $pax++;

						if($pax!=0) {
					  	  $data = array(
	               			//'email' => $this->input->post('email'),
							'status' => $this->input->post('status'),
							'pax' => $pax,
							'tgldepart' => $this->input->post('tgldepart'),
							'tglarrive' => $this->input->post('tglarrive'),
							'depart' => $this->input->post('depart'),
							'arrive' => $this->input->post('arrive'),
							'tipe' => $this->input->post('tipe'),
							'stop' => $this->input->post('stop'),
							'kuitansi' => $this->input->post('kuitansi'),
							'menu' => $this->input->post('menu'),
							'penumpang1' => $this->input->post('penumpang1'),
							'penumpang2' => $this->input->post('penumpang2'),
							'penumpang3' => $this->input->post('penumpang3'),
							'penumpang4' => $this->input->post('penumpang4'),
							'penumpang5' => $this->input->post('penumpang5'),
	               			'penumpang6' => $this->input->post('penumpang6'),
							'penumpang7' => $this->input->post('penumpang7'),
							'penumpang8' => $this->input->post('penumpang8'),
							'penumpang9' => $this->input->post('penumpang9'),
							'invoice1' => $this->input->post('invoice1'),
							'invoice2' => $this->input->post('invoice2'),
							'tiket' => $this->input->post('tiket'),
							'tglinvoiceout' => $this->input->post('tglinvoiceout'),
							'tglinvoicedeadline' => $this->input->post('tglinvoicedeadline') 

	            		   );

						   $id = $this->input->post('tiketid');

						   $this->db->where('id', $id);
						   $this->db->update('tiket', $data);
								
						   $data['msg'] = $this->input->post('status');
						   $this->load->view('formstatuspemesanan',$data);

					   	} else { //pax=0
						   	$data['msg'] = 'Anda tidak memilih penumpang !!! ';	
						  	$this->load->view('formpesantiket', $data);	
						}
				}  else { //do pemesanan
					 $data['msg'] = 'Cek jadwal dengan teliti';
					 $this->load->view('formpesantiket', $data);

				} 
				
			} else {//work
					if($this->input->post('search')) {
							$data['msg'] = 'TRANSAKSI';
							$data['cari'] = TRUE;

							$this->load->view('formsearch',$data);
					} else {
						$data['msg'] = 'PRIBADI';
						$this->load->view('formstatuspemesanan',$data);
					}
			}
			
		} else { //login
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
		
	}
	
	function booking()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '1. BOOKING';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function waiting()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '2. WAITING';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function konfirm()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '3. KONFIRM';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function invoice()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '4. INVOICE';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function bayar()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '5. BAYAR';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function transfer()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '6. TRANSFER';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function tiket()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '7. TIKET';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}
	}
	
	function finish()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '8. FINISH';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}		
	}
	
	function cancel()
	{
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Bpt_model','', TRUE);
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		
		$login = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		
		if($login AND $level == "bpt") {
		  $data['msg'] = '9. CANCEL';
		  
		  $this->load->view('formstatuspemesanan',$data);
		} else {
		  $this->load->library('session');
		  $this->load->view('logout');	
		
		  $this->load->view('home');	
		}		
	}
	
}
?>