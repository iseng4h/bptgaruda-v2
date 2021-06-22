<? include"getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Data Pribadi</title>
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
		<p>
		  <? 
			$email = $this->session->userdata('email');
			$level = $this->session->userdata('level');
			$login = $this->session->userdata('login');
			
			if($level == "bpt") {
				include "menubpt.php"; 
				if($cari) $emailcari=$msg; else $emailcari = $email;
			} else if ($level == "garuda") {
				include "menugaruda.php";
				$emailcari=$email;
			} else {
				include "menumember.php";
			    $emailcari = $email;
			}
			
			echo "<br>Login as $email, Perubahan data: <br>";
			
			$this->load->database();
			
			$sql = "SELECT * FROM users WHERE email = ?  LIMIT 1";
			$query = $this->db->query($sql, array($emailcari)); 
		
			$row = $query->row();
			
			if(!empty($row)) {
		
		?>
		  
    </p>
      <?php echo validation_errors(); echo $msg; ?><br>
	  <?php
	  	$att = array('id' => 'datapribadi');
	  	
		
	
		echo form_open('member',$att); 
		
			
	  ?>
        <table width="500" border="1">
          <tr>
            <td width="180">Email</td>
            <td width="310"><label>
              <input name="email" type="text" id="email" value="<? echo $row->email; ?>" readonly="readonly">
            </label>
            </td>
          </tr>
		  <tr>
			<td>Folder status</td>
			<td><?
				if($this->Bpt_model->mkdir_data($row->email)) echo "OK"; else echo "Error"
				?>
			</td>
		  </tr>
		
		<tr>
            <td>Status</td>
            <td><label>
			  <? if($level == "bpt") {?>
              <select name="status" id="status">
                <option value="1"     <? if ($row->status == "1") { echo "selected"; }?> >Aktif</option>
                <option value="0"     <? if ($row->status == "0") { echo "selected"; }?> >Non-aktif</option>
                
              </select>
			  <? } else { 
				echo '<input name="status" type="hidden" id="status" value="'.$row->status.'">'; 
				if($row->status) { echo "Aktif"; } else { echo "Non-Aktif"; }
			  } ?>
            </label></td>
          </tr>	
		
          <tr>
            <td>Password</td>
            <td><? if($level == "bpt") $inputan='text'; else $inputan='password'; ?><label>
              <input name="password" type="<? echo $inputan; ?>" id="password" value="<? echo $row->password; ?>">
            </label></td>
          </tr>
          <tr>
            <td>Password confirm</td>
            <td><input name="passwordconf" type="<? echo $inputan; ?>" id="passwordconf" value="<? echo $row->password; ?>"></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><input name="nama" type="text" id="nama" value="<? echo $row->nama; ?>" size="35" maxlength="35"></td>
          </tr>
          <tr>
            <td>Tanggal lahir</td>
            <td><input name="tgl" type="text" id="tgl" value="<? echo $row->tgl; ?>" size="10" maxlength="10"> 
              YYYY-MM-DD</td>
          </tr>
          <tr>
            <td>Komisariat</td>
            <td><label>
              <select name="komisariat" id="komisariat">
                <option value="okayama"   <? if ($row->komisariat == "okayama") { echo "selected"; }?> >Okayama</option>
                <option value="osaka"     <? if ($row->komisariat == "osaka") { echo "selected"; }?> >Osaka</option>
                <option value="kyoto"     <? if ($row->komisariat == "kyoto") { echo "selected"; }?> >Kyoto</option>
                <option value="kobe"      <? if ($row->komisariat == "kobe") { echo "selected"; }?> >Kobe</option>
                <option value="tokushima" <? if ($row->komisariat == "tokushima") { echo "selected"; }?>>Tokushima</option>
                <option value="lainnya"   <? if ($row->komisariat == "lainnya") { echo "selected"; }?>>Lainnya</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>No HP</td>
            <td><input name="nohp" type="text" id="nohp" value="<? echo $row->nohp; ?>">
              </td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><label>
              <textarea name="alamat" id="alamat" cols="45" rows="5"><? echo $row->alamat; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td colspan="2"><label>
              <div align="center">
                <input type="submit" name="simpan" id="simpan" value="simpan">
              </div>
            </label></td>
          </tr>
        </table>
      </form>
    
    <hr>

    
    <p>List penumpang :
    <?php
		$att = array('id' => 'add');
		$hid = array('memberid' => $row->id,'emailnya' => $row->email );
		echo form_open('member',$att,$hid); 
	?>
        	<label>
            	
				<? if($level == "bpt" || $level == "user") { ?>
          			<input type="submit" name="add" id="add" value="add">
          		<? } ?>
        	</label>
        </form>
    </p>
    <table width="500" border="1">
      <tr>
        <td>Nama</td>
        <td>Usia</td>
        <td>Hubungan</td>
		<td>Dokumen</td>
        <td>Aksi</td>
      </tr>
      <? 
		function getAge( $p_strDate ) {
		    list($Y,$m,$d)    = explode("-",$p_strDate);
		    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		}
		
		$sql = "SELECT * FROM penumpang WHERE email = ? ORDER BY `penumpang`.`id` ASC";
		$query = $this->db->query($sql, array($emailcari)); 
		

		foreach ($query->result() as $row)
		{
	  ?>
      <tr>
        <td><? echo "$row->title $row->nama"; ?></td>
        <td><? echo getAge($row->tgl); ?></td>
        <td><? echo $row->hub; ?></td>
		<td>P:<? echo $this->Bpt_model->cek_file($row->email,$row->id,'paspor'); ?><br>V:<? echo $this->Bpt_model->cek_file($row->email,$row->id,'visa'); ?></td>
        <td>
		<?php
			$att = array('name' => 'edit');
			$hid = array('memberid' => $row->id,'emailnya'=> $row->email );
		
			echo form_open('member','',$hid); 
			
			
		?>
        	<label>
          		<input type="submit" name="edit" id="edit" value="edit">
          		<? if($row->hub != "saya") { ?><input type="submit" name="del"  id="del" value="del"><? } ?>
        	</label>
        </form>
        </td>
      </tr>
      <?
			}
	  ?>
      <tr>
        <td colspan="5"><? echo 'Total penumpang: ' . $query->num_rows(); ?></td>
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