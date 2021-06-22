<? include"getsession.php"; ?>
<html>
<head>
<title>Welcome to BPT Garuda - Cek Jadwal</title>

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

Cek Jadwal

  <?php echo validation_errors(); ?><?php echo form_open('jadwal'); ?>


<strong> 

<strong> 
<table width=400 height=50>

<tr>
<td width=200  bgcolor="#999999" align=center>Type Of Journey </td>
<td width=250  bgcolor="#CCCCCC">
		
		<input name="timeoftrip" type="radio" id="oneway1"  onClick="onew()" value="o" checked="checked"/>One Way<br>	
		<input name="timeoftrip" id="oneway0" type="radio" value="r" onClick="roundt()"/>Return</td>

		<input name="seltimeoftrip" type="hidden" value="">

</tr> 

<tr>
<td width=200  bgcolor="#999999" align=center>
Departure City </td>
<td width=250  bgcolor="#CCCCCC">
	<select name="Depart" > 
	<option value="">Please Select</option>
	<optgroup label="DOMESTIC">
		<option value="AMI" >Ampenan</option>

		<option value="BPN" >Balik Papan</option>
		<option value="BTJ" >Banda Aceh</option>
		<option value="TKG" >Bandar Lampung</option>
		<option value="BDJ" >Banjar Masin</option>
		<option value="BTH" >Batam</option>
		<option value="BIK" >Biak</option>

		<option value="DPS" >Denpasar</option>
		<option value="CGK" >Jakarta</option>
		<option value="DJB" >Jambi</option>
		<option value="DJJ" >Jayapura</option>
		<option value="JOG" >Jogyakarta</option>
		<option value="KDI" >Kendari</option>

		<option value="KOE" >Kupang</option>
		<option value="UPG" >Makassar</option>
		<option value="MLG" >Malang</option>
		<option value="MDC" >Manado</option>
		<option value="MES" >Medan</option>
		<option value="PDG" >Padang</option>

		<option value="PKY" >Palangkaraya</option>
		<option value="PLM" >Palembang</option>
		<option value="PGK" >Pangkalpinang</option>
		<option value="PKU" >Pekan Baru</option>
		<option value="PNK" >Pontianak</option>
		<option value="SRG" >Semarang</option>

		<option value="SOC" >Solo</option>
		<option value="SUB">Surabaya</option>
		<option value="TIM" >Timika</option>
		</optgroup>
		<optgroup label="INTERNATIONAL">
		<option value="BKK" >Bangkok</option>
		<option value="BJS" >Beijing</option>

		<option value="BNE" >Brisbane</option>
		<option value="DRW" >Darwin</option>
		<option value="DOH" >Doha</option>
		<option value="CAN" >Guangzhou</option>
		<option value="HKG" >Hongkong</option>		
		<option value="JED" >Jeddah</option>

		<option value="KUL" >Kualalumpur</option>
		<option value="MNL" >Manila</option>
		<option value="MEL" >Melbourne</option>
		<option value="NGO" >Nagoya</option>
		<option value="KIX" selected >Osaka</option>
		<option value="PER" >Perth</option>

		<option value="RUH" >Riyadh</option>
		<option value="SGN" >Saigon</option>
		<option value="SEL" >Seoul</option>
		<option value="SHA" >Shanghai</option>
		<option value="SIN" >Singapore</option>
		<option value="SYD" >Sydney</option>

		<option value="TPE" >Taipei</option>
		<option value="TYO" >Tokyo</option>
	</optgroup>
	
	</select>		
</td>
</tr>  

