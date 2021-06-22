<table width="180" border="0">
  <tr>
     <td>
        <? 
			$year = date("Y");
			$month = date("m");
			$link = "menu/hargatiket/".$year."/".$month;
			echo anchor($link, 'Harga Tiket');	
		?>
     </td>
  </tr>
  <tr>
    <td><? echo anchor('jadwal/','Cek Jadwal'); ?></td>
  </tr>
  <tr>
    <td><? echo anchor('registrasi/','Registrasi'); ?></td>
  </tr>
  <tr>
    <td><? echo anchor('login/','Login'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td><? echo anchor('menu/faq', 'FAQ'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <? 
		if(($level == 'bpt' ) && $login == '1') 
		{
			if($level == 'bpt') $webnya='admin'; else $webnya='member';
			
			echo "<tr><td>EDIT DATA</td></td>";
			echo "<tr><td>* <a href=\"/bptgaruda/index.php/menu/caritransaksi/\">Transaksi</a></td></td>";
			echo "<tr><td>* <a href=\"/bptgaruda/index.php/menu/caridatapribadi/\">Data user</a></td></td>";
			echo "<tr><td>TRANSAKSI</td></td>";

			$this->db->like('status', '1. BOOKING');
			$this->db->from('tiket');

			echo "<tr><td>* Booking(<a href=\"/bptgaruda/index.php/pesantiket/booking/\">".$this->db->count_all_results()."</a>)</td></td>";

			$this->db->like('status', '2. WAITING');
			$this->db->from('tiket');
			
			echo "<tr><td>* Waiting(<a href=\"/bptgaruda/index.php/pesantiket/waiting/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '3. KONFIRM');
			$this->db->from('tiket');
			
			echo "<tr><td>* Konfirm(<a href=\"/bptgaruda/index.php/pesantiket/konfirm/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '4. INVOICE');
			$this->db->from('tiket');
			
			echo "<tr><td>* Invoice(<a href=\"/bptgaruda/index.php/pesantiket/invoice/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '5. BAYAR');
			$this->db->from('tiket');
			
			echo "<tr><td>* Bayar(<a href=\"/bptgaruda/index.php/pesantiket/bayar/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '6. TRANSFER');
			$this->db->from('tiket');
			
			echo "<tr><td>* Transfer(<a href=\"/bptgaruda/index.php/pesantiket/transfer/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '7. TIKET');
			$this->db->from('tiket');
			
			echo "<tr><td>* Tiket(<a href=\"/bptgaruda/index.php/pesantiket/tiket/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '8. FINISH');
			$this->db->from('tiket');
			
			echo "<tr><td>* Finish(<a href=\"/bptgaruda/index.php/pesantiket/finish/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			$this->db->like('status', '9. CANCEL');
			$this->db->from('tiket');
			
			echo "<tr><td>* Cancel(<a href=\"/bptgaruda/index.php/pesantiket/cancel/\">".$this->db->count_all_results()."</a>)</td></td>";
			
			
		}
  ?>
</table>
