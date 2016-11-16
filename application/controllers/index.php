<?php

class Index extends CI_Controller {

    function __construct() {
        
        parent::__construct();
    }

    function index() {

        $this->load->view('templates/cabecalho');
        $this->load->view('templates/menu');
        $this->load->view('templates/navbar');
        $this->load->view('templates/avisos');
        $this->load->view('index');
        $this->load->view('templates/rodape');
    }
}

?>