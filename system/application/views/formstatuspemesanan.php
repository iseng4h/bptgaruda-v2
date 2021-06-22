<? include"getsession.php"; ?><html>
<head>
<title>BPT Garuda - Status Pemesanan</title>
<meta http-equiv="Content-type" value="text/html; charset=utf-8">
<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 10px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

body,td,th {
	font-family: Georgia, Times New Roman, Times, serif;
	font-size: 12px;
}
</style>
</head>
<body>

<table width="800" border="0" align="center">
  <tr>
    <td colspan="3"><? include "header.php"; ?></td>
  </tr>
  <tr>
    <td width="200" valign="top"><?php include"menuuser.php"; ?></td>
    <td width="584" colspan="2" valign="top">
      
        <?
    		$email = $this->session->userdata('email');
			$level = $this->session->userdata('level');
			$login = $this->session->userdata('login');
			
			if($level == "bpt") {
				include "menubpt.php"; 
			} else if ($level == "garuda") {
				include "menugaruda.php";
			} else {
				include "menumember.php"; 
			}
			echo "<br>Login as $email, Status pemesanan $msg: <br>";
			
			
	
    		if($level == "bpt" AND $msg != "PRIBADI") {
				if($msg == "cari") {
					$this->db->from('tiket');
					$this->db->like('kode',$this->input->post('cari'));
					$this->db->or_like('tgldepart',$this->input->post('cari'));
					$query = $this->db->get();
				} else {
					$sql = "SELECT * FROM tiket WHERE status = ? ORDER BY `tiket`.`status` DESC";
					$query = $this->db->query($sql, array($msg));
				}
				
			} else if ($level == "garuda") {
				$sql = "SELECT * FROM tiket WHERE status = ? OR status = ? OR status = ? OR kode = ? ORDER BY `tiket`.`id` ASC";
				$query = $this->db->query($sql, array('1. BOOKING', '3. KONFIRM','6. TRANSFER','')); 
			} else {
				$sql = "SELECT * FROM tiket WHERE email = ? ORDER BY `tiket`.`id` DESC";
				$query = $this->db->query($sql, array($email));
			}
			
			function getAge( $p_strDate ) {
			    list($Y,$m,$d)    = explode("-",$p_strDate);
			    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			}
		
			echo validation_errors(); 

			foreach ($query->result() as $row)
			{
		?>
  <table width="500" border="0">
  <tr>
    <td width="135" bgcolor="#CCCCCC"><strong>Kode: <? echo $row->kode; ?></strong></td>
    <td width="355" bgcolor="#CCCCCC"><table width="350" border="0">
      <tr>
        <td width="161"></td>
        <td width="179"><?php echo form_open('pesantiket'); ?>
          <label>
            <div align="right">
              Aksi:
              <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
              <input type="submit" name="pemesanan" id="pemesanan" value="Lihat">
              <? if ($level == "bpt"  ) echo '<input type="submit" name="pemesanan" id="pemesanan" value="Batal">'; ?>
				
            </div>
          </label>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">Tanggal</td>
    <td>
    <? 
		echo "Tiket tipe : $row->tipe";
		if($row->tipe != "OW") 
		{
			echo " Stop over : $row->stop<br>";
		} else echo "<br>";
		
		echo "$row->tgldepart, $row->depart - $row->arrive<br>";
		if($row->tipe != "OW") 
		{
			echo "$row->tglarrive, $row->arrive - $row->depart";
		}
	?>
    </td>
  </tr>
  <tr>
    <td valign="top">Penumpang</td>
    <td>
    	<?			
			if($row->penumpang1 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang1), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang2 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang2), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang3 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang3), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang4 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang4), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang5 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang5), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang6 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang6), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang7 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang7), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang8 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang8), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
			if($row->penumpang9 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang9), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).") - P:".$this->Bpt_model->cek_file($row2->email,$row2->id,'paspor')." V:".$this->Bpt_model->cek_file($row2->email,$row2->id,'visa')."<br>";
			}
			
		?>
    </td>
  </tr>
  <tr>
	<td>Menu</td>
	<td><? echo $row->menu; ?></td>
  </tr>
  <tr>
    <td valign="top">Status</td>
    <td>
		<? 
			if($row->status == "1. BOOKING" && $level == "garuda") {
				 echo $row->status;
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Garuda Code:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
						<input name="kode" id="kode" size="6" maxlength="6" value="<? echo $row->kode; ?>">
          			    <input type="submit" name="pemesanan" id="pemesanan" value="Kode">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if($row->status == "2. WAITING" && $level == "user") {
				 echo $row->status;
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Permintaan invoice:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
						<input name="tgldepart" type="hidden" id="tgldepart" value="<? echo $row->tgldepart; ?>">
						<?
							$tgldepart=$row->tgldepart;
							$tglnow=date("Y-m-d", time());
							
							$berapahari = (strtotime($tgldepart)-strtotime($tglnow))/86400;
							
							if($berapahari > 7)
							{
								echo '<select name="tglinvoiceout"> <option label="1 Minggu" value="7" selected>H - 1 Minggu</option><option label="Sekarang" value="1">Sekarang</option></select>';
							} else {
								echo '<select name="tglinvoiceout"> <option label="Sekarang" value="1" selected>Sekarang</option></select>';
							}
						?>
						<input type="submit" name="pemesanan" id="pemesanan" value="Konfirm">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if ($row->status == "3. KONFIRM" && $level == "garuda") {
				 echo "$row->status<br>";
				 //echo "<a href=\"$row->invoice\">Download invoice</a>";
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Aksi:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
						<input name="invoice" type="hidden" id="invoice" value="cek invoice">
          			    <input type="submit" name="pemesanan" id="pemesanan" value="Invoice">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if ($row->status == "4. INVOICE" && $level == "user") {
				 echo "$row->status<br>";
				 echo "User invoice : <a href=\"/bptgaruda/$row->invoice1\">Download</a>";
				 if ($level == "bpt") {
					echo "BPT invoice : <a href=\"/bptgaruda/$row->invoice2\">Download</a>";
				 }
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Setelah mentransfer ke PPI klik:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
          			    <input type="submit" name="pemesanan" id="pemesanan" value="Bayar">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if ($row->status == "5. BAYAR" && $level == "bpt") {
				 echo "$row->status pada tanggal $row->tglbayar<br>";
				 if ($level == "user" OR $level=="bpt") {
				 	echo "User invoice : <a href=\"/bptgaruda/$row->invoice1\">Download</a><br>";
				 }
				 if ($level == "bpt") {
					echo "BPT invoice : <a href=\"/bptgaruda/$row->invoice2\">Download</a>";
				 }
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Aksi:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
          			    <input type="submit" name="pemesanan" id="pemesanan" value="Transfer">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if ($row->status == "6. TRANSFER" && $level == "garuda") {
				 echo "$row->status pada tanggal $row->tgltransfer<br>";
				 if ($level == "user") {
				 	echo "User invoice : <a href=\"/bptgaruda/$row->invoice1\">Download</a>";
				 }
				 if ($level == "bpt") {
					echo "BPT invoice : <a href=\"/bptgaruda/$row->invoice2\">Download</a>";
				 }
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			     Aksi:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
          			    <input name="kodebooking" type="hidden" id="kodebooking" value="<? echo $row->kode; ?>">
						<input name="email" type="hidden" id="email" value="<? echo $row->email; ?>">

          			    <input type="submit" name="pemesanan" id="pemesanan" value="Tiket">
        			    
			</div>
          			</label>
        		</form>
         <?
			} else if ($row->status == "7. TIKET") {
				 echo "$row->status<br>";
				 if ($level == "user" OR $level == "bpt") {
				 	echo "User invoice : <a href=\"/bptgaruda/$row->invoice1\">Download</a><br>";
				 }
				 if ($level == "bpt") {
					echo "BPT invoice : <a href=\"/bptgaruda/$row->invoice2\">Download</a><br>";
				 }
				 echo "Tiket : <a href=\"/bptgaruda/$row->tiket\">Download</a> ";
				 echo '<a href="http://www.garuda-indonesia.com/cgi-bin/ti_p1chkstshq.cgi?button=  Check Status  &bookcode='.$row->kode.'">Cek Online</a>';
				
				 if($level=="bpt")
				 {
					
				 
				 echo form_open('pesantiket'); ?>
          			<label>
            			<div align="right">
         			    <?
         			    	$tgldepart=$row->tgldepart;
							$tglnow=date("Y-m-d", time());
							
							$berapahari = (strtotime($tgldepart)-strtotime($tglnow))/86400;
							
							echo "$berapahari hari menjelang keberangkatan, ";
         			    ?> 
						Aksi:
          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
          			    <input type="submit" name="pemesanan" id="pemesanan" value="Finish">
        			    
			</div>
          			</label>
        		</form>
         <?
				}
			} else 	if ($row->status == "9. CANCEL" && $level == "bpt") {
					 echo "$row->status pada tanggal $row->tglcancel<br>";
					 if (!empty($row->invoice1)) {
					 	echo "User invoice : <a href=\"/bptgaruda/$row->invoice1\">Download</a>";
					 }
					 if (!empty($row->invoice2)) {
						echo "BPT invoice : <a href=\"/bptgaruda/$row->invoice2\">Download</a>";
					 }
					 if(!empty($row->tiket)) {
						echo "Tiket : <a href=\"/bptgaruda/$row->tiket\">Download</a>";
				   	 }
					 
					 echo form_open('pesantiket'); ?>
	          			<label>
	            			<div align="right">
	         			     Aksi:
	          			    <input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
	          			    <input type="submit" name="pemesanan" id="pemesanan" value="Hapus">

				</div>
	          			</label>
	        		</form>
	         <?
				} else {
				echo $row->status;
			}
		 ?>
    </td>
  </tr>
</table><br><br>
<?
			} //end foreach
?>
</td>
	
  </tr>
  <tr>
    <td colspan="3">
	
	</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>