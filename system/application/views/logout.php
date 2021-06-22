<?

$array_items = array('email' => '', 'level' => '', 'login' => '');

$this->session->unset_userdata($array_items);

$this->session->sess_destroy();



?>