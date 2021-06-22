<? include"getsession.php"; ?><html>
<head>
<title>BPT Garuda - Booking Tiket</title>
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
			
			include "menumember.php"; 
			echo "<br>Login as $email, Booking tiket: <br>";
			
			$smonth = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
			$countm = count($smonth);
			
	?>
    
    <p>Check data dibawah ini, silahkan update bila perlu</p>
    
  	<?php echo validation_errors(); ?><?php echo form_open('pesantiket'); ?>
      <table width="500" border="0">
        <tr>
          <td width="95" valign="top">Email</td>
          <td width="395"><input name="email" type="hidden" id="email" value="<? echo $email; ?>"><? echo $email; ?></td>
        </tr>
        <tr>
          <td valign="top">Penumpang</td>
          <td>
          
      
      <? 
	
		$sql = "SELECT * FROM penumpang WHERE email = ? ORDER BY `penumpang`.`id` ASC";
		$query = $this->db->query($sql, array($email)); 
		
		$urut = 1;
		foreach ($query->result() as $row)
		{
			$penumpang="penumpang".$urut;			
	  		echo "<INPUT TYPE=CHECKBOX NAME=\"$penumpang\" value=\"$row->id\">$row->nama /$row->title<br>";
	
			$namapenumpang="nama".$urut;
			//echo "<input name=\"$namapenumpang\" type=\"hidden\" id=\"$namapenumpang\" value=\"".$row->nama." /".$row->title."\">";
			$urut++;
		}
		
		 
	  ?>
      
          
          </td>
        </tr>
        <tr>
          <td valign="top">Keberangkatan</td>
          <td>
          
		  <?				
		  		for($i = 0; $i < $countm; $i++) {
     				if($this->input->post('DMonth') == $smonth[$i]) {
	    				$dmonthnum = $i+1;
		
	 				}
					
					if($this->input->post('RMonth') == $smonth[$i]) {
	    				$rmonthnum = $i+1;
		
	 				}
  				}
				
				$tgldepart = $this->input->post('DYear')."-".$dmonthnum."-".$this->input->post('DOn');
				
				$tglarrive = $this->input->post('RYear')."-".$rmonthnum."-".$this->input->post('ROn');
				
				echo "$tgldepart ".$this->input->post('Depart')."-".$this->input->post('Arrive');
		  ?>
          <input name="tgldepart" type="hidden" id="tgldepart" value="<? echo $tgldepart; ?>">
          
          <input name="depart" type="hidden" id="depart" value="<? echo $this->input->post('Depart'); ?>">
          <input name="arrive" type="hidden" id="arrive" value="<? echo $this->input->post('Arrive'); ?>">
          </td>
        </tr>
        
          <?
		  		
				if($this->input->post('timeoftrip') == "r" ) 
				{
					echo '<tr><td valign="top">Kedatangan</td><td>';
					echo "$tglarrive ".$this->input->post('Arrive')."-".$this->input->post('Depart');
		  ?>
          <input name="tglarrive" type="hidden" id="tglarrive" value="<? echo $tglarrive; ?>">
          
          <?
					echo '</td></tr>';
				}
		  ?>
          
        <tr>
          <td valign="top">Jenis tiket</td>
          <td><label>
          	<?
		  		
				if($this->input->post('timeoftrip') == "r" ) 
				{
			?>
            <select name="tipe" id="tipe">
              
              <option value="1Y">1 Year (Open)</option>
              <option value="1M" selected>1 Month (Open)</option>
              <option value="21D">21 Days (Fix)</option>
            </select>
            <?  
				} else {
					echo '<input name="tipe" type="hidden" id="tipe" value="OW">One Way';	
				
				}
			?>
          </label></td>
        </tr>
        <tr>
          <td valign="top">Step over</td>
          <td><label>
            <select name="stop" id="stop">
              <option value="0" selected>0</option>
              <option value="1">1</option>
              <option value="2">2</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td valign="top">Kuitansi</td>
          <td><label>
            <select name="kuitansi" id="kuitansi">
              <option value="Tidak" selected>Tidak</option>
              <option value="Ya">Ya</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td valign="top">Menu</td>
          <td><label>
            <select name="menu" id="menu">
              <option value="Ordinary Meal">Ordinary Meal</option>
              <option value="Muslim Meal" selected>Muslim Meal</option>
              <option value="Hindu Meal">Hindu Meal</option>
              <option value="Vegetarian Meal">Vegetarian Meal</option>
              <option value="Therapeutic Meal">Therapeutic Meal</option>
              <option value="Medical Meal">Medical Meal</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <div align="center">
              <input type="submit" name="TIKET" id="TIKET" value="CONFIRM BOOKING">
              <input type="submit" name="TIKET" id="TIKET" value="CANCEL">
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