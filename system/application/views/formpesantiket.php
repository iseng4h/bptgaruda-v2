<? include"getsession.php"; ?><html>
<head>
<title>BPT Garuda - Pesan Tiket</title>
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

		<script type="text/javascript">

		function onew() {
			var myTextField2 = document.getElementById("returndatesel");
			myTextField2.style.display="none";
			var mySel = document.getElementById("seltimeoftrip");  
			mySel.value = "0";
		 
		}

		function roundt() {
			var myTextField2 = document.getElementById("returndatesel");
			myTextField2.style.display="block";
			var mySel = document.getElementById("seltimeoftrip");  
			mySel.value = "1";
		}

		</script>


	<script type="text/javascript">

		function ToCheck() {
			if (ToCheckDate()) { 	  		
		 		document.forms.maincheck.submit();
	 		}				 
		}
		
		function ToCheckDate()
		{
			//check : DOn, DMonth, DYear
			//      : ROn, RMonth, RYear
			//
			retY = document.forms.maincheck.RYear.value;
			depY = document.forms.maincheck.DYear.value;
			ropt = document.forms.maincheck.seltimeoftrip.value;
			if (ropt == "1") {
				if (retY < depY ) {
					alert("Return Date less than Departure Date");
					return 0;
				}
				if (retY == depY ) {
					retM = document.forms.maincheck.RMonth.value;
					depM = document.forms.maincheck.DMonth.value;
					if (retM == depM ) {
						retD = document.forms.maincheck.ROn.value;
						depD = document.forms.maincheck.DOn.value;
						if (retD < depD ) {
							alert("Return Date less than Departure Date");
							return 0;						
						}					
					} else {
						if (retM == "Jan")  retM = 1;
						if (retM == "Feb")  retM = 2;
						if (retM == "Mar")  retM = 3;
						if (retM == "Apr")  retM = 4;
						if (retM == "May")  retM = 5;
						if (retM == "Jun")  retM = 6;
						if (retM == "Jul")  retM = 7;
						if (retM == "Aug")  retM = 8;
						if (retM == "Sep")  retM = 9;
						if (retM == "Oct")  retM = 10;
						if (retM == "Nov")  retM = 11;
						if (retM == "Dec")  retM = 12;
											
						if (depM == "Jan")  depM = 1;
						if (depM == "Feb")  depM = 2;
						if (depM == "Mar")  depM = 3;
						if (depM == "Apr")  depM = 4;
						if (depM == "May")  retM = 5;
						if (depM == "Jun")  depM = 6;
						if (depM == "Jul")  depM = 7;
						if (depM == "Aug")  depM = 8;
						if (depM == "Sep")  retM = 9;
						if (depM == "Oct")  depM = 10;
						if (depM == "Nov")  retM = 11;
						if (depM == "Dec")  depM = 12;
						
						if (retM < depM ) {
							alert("Return Date less than Departure Date");
							return 0;						
						}					

					}
				}
				
			}	
			
			return 1;	
		}

	</script>

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
			echo "<br>Login as $email, Pesan tiket: <br>";
	?>
<br>Pilih jadwal yang diinginkan

  <?php echo validation_errors();  ?><?php echo form_open('pesantiket'); ?>


<strong> 

<strong> 
<table width=500 height=50>

<tr>
<td width=100  bgcolor="#999999" align=center>Type Of Journey </td>
<td width=400  bgcolor="#CCCCCC">
		<? if($msg) { $Tipe = $this->input->post('timeoftrip'); } else { $Tipe ="o"; } ?>
		<input name="timeoftrip" type="radio" id="oneway1"  onClick="onew()"   value="o" <? if($Tipe == "o") echo 'checked="checked"' ?>/>One Way<br>	
		<input name="timeoftrip" id="oneway0" type="radio"  onClick="roundt()" value="r" <? if($Tipe == "r") echo 'checked="checked"' ?>/>Return</td>

		<input name="seltimeoftrip" type="hidden" value="">

</tr> 

