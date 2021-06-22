<? include"getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Hasil Cek Jadwal</title>

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
      <p>hasil
  <?php
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
?>
    </p>
    <p><?php echo anchor('jadwal', 'Try it again!'); ?></p></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>