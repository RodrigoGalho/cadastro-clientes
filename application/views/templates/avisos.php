<?php

$result = $this->session->userdata('result');
$msg = $this->session->userdata('msg');

$result = ($result != "") ? $result : "info";

if($msg != ""){
	echo "<p class='alert alert-".$result."'>".$msg.'</p>';
}

$dados = array(
	'result' => '',
	'msg' => ''
	);

$this->session->unset_userdata($dados);

?>