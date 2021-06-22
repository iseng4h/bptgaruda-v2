<?
	include"getsession.php";
?>
<html>
<head>
<title>BPT Garuda - Harga Tiket</title>

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
    <td width="200" valign="top"><?php include "menuuser.php"; ?></td>
    <td width="584" colspan="2" valign="top">
    	Harga tiket<br>
        <? 
			
			
			$sql = "SELECT * FROM harga WHERE tahun = ? AND bulan = ? ";
			$query = $this->db->query($sql, array($this->uri->segment(3),$this->uri->segment(4))); 
		
			$row = $query->row();
			
			if(empty($row)) {
				$data = array();
			} else {
			
				$i = 1;
				$warna = "#123456";
			
				foreach ($query->result() as $row)
				{
					$kodeharga = $row->JPDPSOWAK;

					$L = strpos($kodeharga,'L');
					$K = strpos($kodeharga,'K');
					$H = strpos($kodeharga,'H');
				
					if($L !== false) {
						$warna = "#99FF99";
					} else if($H !== false) {
						$warna = "#FF0000";	
					} else {
						$warna = "#FFFF99";	
					}
				
					//$yen = substr($kodeharga,-2);
				
				
				
					$data[$i]	= "<table border=0 width=100%><tr><td align=center bgcolor=$warna>$i<br>$row->JPDPSOWAP</td></tr></table>";
					$i++;
				}
		
			}

			echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4),$data);
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