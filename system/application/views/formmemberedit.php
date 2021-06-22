<? include"getsession.php"; ?><html>
<head>
<title>BPT Garuda - Data Penumpang</title>
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
			
			//include "menumember.php"; 
			if($level == "bpt") {
				include "menubpt.php"; 
			} else if ($level == "garuda") {
				include "menugaruda.php";
			} else {
				include "menumember.php";
			}
			
			$idnya = $memberid;
			$emailnya = $emailnya;
			
			if($proses == 'edit') {
				
				echo "<br>Login as $email, Perubahan data penumpang id  $idnya : <br>";
			
				$this->load->database();
			
				$sql = "SELECT * FROM penumpang WHERE id = ?  LIMIT 1";
				$query = $this->db->query($sql, array($idnya)); 
		
				$row = $query->row();
			
			
				$att = array('id' => 'update');
				$hid = array('idnya' => $idnya, 'email' => $emailnya );
			
				$rtitle = $row->title;
				$rnama = $row->nama;
				$rtgl = $row->tgl;
				$rhub = $row->hub;
				
			} else if ($proses == 'add') {
				
				echo "<br>Login as $email, Penambahan data penumpang : <br>";
				
				$att = array('id' => 'add');
				$hid = array('idnya' => $idnya,'email' => $emailnya );
				
				$rtitle = "Mr";
				$rnama = '';
				$rtgl = '';
				$rhub = "orangtua / mertua";
			}
			
	  		echo form_open('member',$att,$hid); 
		
		?>
        <table width="500" border="1">
          <tr>
            <td width="198">Title</td>
            <td width="292"><label>
              <select name="title" id="title" >
                <option value="Mr"  <? if($rtitle == "Mr") { echo "selected"; } ?> >Mr</option>
                <option value="Mrs" <? if($rtitle == "Mrs") { echo "selected"; } ?>>Mrs</option>
                <option value="Ms"  <? if($rtitle == "Ms") { echo "selected"; } ?>>Ms</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><label>
              <input name="nama" type="text" id="nama" value="<? echo $rnama; ?>" size="35" maxlength="35">
            </label></td>
          </tr>
          <tr>
            <td>Tanggl Lahir</td>
            <td><input name="tgl" type="text" id="tgl" value="<? echo $rtgl; ?>" size="10" maxlength="10">
              YYYY-MM-DD</td>
          </tr>
          <tr>
            <td>Hubungan</td>
            <td><label>
			<? if($rhub == "saya" ) { ?>
              <input name="hub" type="text" id="hub" value="<? echo $rhub; ?>" size="10" maxlength="10" readonly="readonly">
            <? } else { ?>
              <select name="hub" id="hub">
                <option value="orangtua / mertua" <? if($rhub == "orangtua / mertua" ) { echo "selected"; } ?> >orangtua / mertua</option>
                <option value="suami / istri"     <? if($rhub == "suami / istri" ) { echo "selected"; } ?>>suami / istri</option>
                <option value="saudara kandung"   <? if($rhub == "saudara kandung" ) { echo "selected"; } ?>>saudara kandung</option>
                <option value="anak"              <? if($rhub == "anak" ) { echo "selected"; } ?>>anak</option>
              </select>
            <? } ?>
            </label></td>
          </tr>
		  <tr>
            <td colspan="2"><label>
              <div align="center">
              <? if($this->input->post('edit')) { ?>
                <input type="submit" name="update" id="update" value="update">
               <? } else { ?>
                <input type="submit" name="tambah" id="tambah" value="tambah">
               <? } ?>
              </div>
            </label></td>
          </tr>
        </table>
      </form>

	<?php 
		echo $error;		
	?>

	<?php 
		$hid = array('email' => $emailnya,'memberid' => $idnya, 'tipeupload' => 'paspor' );
		echo form_open_multipart('member/do_upload','',$hid);
	?>
	<table width="500" border="1">
	  <tr>
		<td width="100">Paspor</td>
		<td><? echo $this->Bpt_model->cek_file($emailnya,$idnya,'paspor'); ?><br><input type="file" name="userfile" size="30" /><input type="submit" value="upload" /></td>
	  </tr>
	</table>
	</form>
	<?php 
		$hid = array('email' => $emailnya,'memberid' => $idnya,'tipeupload' => 'visa' );
		echo form_open_multipart('member/do_upload','',$hid);
	?>
	<table width="500" border="1">
	  <tr>
		<td width="100">Visa</td>
		<td><? echo $this->Bpt_model->cek_file($emailnya,$idnya,'visa'); ?><br><input type="file" name="userfile" size="30" /><input type="submit" value="upload" /></td>
	  </tr>	
    </table>
	</form>
	</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>