<tr>
<td width=100  bgcolor="#999999" align=center>
Departure City </td>
<td width=400  bgcolor="#CCCCCC">
	<? if($msg) { $Dep = $this->input->post('Depart'); } else { $Dep ="KIX"; } ?>
	<select name="Depart" > 
	<option value="">Please Select</option>
	<optgroup label="DOMESTIC">

		<option value="DPS" <? if($Dep== "DPS") echo "selected"; ?>>Denpasar</option>
		<option value="CGK" <? if($Dep== "CGK") echo "selected"; ?>>Jakarta</option>

		<option value="JOG" <? if($Dep== "JOG") echo "selected"; ?>>Jogyakarta</option>



		<option value="SUB" <? if($Dep== "SUB") echo "selected"; ?>>Surabaya</option>

		</optgroup>
		<optgroup label="INTERNATIONAL">

		<option value="KIX" <? if($Dep== "KIX") echo "selected"; ?>>Osaka</option>

	</optgroup>
	
	</select> <br>* Untuk saat ini sistem hanya melayani keberangkatan dari OSAKA (KIX)		
</td>
</tr>  

<tr>
<td width=100  bgcolor="#999999" align=center>Arrival City </td>
<td width=400  bgcolor="#CCCCCC">
	<? if($msg) { $Arr = $this->input->post('Arrive'); } else { $Arr ="DPS"; } ?>
    <select name="Arrive" >

	<option value="">Please Select</option>
	<optgroup label="DOMESTIC">

		<option value="DPS" <? if($Arr== "DPS") echo "selected"; ?> >Denpasar</option>
		<option value="CGK" <? if($Arr== "CGK") echo "selected"; ?>>Jakarta</option>

		<option value="JOG" <? if($Arr== "JOG") echo "selected"; ?>>Jogyakarta</option>

		<option value="SUB" <? if($Arr== "SUB") echo "selected"; ?>>Surabaya</option>


		</optgroup>
		<optgroup label="INTERNATIONAL">


		<option value="NGO" <? if($Arr== "NGO") echo "selected"; ?>>Nagoya</option>
		<option value="KIX" <? if($Arr== "KIX") echo "selected"; ?>>Osaka</option>

		<option value="TYO" <? if($Arr== "TYO") echo "selected"; ?>>Tokyo</option>
	</optgroup>

	</select>		
</td>
</tr>  
 
<tr>
<td width=100  bgcolor="#999999" align=center>Departure Date
</td>
<td width=400  bgcolor="#CCCCCC">

<?
  $tanggal = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
  $lmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December");
  $smonth = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
 

  $countt = count($tanggal);
  $countm = count($smonth);
  
  if($msg)
  {
	$today['mday'] = $this->input->post('DOn');  
	$today['month'] = $this->input->post('DMonth');
	$today['year'] = $this->input->post('DYear');
  } else {
  	$today = getdate();
	$today['month'] = date("M",mktime(0, 0, 0, date("m"), date("d"), date("Y")));
  }
 
  
  echo ("<select name=\"DOn\">");  
  for ($i = 1; $i < $countt; $i++ ) {
	  if($today['mday'] == $i) {
	    echo "<option label=$tanggal[$i] value=\"$i\" selected >$tanggal[$i]</option>";
  	  } else {
	    echo "<option label=$tanggal[$i] value=\"$i\"  >$tanggal[$i]</option>";
	  }	  
  }
  echo ("</select>");
  
  
  
  echo("<select name=\"DMonth\">");
  for($i = 0; $i < $countm; $i++) {
     if($today['month'] == $smonth[$i]) {
	    echo "<option value=$smonth[$i] selected >$lmonth[$i]</option>";
		
	 } else {
		echo "<option value=$smonth[$i] >$lmonth[$i]</option>";	
		
	 }
  }
  echo ("</select>");


  echo "<select name=\"DYear\">";
  for ($i = 0; $i < 3; $i++ ) {
    $now = date("Y",mktime(0, 0, 0, date("m"), date("d"), date("Y")+$i)); 
	if ($now == $today['year']) {
	  echo "<option value=$now selected>$now</option>";
	} else {
	  echo "<option value=$now >$now</option>";	
	}
  }
  echo "</select>";
?>



</td>
</tr>  
 
 
<style type="text/css">
.returndatesel { display:none; }

<? if($Tipe == "r") echo ".returndatesel { display:block; }"; ?>
</style>



