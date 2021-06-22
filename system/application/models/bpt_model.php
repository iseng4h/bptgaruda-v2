<?
class Bpt_model extends Model {

	
    function Bpt_model()
    {
        parent::Model();
    }
    
	function mkdir_data($email)
	{
		$thisdir = getcwd(); 

		$emailfolder = str_replace("@" ,"_at_",$email);	
		if(is_dir($thisdir."/data/".$emailfolder)) {
			$folder= TRUE;
		} else {
			$folder=FALSE;
			mkdir($thisdir."/data/".$emailfolder);
			chmod($thisdir."/data/".$emailfolder,0777);
		}
		
		return $folder;
	}
	
	function cek_file($email,$id,$filetipe)
	{
		$thisdir = getcwd(); 

		$emailfolder = str_replace("@" ,"_at_",$email);	
		$filenya=$thisdir."/data/".$emailfolder."/".$filetipe."_".$id.".jpg";
		$filelink="/bptgaruda/data/".$emailfolder."/".$filetipe."_".$id.".jpg";
		
		if(is_file($filenya)) {
			$filecek="<a href=\"$filelink\">lihat</a>";
		} else {
			$filecek="belum";
		}
		
		return $filecek;		
	}

	function getAge( $p_strDate ) {
	    list($Y,$m,$d)    = explode("-",$p_strDate);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}
	
	function getinfo($nama)
    {
    		$sql = "SELECT * FROM info WHERE nama = ? LIMIT 1";
			$query = $this->db->query($sql, array($nama)); 
			$row = $query->row();
			
			$infonya = $row->keterangan ;
		
			return $infonya;
    }
	
    function getnama($idnya)
    {
    		$sql = "SELECT * FROM penumpang WHERE id = ? LIMIT 1";
			$query = $this->db->query($sql, array($idnya)); 
			$row = $query->row();
			
			$namanya = $row->nama." /".$row->title;
		
			return $namanya;
    }

	function getumur($idnya)
    {

			$sql = "SELECT * FROM penumpang WHERE id = ? LIMIT 1";
			$query = $this->db->query($sql, array($idnya)); 
			$row = $query->row();
			
			list($Y,$m,$d)    = explode("-",$row->tgl);
		    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }

	function getprice($tgldepart, $tipe, $arrive,  $tiketage, $ext) 
	{
		$date = explode("-",$tgldepart);
		
		switch($tiketage) {
			case "Adult" :
				$gol = "A";
				break;
			case "Child" :
				$gol = "C";
				break;
			case "Infant" :
				$gol = "I";
				break;
		}
		
		$kode = "JP".$arrive.$tipe.$gol.$ext;
		
		$sql = "SELECT * FROM harga WHERE tahun = ? AND bulan = ? AND tgl = ?  LIMIT 1";
		$query = $this->db->query($sql, array($date[0],$date[1],$date[2])); 
		$row = $query->row();
		
		return $row->$kode;
	}
}

?>
