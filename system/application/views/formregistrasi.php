<? include "getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Registrasi User</title>
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
    <td width="584" colspan="2" align="center" valign="top">
    <div align="left">Wajib diisi untuk pendaftaran anggota baru</div>
    <br>
    
    <span class="error"><?php echo validation_errors(); echo $msg; ?><?php echo form_open('menu/activasi'); ?></span>
    <table width="500" border="0">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Aktivasi pengguna baru</td>
    </tr>
  <tr>
    <td width="150">Email</td>
    <td width="340"><label>
      <input name="aktivasiemail" type="text" id="aktivasiemail" maxlength="35">
    </label></td>
  </tr>
  <tr>
    <td>Kode aktivasi</td>
    <td><input name="aktivasikode" type="text" id="aktivasikode" size="6" maxlength="5"></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#999999"><label>
      <div align="center">
        <input type="submit" name="newuser" id="newuser" value="Aktivasi">
      </div>
    </label></td>
    </tr>
</table><br>
</form>
<?php echo form_open('registrasi'); ?>
    <table width="500" border="0">
      <tr>
    	<td colspan="2" bgcolor="#CCCCCC">Registrasi pengguna baru</td>
    	</tr>
      <tr>
        <td width="150">Email</td>
        <td width="340"><label>Email ini akan digunakan sebagai login di sistem pemesanan ini<br>
          <input name="email" type="text" id="email" size="35" maxlength="35">
          </label></td>
        </tr>
      <tr>
        <td>Password</td>
        <td>Password yang anda inginkan untuk login di sistem reservasi ini<br>
			<input name="password" type="password" id="password" size="21" maxlength="20"></td>
        </tr>
		<tr>
			<td colspan=2><div align="center">Biodata Anda</div></td>
		</tr>
      <tr>
        <td>Nama</td>
        <td><input name="nama" type="text" id="nama" size="30" maxlength="50"></td>
        </tr>
      <tr>
        <td>Tanggal Lahir</td>
        <td><input type="text" name="tgl" id="tgl"> 
          (YYYY-MM-DD)</td>
        </tr>
      <tr>
        <td>No HP</td>
        <td><input type="text" name="nohp" id="nohp"></td>
        </tr>
      <tr>
        <td>Alamat</td>
        <td><textarea name="alamat" cols="50" rows="4" id="alamat"></textarea></td>
        </tr>
      <tr>
        <td>Daerah tempat tinggal</td>
        <td><label>
          <select name="komisariat" id="komisariat">
			<option value="">Silahkan pilih</option>
			<optgroup label="STUDENT">
	
            <option value="okayama" >Okayama</option>
            <option value="osaka">Osaka</option>
            <option value="kyoto">Kyoto</option>
            <option value="kobe">Kobe</option>
            <option value="tokushima">Tokushima</option>
			<optgroup label="NON-STUDENT">
            <option value="lainnya">Lainnya</option>
            </select>
          </label></td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#999999"><label>
          <div align="center">
            <input type="submit" name="newuser" id="newuser" value="Register">
            </div>
          </label></td>
        </tr>
</table>

    
    </form></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>