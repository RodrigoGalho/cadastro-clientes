<?php

class Clientes extends CI_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model('Cliente_model', 'cliente');

    }

    function index() {

        $dados['clientes'] = $this->cliente->buscar();

        for($i=0, $size=sizeof($dados['clientes']); $i < $size; $i++){

            $dados['clientes'][$i]['DTRegistro'] = implode('/', array_reverse(explode('-', $dados['clientes'][$i]['DTRegistro']))); 
            $dados['clientes'][$i]['DTAtualizacao'] = implode('/', array_reverse(explode('-', $dados['clientes'][$i]['DTAtualizacao']))); 
        
        }

        $this->load->view('templates/cabecalho');
        $this->load->view('templates/menu');
        $this->load->view('templates/navbar');
        $this->load->view('templates/avisos');
        $this->load->view('clientes/index', $dados);
        $this->load->view('templates/rodape');
    
    }

    function cadastrar() {

        $this->load->library('form_validation');
        
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|min_length[2]|max_length[250]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[150]|valid_email'
            ),
            array(
                'field' => 'dt_nascimento',
                'label' => 'Data de Nascimento',
                'rules' => 'trim|required|max_length[10]'
            ),
            array(
                'field' => 'logradouro',
                'label' => 'Logradouro',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'numero',
                'label' => 'Número',
                'rules' => 'trim|integer|max_length[11]'
            ),
            array(
                'field' => 'complemento',
                'label' => 'Complemento',
                'rules' => 'trim|max_length[150]'
            ),
            array(
                'field' => 'cep',
                'label' => 'CEP',
                'rules' => 'trim|required|max_length[10]'
            ),
            array(
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {

            $dados['cidades'] = $this->cliente->buscarCidades();
            $dados['estados'] = $this->cliente->buscarEstados();
            $dados['acao'] = "Cadastrar";

            $this->load->view('templates/cabecalho');
            $this->load->view('templates/menu');
            $this->load->view('templates/navbar');
            $this->load->view('templates/avisos');
            $this->load->view('clientes/formulario', $dados);
            $this->load->view('templates/rodape');

        } else {

            if ($this->cliente->cadastrar()) {

                $dados = array(
                    'result' => 'success',
                    'msg' => 'Cliente cadastrado com sucesso!'
                );
            } else {

                $dados = array(
                    'result' => 'danger',
                    'msg' => 'Seu cadastro não foi realizado!'
                );
            }
            $this->session->set_userdata($dados);
            redirect('clientes/cadastrar');
        }
    
    }

    function editar($idCliente) {

        $dados['clientes'] = $this->cliente->buscar($idCliente);
        $dados['clientes'] = $dados['clientes'][0];

        $this->load->library('form_validation');
        
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|min_length[2]|max_length[250]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[150]|valid_email'
            ),
            array(
                'field' => 'dt_nascimento',
                'label' => 'Data de Nascimento',
                'rules' => 'trim|required|max_length[10]'
            ),
            array(
                'field' => 'logradouro',
                'label' => 'Logradouro',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'numero',
                'label' => 'Número',
                'rules' => 'trim|integer|max_length[11]'
            ),
            array(
                'field' => 'complemento',
                'label' => 'Complemento',
                'rules' => 'trim|max_length[150]'
            ),
            array(
                'field' => 'cep',
                'label' => 'CEP',
                'rules' => 'trim|required|max_length[10]'
            ),
            array(
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {

            $dados['cidades'] = $this->cliente->buscarCidades();
            $dados['estados'] = $this->cliente->buscarEstados();

            $this->load->view('templates/cabecalho');
            $this->load->view('templates/menu');
            $this->load->view('templates/navbar');
            $this->load->view('templates/avisos');
            $this->load->view('clientes/formulario', $dados);
            $this->load->view('templates/rodape');

        } else {

            if ($this->cliente->editar($idCliente)) {

                $dados = array(
                    'result' => 'success',
                    'msg' => 'Dados editados com sucesso!'
                );

            } else {

                $dados = array(
                    'result' => 'danger',
                    'msg' => 'Erro ao editar dados!'
                );

            }

            $this->session->set_userdata($dados);
            redirect('clientes');
        }
    
    }

    function visualizar($idCliente) {

        $cliente = $this->cliente->buscar($idCliente);
        $dados['cliente'] = $cliente[0];

        $dados['cliente']['DTRegistro'] = implode('/', array_reverse(explode('-', $dados['cliente']['DTRegistro']))); 
        $dados['cliente']['DTAtualizacao'] = implode('/', array_reverse(explode('-', $dados['cliente']['DTAtualizacao'])));
        $dados['cliente']['DTNascimento'] = implode('/', array_reverse(explode('-', $dados['cliente']['DTNascimento'])));

        $telefones = "";
        foreach($dados['cliente']['telefone'] as $telefone){
            $telefones .= $telefone['DSTelefone'].", ";
        }

        $dados['cliente']['telefones'] = substr($telefones, 0, -2);

        $this->load->view('templates/cabecalho');
        $this->load->view('templates/menu');
        $this->load->view('templates/navbar');
        $this->load->view('templates/avisos');
        $this->load->view('clientes/visualizar', $dados);
        $this->load->view('templates/rodape');
    }

    function excluir($idCliente) {

        if($this->cliente->excluir($idCliente))
        {
           $dados = array(
                'result' => 'success',
                'msg' => 'Cliente excluído com sucesso!'
            );
        }
        else{
            $dados = array(
                'result' => 'danger',
                'msg' => 'Erro ao excluir Cliente!'
            );
        }

        $this->session->set_userdata($dados);
        redirect('clientes/');
    }

    function excluirTelefone($idTelefone) {

        if($this->cliente->excluirTelefone($idTelefone))
        {
           $dados = array(
                'result' => 'success',
                'msg' => 'Telefone excluído com sucesso!'
            );
        }
        else{
            $dados = array(
                'result' => 'danger',
                'msg' => 'Erro ao excluir Telefone!'
            );
        }

        $this->session->set_userdata($dados);
        redirect('clientes/');
    }
}

?>