<? include"getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Form Invoice</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" value="text/html; charset=utf-8">
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
			
			
			if($level == "bpt") {
				include "menubpt.php"; 
			} else if ($level == "garuda") {
				include "menugaruda.php";
			} else {
				include "menumember.php"; 
			}
			echo "<br>Login as $email, $msg: <br>";
	
    		$id = $this->input->post('tiketid');
		
			$sqltiket = "SELECT * FROM tiket WHERE id = ? LIMIT 1";
			$querytiket = $this->db->query($sqltiket, array($id)); 
			$rowtiket = $querytiket->row();
			
			$sqluser = "SELECT * FROM users WHERE email = ? LIMIT 1";
			$queryuser = $this->db->query($sqluser, array($rowtiket->email)); 
			$rowuser = $queryuser->row();
			
			$sqlbpt = "SELECT * FROM users WHERE level = ? LIMIT 1";
			$querybpt = $this->db->query($sqlbpt, array('bpt')); 
			$rowbpt = $querybpt->row();
			
			
			
		 	
			
			echo validation_errors(); 
			
			echo form_open('pesantiket'); 
		 ?>
      <br>
      <table width="580" border="0">
        <tr>
          <td><table width="100%" border="0">
            <tr>
              <td width="82%">To : 
                BPT PPI Kansai c/o <? echo $rowbpt->nama; ?>
                <hr>                </td>
              <td width="18%" rowspan="2"><? echo date("D, j F Y",time())?></td>
            </tr>
            <tr>
              <td>For : <? echo $rowuser->nama; ?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0">
            <tr>
              <td width="55%" valign="top"><table width="250" height="55" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr>
                  <td><table width="100%" border="0">
                    <tr>
                      <td width="49%">Ticketing on</td>
                      <td width="51%">: <? $tgl = getdate(strtotime($rowtiket->tglkode)); echo "$tgl[mday]-$tgl[mon]-$tgl[year]"; ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0">
                    <tr>
                      <td width="49%">Reference No.</td>
                      <td width="51%">: <? echo $rowtiket->kode; ?></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width="45%"><strong>Garuda Indonesia<br>
                Reservations and Ticketing</strong><br>
                3rd Flor, OCAT Bldg., 1-4-1 Minatomachi,<br> Naniwa-ku, Osaka, 556-0017 <br>Tel. : 06-6635-3222 <br>Fax. : 06-6635-3198</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><strong>INVOICE</strong><br>
            <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
              <tr>
                <td width="6%" bgcolor="#CCCCCC"><div align="center">No.</div></td>
                <td width="50%" bgcolor="#CCCCCC"><div align="center">Detail</div></td>
                <td width="7%" bgcolor="#CCCCCC"><div align="center">Nbr</div></td>
                <td width="14%" bgcolor="#CCCCCC"><div align="center">Unit Price</div></td>
                <td width="11%" bgcolor="#CCCCCC"><div align="center">Amount</div></td>
                <td width="12%" bgcolor="#CCCCCC"><div align="center">Remarks</div></td>
              </tr>
              <?
				$nourut = 1;
					
				$person = 0;
				$price = 0;
				$adult = 0;
				$child = 0;
				$infant = 0;
				
              	$array = array('penumpang0','penumpang1', 'penumpang2', 'penumpang3', 'penumpang4','penumpang5','penumpang6','penumpang7','penumpang8','penumpang9');
				$count = count($array);
				for ($i = 1; $i < $count; $i++) {
					if($rowtiket->$array[$i]!="0") {
					
              ?>
              			<tr>
                			<td><div align="center"><? echo "$nourut."; $nourut++; $person++; ?></div></td>
                			<td><div align="left">
								<? 
									$umur = $this->Bpt_model->getumur($rowtiket->$array[$i]);
									
									if( $umur > 5) { $tiketage = "Adult"; $adult++; }
									else if($umur > 2) { $tiketage = "Child"; $child++; }
									else { $tiketage = "Infant"; $infant++; }
						
									echo "- ".$this->Bpt_model->getnama($rowtiket->$array[$i])." (".$rowtiket->tipe." ".$tiketage.")";
								?></div></td>
                			<td><div align="center">1</div></td>
                			<td><div align="right">
								<? 
									echo $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P'); 
								?></div></td>
                			<td><div align="right">
                				<? 
									echo $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P'); 
									$hargaorang = $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P'); 
									$price = $price + $hargaorang;
								?>
                			</div></td>
                			<td><div align="left">
								<? 
									echo $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'K'); 
								?></div></td>
              				</tr>
			 <? 
					} //end if
				} 
			 
				if($rowtiket->stop != "0") {
			 ?>
			       <tr>
		                <td><div align="center"><? echo "$nourut."; $nourut++; ?></div></td>
		                <td><div align="left">Stop over : <? echo $rowtiket->stop; ?></div></td>
		                <td><div align="center">
		                	<? echo $person; ?>
		                </div></td>
		                <td><div align="right"><?
	                		switch($rowtiket->stop) {
								case "0" :
									echo "0";
									$pricestop = 0;									
									break;
								case "1" :
									echo "8500";
									$pricestop = 8500;
									break;
								case "2" :
									echo "17000";
									$pricestop = 17000;
									break;
							}
	                	?></div></td>
		                <td><div align="right">
							<?
								$temp = $person * $pricestop;
								echo $temp;
		                		$price = $price + ($person * $pricestop);
		                	?>
						</div></td>
		                <td><div align="center"></div></td>
		              </tr>
			  <?
	  			} //end if stopover
			
				$array = array('adult','child','infant');
				$count = count($array);
				
				for ($i = 0; $i < $count; $i++) {
					if(($adult != 0 AND $array[$i] == 'adult') OR ($child != 0 AND $array[$i] == 'child') OR ($infant != 0 AND $array[$i] == 'infant')) {
			  ?>
			  			<tr>
                			<td><div align="center"><? echo "$nourut."; $nourut++; ?></div></td>
                			<td><div align="left">Airport tax for <? echo $array[$i]; ?></div></td>
                			<td><div align="center">
                				<?
                					switch($array[$i]) {
										case 'adult' :
											echo $adult;
											$tax = $adult;
											$pricetax = 2650;
											break;
										case 'child' :
											echo $child;
											$tax = $child;
											$pricetax = 1330;
											break;
										case 'infant' :
											echo $infant;
											$tax = $infant;
											$pricetax = 1330;
											break;
									}
	                			?>
                			</div></td>
                			<td><div align="right"><? echo $pricetax; ?></div></td>
                			<td><div align="right">
                				<?
                					$temp = $tax * $pricetax;
									echo $temp;
									$price = $price + $temp;
                				?>
                			</div></td>
                			<td><div align="left"></div></td>
              			</tr>
			  <? 	} 
		  		}
			  
				$insurance=1;
				if($insurance) {
			 ?>
			       <tr>
		                <td><div align="center"><? echo "$nourut."; $nourut++; ?></div></td>
		                <td><div align="left">Insurance for <? echo $rowtiket->tipe; ?></div></td>
		                <td><div align="center">
		                	<? echo $person; ?>
		                </div></td>
		                <td><div align="right"><?
	                		switch($rowtiket->tipe) {
								case "OW" :
									echo "530";
									$priceinc = 530;									
									break;
								default :
									echo "1060";
									$priceinc = 1060;
									break;
								
							}
	                	?></div></td>
		                <td><div align="right">
							<?
								$temp = $person * $priceinc;
								echo $temp;
		                		$price = $price + $temp;
		                	?>
						</div></td>
		                <td><div align="left"></div></td>
		              </tr>
			  <?
	  			} //end if insurance
	
				$fuel=1;
				if($fuel) {
			 ?>
			       <tr>
		                <td><div align="center"><? echo "$nourut."; $nourut++; ?></div></td>
		                <td><div align="left">Fuel charge for <? echo $rowtiket->tipe; ?> : <? echo $adult; ?> Adult(s), <? echo $child; ?> Child(s)</div></td>
		                <td><div align="center">
		                	<? $person = $adult + $child; echo $person; ?>
		                </div></td>
		                <td><div align="right"><?
	                		switch($rowtiket->tipe) {
								case "OW" :
									echo "5500";
									$pricefuel = 5500;									
									break;
								default :
									echo "11000";
									$pricefuel = 11000;
									break;

							}
	                	?></div></td>
		                <td><div align="right">
							<?
								$temp = $person * $pricefuel;
								echo $temp;
		                		$price = $price + $temp;
		                	?>
						</div></td>
		                <td><div align="left"></div></td>
		              </tr>
			  <?
	  			} //end if insurance
			  ?>	
			  
              <tr>
                <td colspan="4" bgcolor="#CCCCCC"><div align="center">Total</div></td>
                <td colspan="2" bgcolor="#CCCCCC"><div align="center"><? echo $price; ?> yen</div></td>
              </tr>
          </table>
		  <br>
		  Kindly transfer to the bank account as below with a telegraphic transfer.
		  <br>
		  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
		    <tr><td><br><div align="center"><? echo $this->Bpt_model->getinfo("garudabank")."."; ?></div><br></td></tr>
		  </table>	
		  </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
		
		<input name="tiketid" type="hidden" id="tiketid" value="<? echo $rowtiket->id; ?>">
		<input name="kode" type="hidden" id="kode" value="<? echo $rowtiket->kode; ?>">
		<input name="email" type="hidden" id="email" value="<? echo $rowtiket->email; ?>">
		<input name="invoice" type="hidden" id="invoice" value="create invoice">
	    <input type="submit" name="pemesanan" id="pemesanan" value="Invoice">
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