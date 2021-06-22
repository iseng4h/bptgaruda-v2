<? include"getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Detil Status Pemesanan</title>
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
			
			
			function getAge( $p_strDate ) {
			    list($Y,$m,$d)    = explode("-",$p_strDate);
			    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			}
			
			
			if($level == "bpt") {
				include "menubpt.php"; 
			} else if ($level == "garuda") {
				include "menugaruda.php";
			} else {
				include "menumember.php"; 
			}
			echo "<br>Login as $email, Detil status pemesanan: <br>";
	
    		if($msg == 'cari') {
				$kodebooking = $this->input->post('cari');

				$sql = "SELECT * FROM tiket WHERE kode = ? LIMIT 1";
				$query = $this->db->query($sql, array($kodebooking)); 
	
			} else {
				$id = $this->input->post('tiketid');

				$sql = "SELECT * FROM tiket WHERE id = ? LIMIT 1";
				$query = $this->db->query($sql, array($id)); 
				
			}
			
			$row = $query->row();
			
			if(!empty($row)) {
			echo validation_errors(); 
			
			echo "<p>";
			
			if($msg == "Batal") {
				 echo form_open('pesantiket'); 
		 ?>
 	  <label>
            		<div align="center">
              			<strong>Apakah anda benar-benar ingin membatalkan transaksi ini ?</strong><br>
              			Aksi:
              			<input name="tiketid" type="hidden" id="tiketid" value="<? echo $row->id; ?>">
						<input name="cancel" type="hidden" id="cancel" value="<? echo $email; ?>">
						<input name="kode" type="hidden" id="kode" value="<? echo $row->kode; ?> ">
              			<input type="submit" name="pemesanan" id="pemesanan" value="Konfirm Batal">
              	
   	  				</div>
</label>
        	</form>
		 <? 
		 	} 
		 
		 	echo "</p>";
		
			echo form_open('pesantiket'); 
		 ?>
      <table width="500" border="0">
        <tr>
          <td width="150" bgcolor="#999999"><strong>Kode: 
		  <? 
			 if($level == "bpt") {
				echo '<input type="text" name="kode" id="kode" size="6" maxlength="6" value="'.$row->kode.'">';
			 } else {
				echo $row->kode;
			 } 
			 
		  ?>
		  </strong></td>
          <td width="340" bgcolor="#999999"><div align="right">
          	<?
          		if($level == "bpt") {
					echo '<input name="tiketid" type="hidden" id="tiketid" value="'.$row->id.'">';
					echo '<input type="submit" name="pemesanan" id="pemesanan" value="Edit Transaksi">';
				}
          	?>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Email</td>
          <td><? echo $row->email; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">PAX(<? echo $row->pax; ?>)</td>
          <td>
          <?

			 	$cari = '(';

				if($row->penumpang1 != "0") { /*echo "- $row->penumpang1 <br>"; $pos = strpos($row->penumpang1, '/') ;*/ $rest = $row->penumpang1; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang2 != "0") { /*echo "- $row->penumpang2 <br>"; $pos = strpos($row->penumpang2, '/') ;*/ $rest = $row->penumpang2; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang3 != "0") { /*echo "- $row->penumpang3 <br>"; $pos = strpos($row->penumpang3, '/') ;*/ $rest = $row->penumpang3; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang4 != "0") { /*echo "- $row->penumpang4 <br>"; $pos = strpos($row->penumpang4, '/') ;*/ $rest = $row->penumpang4; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang5 != "0") { /*echo "- $row->penumpang5 <br>"; $pos = strpos($row->penumpang5, '/') ;*/ $rest = $row->penumpang5; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang6 != "0") { /*echo "- $row->penumpang6 <br>"; $pos = strpos($row->penumpang6, '/') ;*/ $rest = $row->penumpang6; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang7 != "0") { /*echo "- $row->penumpang7 <br>"; $pos = strpos($row->penumpang7, '/') ;*/ $rest = $row->penumpang7; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang8 != "0") { /*echo "- $row->penumpang8 <br>"; $pos = strpos($row->penumpang8, '/') ;*/ $rest = $row->penumpang8; $cari = $cari."id='".$rest."' OR "; } 
				if($row->penumpang9 != "0") { /*echo "- $row->penumpang9 <br>"; $pos = strpos($row->penumpang9, '/') ;*/ $rest = $row->penumpang9; $cari = $cari."id='".$rest."' OR "; } 

				$cari = substr($cari, 0, -3);
				$cari = $cari.")";

		    if($level=="bpt") {
				
				$sqlpenumpang = "SELECT * FROM penumpang WHERE email = ? ORDER BY `penumpang`.`id` ASC";
				$querypenumpang = $this->db->query($sqlpenumpang, array($row->email)); 

				$urut = 1;
				foreach ($querypenumpang->result() as $rowpenumpang)
				{
					$penumpang="penumpang".$urut;	
					if ($row->$penumpang != 0) $checked="checked"; else $checked="";		
			  		echo "<INPUT TYPE=CHECKBOX NAME=\"$penumpang\" value=\"$rowpenumpang->id\" $checked >$rowpenumpang->nama /$rowpenumpang->title<br>";

					$namapenumpang="nama".$urut;
					//echo "<input name=\"$namapenumpang\" type=\"hidden\" id=\"$namapenumpang\" value=\"".$row->nama." /".$row->title."\">";
					$urut++;
				}
				
			} else {
		 
			
			if($row->penumpang1 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang1), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang2 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang2), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang3 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang3), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang4 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang4), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang5 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang5), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang6 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang6), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang7 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang7), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang8 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang8), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			
			if($row->penumpang9 != "0") 
			{ 
				$query2 = $this->db->get_where('penumpang', array('id' => $row->penumpang9), '1');
				$row2 = $query2->row();
				echo "- $row2->nama /$row2->title (".getAge($row2->tgl).")<br>";
			}
			} // end if bpt
		?>
          </td>
        </tr>
		  <tr>
	          <td bgcolor="#CCCCCC">Jenis tiket</td>
	          <td>
			  	<? 
					if($level == "bpt") { ?>
						   <select name="tipe" id="tipe">
							  <option value="OW"  <? if($row->tipe == "OW") echo "selected"; ?> >One Way</option>	
				              <option value="1Y"  <? if($row->tipe == "1Y") echo "selected"; ?>>1 Year</option>
				              <option value="1M"  <? if($row->tipe == "1M") echo "selected"; ?>>1 Month</option>
				              <option value="21D" <? if($row->tipe == "21D") echo "selected"; ?>>21 Days</option>
				            </select>
				<?	} else {
						switch($row->tipe) {
							case "OW" :
								echo "One way";
								break;
							case "1M" :
								echo "1 month";
								break;
							case "1Y" :
								echo "1 year";
								break;
							case "21D" :
								echo "21 Days";
								break;

						}
						
					}
				?>
	          </td>
	        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Jadwal</td>
          <td>
		  	<? 
				if($level == "bpt") { ?>
					Tgl Depart: <input type="text" name="tgldepart" id="tgldepart" value="<? echo $row->tgldepart; ?>" size="10" maxlength="10" >YYYY-MM-DD</br>
					Tgl Arrive: <input type="text" name="tglarrive" id="tglarrive" value="<? echo $row->tglarrive; ?>" size="10" maxlength="10" >YYYY-MM-DD</br>
					Depart Code: <input type="text" name="depart" id="depart" value="<? echo $row->depart; ?>" size="3" maxlength="3"></br>
					Arrive Code: <input type="text" name="arrive" id="arrive" value="<? echo $row->arrive; ?>" size="3" maxlength="3"></br>
			<?	} else {
					echo "$row->tgldepart, $row->depart - $row->arrive<br>";
					if($row->tipe != "OW") 
					{
						echo "$row->tglarrive, $row->arrive - $row->depart";
					}
					
				}
				
			?>
		  </td>
        </tr>
      
        <tr>
          <td bgcolor="#CCCCCC">Stop over</td>
          <td>
			<? 
				if ($level == "bpt") { ?>
					<select name="stop" id="stop">
		              <option value="0" <? if($row->stop == "0") echo "selected"; ?> >0</option>
		              <option value="1" <? if($row->stop == "1") echo "selected"; ?> >1</option>
		              <option value="2" <? if($row->stop == "2") echo "selected"; ?> >2</option>
		            </select>
			<?	} else {
					echo $row->stop;
				}
				 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Kuitansi</td>
          <td>
			<? 
				if($level == "bpt") { ?>
					<select name="kuitansi" id="kuitansi">
		              <option value="Tidak" <? if($row->kuitansi == "Tidak") echo "selected"; ?> >Tidak</option>
		              <option value="Ya"    <? if($row->kuitansi == "Ya") echo "selected"; ?> >Ya</option>
		            </select>
			<?	} else {
					echo $row->kuitansi; 
				}
				
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Menu makanan</td>
          <td>
			<? 
				if($level == "bpt") { ?>
					<select name="menu" id="menu">
		              <option value="Ordinary Meal"    <? if($row->menu == "Ordinary Meal") echo "selected"; ?> >Ordinary Meal</option>
		              <option value="Muslim Meal"      <? if($row->menu == "Muslim Meal") echo "selected"; ?> >Muslim Meal</option>
		              <option value="Hindu Meal"       <? if($row->menu == "Hindu Meal") echo "selected"; ?> >Hindu Meal</option>
		              <option value="Vegetarian Meal"  <? if($row->menu == "Vegetarian Meal") echo "selected"; ?> >Vegetarian Meal</option>
		              <option value="Therapeutic Meal" <? if($row->menu == "Therapeutic Meal") echo "selected"; ?> >Therapeutic Meal</option>
		              <option value="Medical Meal"     <? if($row->menu == "Medical Meal") echo "selected"; ?> >Medical Meal</option>
		            </select>
			<?	} else {
					echo $row->menu;
				}
				 
			?>
		  </td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal pesan</td>
          <td><? echo $row->tglpesan; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal kode</td>
          <td><? if($row->tglkode != "0000-00-00 00:00:00") echo $row->tglkode; else echo "-"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal konfirm</td>
          <td><? if($row->tglkonfirm != "0000-00-00 00:00:00") echo $row->tglkonfirm; else echo "-"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal Invoice</td>
          <td><? if($row->tglinvoice != "0000-00-00 00:00:00") echo $row->tglinvoice; else echo "-"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal bayar</td>
          <td><? if($row->tglbayar != "0000-00-00 00:00:00") echo $row->tglbayar; else echo "-"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Tanggal tiket</td>
          <td><? if($row->tgltiket != "0000-00-00 00:00:00") echo $row->tgltiket; else echo "-"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Status</td>
          <td>
			<? 
				if($level == "bpt") { ?>
					<select name="status" id="status">
						<option value="1. BOOKING" <? if($row->status == "1. BOOKING") echo "selected"; ?> >1. BOOKING</option>
						<option value="2. WAITING" <? if($row->status == "2. WAITING") echo "selected"; ?> >2. WAITING</option>
						<option value="3. KONFIRM" <? if($row->status == "3. KONFIRM") echo "selected"; ?> >3. KONFIRM</option>
						<option value="4. INVOICE" <? if($row->status == "4. INVOICE") echo "selected"; ?> >4. INVOICE</option>
						<option value="5. BAYAR" <? if($row->status == "5. BAYAR") echo "selected"; ?> >5. BAYAR</option>
						<option value="6. TRANSFER" <? if($row->status == "6. TRANSFER") echo "selected"; ?> >6. TRANSFER</option>
						<option value="7. TIKET" <? if($row->status == "7. TIKET") echo "selected"; ?> >7. TIKET</option>
						<option value="8. FINISH" <? if($row->status == "8. FINISH") echo "selected"; ?> >8. FINISH</option>
						<option value="9. CANCEL" <? if($row->status == "9. CANCEL") echo "selected"; ?> >9. CANCEL</option>
					</select>
			<?	} else {
					echo $row->status;
				}
				 
			?>
		  </td>
        </tr>
		<? if($row->invoice1 != "" AND $row->invoice2 != "" ) { ?>
		 <tr>
	          <td bgcolor="#CCCCCC">Invoice</td>
			  <td>
				<?
					
			  		if($level != "bpt") {
						echo "Invoice User : <a href=$row->invoice1 >Download</a>";
					} else {
						echo "Invoice User : <a href=$row->invoice1 >Download</a><br>";
						echo "Invoice BPT : <a href=$row->invoice2 >Download</a><br>";
						echo "Link User <input type=text name=invoice1 id=invoice1 value=$row->invoice1 ><br>";
						echo "Link BPT <input type=text name=invoice2 id=invoice2 value=$row->invoice2 ><br>";
						echo "Tgl out <input type=text name=tglinvoiceout id=tglinvoiceout value=$row->tglinvoiceout size=10 maxlength=10>YYYY-MM-DD<br>";
						echo "Tgl deadline <input type=text name=tglinvoicedeadline id=tglinvoicedeadline value=$row->tglinvoicedeadline size=10 maxlength=10>YYYY-MM-DD<br>";
					}
			  	?>
			  </td>
		</tr>
		<? } else {
			echo "<input type=hidden name=invoice1 id=invoice1 value=$row->invoice1 >";
			echo "<input type=hidden name=invoice2 id=invoice2 value=$row->invoice2 >";
			echo "<input type=hidden name=tglinvoiceout id=tglinvoiceout value=$row->tglinvoiceout >";
			echo "<input type=hidden name=tglinvoicedeadline id=tglinvoicedeadline value=$row->tglinvoicedeadline >";
			
		} ?>
		<? if($row->tiket != "" ) { ?>
		 <tr>
	          <td bgcolor="#CCCCCC">Tiket</td>
			  <td>
				<?
					
			  		if($level != "bpt") {
						echo "Tiket : <a href=$row->tiket >Download</a>";
					} else {
						echo "Tiket : <a href=$row->tiket >Download</a><br>";
						
						echo "Link Tiket <input type=text name=tiket id=tiket value=$row->tiket ><br>";
						
					}
			  	?>
			  </td>
		</tr>
		<? } else {
			echo "<input type=hidden name=tiket id=tiket value=$row->tiket >";
			
		}?>
    </table></form>
   <br>Informasi penumpang:
   		
    
    
    <table width="500" border="0">
      <tr>
      	<td bgcolor="#999999">Id</td>
        <td bgcolor="#999999">Nama</td>
        <td bgcolor="#999999">Umur</td>
        <td bgcolor="#999999">Hubungan</td>
        <td bgcolor="#999999">Dokumen</td>
      </tr>
      <? 
	
		$sql = "SELECT * FROM penumpang WHERE email = ? AND $cari ORDER BY `penumpang`.`id` ASC";
		$query = $this->db->query($sql, array($row->email)); 
		

		foreach ($query->result() as $row)
		{
	  ?>
      <tr>
      	<td bgcolor="#CCCCCC"><? echo $row->id; ?></td>
        <td><? echo "$row->title $row->nama"; ?></td>
        <td><? echo getAge($row->tgl); ?></td>
        <td><? echo $row->hub; ?></td>
        <td><? echo "P:".$this->Bpt_model->cek_file($row->email,$row->id,'paspor')." V:".$this->Bpt_model->cek_file($row->email,$row->id,'visa')."<br>"; ?>
		
      </tr>
      <?
			}
	  ?>
      <tr>
        <td colspan="5"><? //echo 'Total penumpang: ' . $query->num_rows(); ?></td>
        </tr>
    </table> 
 <? } else {
		echo "Data tidak ada !!!";
	}//end if empty row 
 ?>   
    </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>