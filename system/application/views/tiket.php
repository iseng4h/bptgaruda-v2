<html>
<head>
<title>Garuda Indonesia</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" value="text/html; charset=utf-8">
</head>
<body>
<?

//Site tiket
//http://www.garuda-indonesia.com/cgi-bin/ti_p1chkstshq.cgi?button=  Check Status  &bookcode=QB6XYL

//$datapost = "timeoftrip=$timeoftrip&Depart=$Depart&Arrive=$Arrive&DOn=$DOn&DMonth=$DMonth&DYear=$DYear&ROn=$ROn&RMonth=$RMonth&RYear=$RYear";
$datapost = "button=  Check Status  &bookcode=$kodebooking";


$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'www.garuda-indonesia.com/cgi-bin/ti_p1chkstshq.cgi');
//$curl_handle = curl_init("http://www.garuda-indonesia.com/cgi-bin/ti_p1chkstshq.cgi?button=  Check Status  &bookcode=QB6XYL");
//curl_setopt($curl_handle, CURLOPT_HEADER, 0);
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
    //echo $buffer;

    $awal = strpos($buffer,'<pre>' );
    $akhir = strpos($buffer,'</pre>' );

	//echo "$awal $akhir";
	$hasil = substr($buffer,$awal,$akhir-$awal);
	//echo $buffer;
    
	//$hasil = str_replace("allimages" ,"/bptgaruda/images",$hasil);
	//$hasil = str_replace("#8DD9BF" ,"#999999",$hasil);
	//$hasil = str_replace("#D7EFE7" ,"#CCCCCC",$hasil);
	//$hasil = str_replace("width=100%" ,"width=400",$hasil);

	echo "<pre>".$hasil."</pre>";
}


?>
</body>
</html>