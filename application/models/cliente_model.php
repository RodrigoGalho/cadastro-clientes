<?php

class Cliente_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function cadastrar() {

        $dados = array(
            'DSNome' => $this->input->post('nome'),
            'DSEmail' => $this->input->post('email'),
            'DTNascimento' => $this->input->post('dt_nascimento'),
            'DSLogradouro' => $this->input->post('logradouro'),
            'NMNumero' => $this->input->post('numero'),
            'DSComplemento' => $this->input->post('complemento'),
            'DSCep' => $this->input->post('cep'),
            'FKCidade' => $this->input->post('cidade'),
            'DTRegistro' => date('Y-m-d'),
            'DTAtualizacao' => date('Y-m-d')
        );

        $telefones = $this->input->post('telefone');

        if($this->db->insert('cliente', $dados)){
            
            $idCliente = $this->db->insert_id();

            for($i=0, $size=sizeof($telefones); $i<$size; $i++){
                $telefone[$i] = array(
                    'DSTelefone' => $telefones[$i],
                    'FKCliente' =>  $idCliente
                );
            }

            if($this->db->insert_batch('telefone', $telefone)){
                return $this->db->affected_rows();
            }
        
        }
        else{
            return false;
        }
    }

    function buscarCidades(){
        $this->db->order_by('DSNome asc');
        $query = $this->db->get('cidade');
        return $query->result_array();
    }

    function buscarEstados(){
        $this->db->order_by('DSNome asc');
        $query = $this->db->get('estado');
        return $query->result_array();
    }

    function buscar($id = false) {

        if ($id === false) {

            $query = $this->db->select('cl.*, c.DSNome as NMCidade, es.DSNome as NMEstado')
                          ->from('cliente cl')
                          ->join('cidade c', 'cl.FKCidade = c.PKCidade')
                          ->join('estado es', 'c.FKEstado = es.PKEstado')
                          ->order_by('cl.DSNome asc')
                          ->get();

            //$this->db->order_by('DSNome asc');
            //$query = $this->db->get('cliente');
            return $query->result_array();
        
        }

        $query = $this->db->select('cl.*, c.DSNome as NMCidade, c.FKEstado as IDEstado, es.DSNome as NMEstado')
                          ->from('cliente cl')
                          ->join('cidade c', 'cl.FKCidade = c.PKCidade')
                          ->join('estado es', 'c.FKEstado = es.PKEstado')
                          ->where(array('PKCliente' => $id), 1)
                          ->order_by('cl.DSNome asc')
                          ->get();

        //$query = $this->db->get_where('cliente', array('PKCliente' => $id), 1);
        $dadosCliente = $query->result_array();
        
        $query = $this->db->get_where('telefone', array('FKCliente' => $id));
        $dadosCliente[0]['telefone'] = $query->result_array();

        return $dadosCliente;
    }

    function editar($idCliente) {

        $dados = array(
            'DSNome' => $this->input->post('nome'),
            'DSEmail' => $this->input->post('email'),
            'DTNascimento' => $this->input->post('dt_nascimento'),
            'DSLogradouro' => $this->input->post('logradouro'),
            'NMNumero' => $this->input->post('numero'),
            'DSComplemento' => $this->input->post('complemento'),
            'DSCep' => $this->input->post('cep'),
            'FKCidade' => $this->input->post('cidade'),
            'DTAtualizacao' => date('Y-m-d')
        );

        $telefones = $this->input->post('telefone');

        if($this->db->update('cliente', $dados, array('PKCliente' => $idCliente))){

            for($i=0, $size=sizeof($telefones); $i<$size; $i++){
                if($telefones[$i] != ""){
                    $telefone[$i] = array(
                        'DSTelefone' => $telefones[$i],
                        'FKCliente' =>  $idCliente
                    );
                }
            }

            if(isset($telefone)){
                if($this->db->insert_batch('telefone', $telefone)){
                    return $this->db->affected_rows();
                }
            }else{
                return true;
            }
        
        }
        else{
            return false;
        }
    } 

    function excluir($idCliente){
        $this->db->where('PKCliente', $idCliente);
        return $this->db->delete('cliente');
    } 

    function excluirTelefone($idTelefone){
        $this->db->where('PKTelefone', $idTelefone);
        return $this->db->delete('telefone');
    }   

}

?>