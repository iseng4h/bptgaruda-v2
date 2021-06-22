<? include"getsession.php"; ?>
<html>
<head>
<title>BPT Garuda - Invoice PPI</title>
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


      
 	
            		
           <?
    		$email = $this->session->userdata('email');
			$level = $this->session->userdata('level');
			$login = $this->session->userdata('login');
			
			
			//echo "<br>Login as $email, Detil status pemesanan: <br>";
	
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
			

		 ?>
   
      <table width="500" border="0">
        <tr>
          <td><table width="100%" border="0">
            <tr>
              <td width="82%">To : 
                <? echo $rowuser->nama; ?>
                <hr>                </td>
              <td width="18%" rowspan="2"><? echo date("D, j F Y",time())?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0">
            <tr>
              <td width="60%" valign="top"><table width="250" height="55" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr>
                  <td><table width="100%" border="0">
                    <tr>
                      <td width="30%">Ticketing on</td>
                      <td width="70%">: <? $tgl = getdate(strtotime($rowtiket->tglkode)); echo "$tgl[mday]-$tgl[mon]-$tgl[year]"; ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0">
                    <tr>
                      <td width="30%">Reference No.</td>
                      <td width="70%">: <? echo $rowtiket->kode; ?></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width="40%"><strong><? echo $rowbpt->nama; ?></strong><br>
                Email : garuda@ppikansai.org <br>Email HP : <? echo $rowbpt->email; ?> <br>Tel. : <? echo $rowbpt->nohp; ?></td>
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
									//echo $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P'); 
									$hargaorang = round($this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P')*(100/93)); 
									echo $hargaorang;
								?></div></td>
                			<td><div align="right">
                				<? 
									//echo $this->Bpt_model->getprice($rowtiket->tgldepart, $rowtiket->tipe, $rowtiket->arrive, $tiketage, 'P'); 
									
									echo $hargaorang;
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
                <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong><? echo $price; ?> yen</strong></div></td>
              </tr>
          </table>
		  <p>
		  Mohon transfer sebelum jam 17:00 tanggal <? echo $rowtiket->tglinvoiceout; ?> ke
		  </p>
		 
		  </td>
        </tr>
        <tr>
          <td> 
          <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
		    <tr><td><br>
		    <div align="center"><strong><? echo $this->Bpt_model->getinfo("ppibank1")." an ".$rowbpt->nama."."; ?></strong></div>
		    <br></td></tr>
		  </table>atau
          <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
		    <tr><td><br>
            <div align="center"><strong><? echo $this->Bpt_model->getinfo("ppibank2")." an ".$rowbpt->nama."."; ?></strong></div><br></td></tr>
		  </table>
          </td>
        </tr>
        <tr>
          <td>
          <p>
          Setelah transfer mohon konfirmasi via website atau email 
          </p>
          <p>
          Terima kasih atas kerjasama dan kepercayaan anda menggunakan Garuda Airlines.
          </p>
          </td>
        </tr>
      </table>

</body>
</html>