<tr>
<td width=200  bgcolor="#999999" align=center>Arrival City </td>
<td width=250  bgcolor="#CCCCCC">
	<select name="Arrive" >

	<option value="">Please Select</option>
	<optgroup label="DOMESTIC">
		<option value="AMI" >Ampenan</option>
		<option value="BPN" >Balik Papan</option>
		<option value="BTJ" >Banda Aceh</option>
		<option value="TKG" >Bandar Lampung</option>

		<option value="BDJ" >Banjar Masin</option>
		<option value="BTH" >Batam</option>
		<option value="BIK" >Biak</option>
		<option value="DPS" selected >Denpasar</option>
		<option value="CGK" >Jakarta</option>
		<option value="DJB" >Jambi</option>

		<option value="DJJ" >Jayapura</option>
		<option value="JOG" >Jogyakarta</option>
		<option value="KDI" >Kendari</option>
		<option value="KOE" >Kupang</option>
		<option value="UPG" >Makassar</option>
		<option value="MLG" >Malang</option>

		<option value="MDC" >Manado</option>
		<option value="MES" >Medan</option>
		<option value="PDG" >Padang</option>
		<option value="PKY" >Palangkaraya</option>
		<option value="PLM" >Palembang</option>
		<option value="PGK" >Pangkalpinang</option>

		<option value="PKU" >Pekan Baru</option>
		<option value="PNK" >Pontianak</option>
		<option value="SRG" >Semarang</option>
		<option value="SOC" >Solo</option>
		<option value="SUB" >Surabaya</option>
		<option value="TIM" >Timika</option>

		</optgroup>
		<optgroup label="INTERNATIONAL">
		<option value="BKK" >Bangkok</option>
		<option value="BJS" >Beijing</option>
		<option value="BNE" >Brisbane</option>
		<option value="DRW" >Darwin</option>
		<option value="DOH" >Doha</option>

		<option value="CAN" >Guangzhou</option>
		<option value="HKG" >Hongkong</option>		
		<option value="JED" >Jeddah</option>
		<option value="KUL" >Kualalumpur</option>
		<option value="MNL" >Manila</option>
		<option value="MEL" >Melbourne</option>

		<option value="NGO" >Nagoya</option>
		<option value="KIX">Osaka</option>
		<option value="PER" >Perth</option>
		<option value="RUH" >Riyadh</option>
		<option value="SGN" >Saigon</option>
		<option value="SEL" >Seoul</option>

		<option value="SHA" >Shanghai</option>
		<option value="SIN" >Singapore</option>
		<option value="SYD" >Sydney</option>
		<option value="TPE" >Taipei</option>
		<option value="TYO" >Tokyo</option>
	</optgroup>

	</select>		
</td>
</tr>  
 
<tr>
<td width=200  bgcolor="#999999" align=center>Departure Date
</td>
<td width=250  bgcolor="#CCCCCC">

<?
  $tanggal = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
  $lmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December");
  $smonth = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
 

  $countt = count($tanggal);
  $countm = count($lmonth);
  
  $today = getdate();
  
 
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
     if($today['month'] == $lmonth[$i]) {
	    echo "<option value=$smonth[$i] selected >$lmonth[$i]</option>";
		
	 } else {
		echo "<option value=$smonth[$i] >$lmonth[$i]</option>";	
		
	 }
  }
  echo ("</select>");


	echo "<select name=\"DYear\">";
 
	$now=$today['year'];
	
	for ($i = 0; $i < 3; $i++ ) {
		$now = date("Y",mktime(0, 0, 0, date("m"), date("d"), date("Y")+$i)); 
		if ($now == date("Y")) {
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
</style>



<div class="returndate">
<tr>
<td width=200  bgcolor="#999999" align=center>Return Date</td>
<td width=250  bgcolor="#CCCCCC">
<div class="returndatesel" id="returndatesel">
<?
  echo ("<select name=\"ROn\">");  
  for ($i = 1; $i < $countt; $i++ ) {
	  if($today['mday'] == $i) {
	    echo "<option label=$tanggal[$i] value=\"$i\" selected >$tanggal[$i]</option>";
  	  } else {
	    echo "<option label=$tanggal[$i] value=\"$i\"  >$tanggal[$i]</option>";
	  }	  
  }
  echo ("</select>");
  
  $nextmonth = date("F",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));
  echo("<select name=\"RMonth\">");
  for($i = 0; $i < $countm; $i++) {
     if($nextmonth == $lmonth[$i]) {
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
		if ($now == date("Y")) {
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
<td width=200  bgcolor="#999999" align=center>Action</td>
<td width=250  bgcolor="#CCCCCC">
<input name="Submit" type="submit" value="CHECK SCHEDULE" onClick="ToCheck()">
<br>

(Connect ke Server Garuda, kadang agak lama responnya ) 
</td>
</tr> 

</table>
</strong> 
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