<div class="returndate">
<tr>
<td width=100  bgcolor="#999999" align=center>Return Date</td>
<td width=400  bgcolor="#CCCCCC">
<div class="returndatesel" id="returndatesel">
<?

  if($msg)
  {
	$today['mday'] = $this->input->post('ROn');  
	$today['month'] = $this->input->post('RMonth');
	$today['year'] = $this->input->post('RYear');
  } else {
  	$today = getdate();
	$today['month'] = date("M",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));
  }
  
  echo ("<select name=\"ROn\">");  
  for ($i = 1; $i < $countt; $i++ ) {
	  if($today['mday'] == $i) {
	    echo "<option label=$tanggal[$i] value=\"$i\" selected >$tanggal[$i]</option>";
  	  } else {
	    echo "<option label=$tanggal[$i] value=\"$i\"  >$tanggal[$i]</option>";
	  }	  
  }
  echo ("</select>");
  
  
  echo("<select name=\"RMonth\">");
  for($i = 0; $i < $countm; $i++) {
     if($today['month'] == $smonth[$i]) {
	    echo "<option value=$smonth[$i] selected >$lmonth[$i]</option>";
		
	 } else {
		echo "<option value=$smonth[$i] >$lmonth[$i]</option>";	
		
	 }
  }
  echo ("</select>");


	echo "<select name=\"RYear\">";
 
	$now=$today['year'];
	
	for ($i = 0; $i < 3; $i++ ) {
		$now = date("Y",mktime(0, 0, 0, date("m"), date("d"), date("Y")+$i)); 
		if ($now == $today['year']) {
		  echo "<option value=$now selected>$now</option>";
		} else {
		  echo "<option value=$now >$now</option>";	
		}
	}
	echo "</select>";
?>

</div>

</td>
</tr> 
</div>

<tr>
<td width=100  bgcolor="#999999" align=center>Action</td>
<td width=400  bgcolor="#CCCCCC">
<input name="TIKET" type="submit" value="CHECK SCHEDULE" onClick="ToCheck()">
<?
	if($msg)
	{
		
		echo "<input name=\"TIKET\" type=\"submit\" value=\"BOOKING\" onClick=\"ToCheck()\">";
	}
?>
<br>

(Connect ke Server Garuda, kadang agak lama responnya ) 
</td>
</tr> 

</table>
</strong> 
</form>

Apabila pada "Date" keluar info selain tanggal silahkan refresh browser anda.<br>
<?
	echo "<br>$msg";
	
	if($msg) 
	{
		  
$timeoftrip=set_value('timeoftrip');
$Depart=set_value('Depart');
$Arrive=set_value('Arrive');
$DOn=set_value('DOn');
$DMonth=set_value('DMonth');
$DYear=set_value('DYear');
$ROn=set_value('ROn');
$RMonth=set_value('RMonth');
$RYear=set_value('RYear');

$datapost = "timeoftrip=$timeoftrip&Depart=$Depart&Arrive=$Arrive&DOn=$DOn&DMonth=$DMonth&DYear=$DYear&ROn=$ROn&RMonth=$RMonth&RYear=$RYear";

$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://garuda-ppikanto.org/checkschedule.php');
curl_setopt($curl_handle,CURLOPT_POST,1);
curl_setopt($curl_handle,CURLOPT_POSTFIELDS,$datapost);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

if (empty($buffer))
{
    print "Sorry, Garuda site is not connected for now.";
}
else
{
    $awal = strpos($buffer,'<!--  BLOG BODY BEGIN -->' );
    $akhir = strpos($buffer,'<!--  BLOG BODY END -->' );
	//echo "$awal $akhir";
	

	$hasil = substr($buffer,$awal,$akhir-$awal);
	
	//echo $buffer;
    
	$hasil = str_replace("allimages" ,"/bptgaruda/images",$hasil);
	$hasil = str_replace("#8DD9BF" ,"#999999",$hasil);
	$hasil = str_replace("#D7EFE7" ,"#CCCCCC",$hasil);
	$hasil = str_replace("width=100%" ,"width=400",$hasil);

	echo $hasil;
	
	
				 
}

	
	}
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