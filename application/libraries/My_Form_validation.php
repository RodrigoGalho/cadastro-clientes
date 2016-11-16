<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class My_Form_validation extends CI_Form_validation {

	public function is_unique($str, $field) {

		if (substr_count($field, '.') == 2) {

			list($table, $field, $value) = explode('.', $field, 3);
            $query = $this->CI->db->limit(1)->where($field,$str)->where($field.' != ',$value)->get($table);
		} else {

			list($table, $field) = explode('.', $field);
			$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		}

	    return $query->num_rows() === 0;
	}


    function valid_cpf($cpf) {

        $CI =& get_instance();        
        $CI->form_validation->set_message('valid_cpf', 'O %s informado não é válido.');
 
        $cpf = preg_replace('/[^0-9]/','',$cpf);
 
        if (strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf)) {
            
            return false;
        }
 
        // 9 primeiros digitos do cpf
        $digit = substr($cpf, 0, 9);
 
        // calculo dos 2 digitos verificadores
        for ($j=10; $j <= 11; $j++) {
            
            $sum = 0;
            
            for ($i=0; $i< $j-1; $i++) {
                
                $sum += ($j-$i) * ((int) $digit[$i]);
            }
 
            $summod11 = $sum % 11;
            $digit[$j-1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }
        
        return $digit[9] == ((int)$cpf[9]) && $digit[10] == ((int)$cpf[10]);
    }

    function valid_cep($cep) {

        $CI =& get_instance();
        $CI->form_validation->set_message('valid_cep', 'O campo %s não contém um CEP válido.');
 
        $cep = str_replace('.', '', $cep);
        $cep = str_replace('-', '', $cep);
 
        $url = 'http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 0);
 
        $resultado = curl_exec($ch);
        curl_close($ch);
 
        if ( ! $resultado)
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
 
        $resultado = urldecode($resultado);
        $resultado = utf8_encode($resultado);
        parse_str( $resultado, $retorno);
 
        if($retorno['resultado'] == 1 || $retorno['resultado'] == 2)
            return TRUE;
        else
            return FALSE;
    }
 
    function valid_phone($fone) {

        $CI =& get_instance();
        $CI->form_validation->set_message('valid_fone', 'O campo %s não contém um Telefone válido.');
 
        $fone = preg_replace('/[^0-9]/','',$fone);
        $fone = (string) $fone;
 
        if ( strlen($fone) >= 10)
            return TRUE;
        else
            return FALSE;
    }

    function valid_date($data) {
        
        $CI =& get_instance();
        $CI->form_validation->set_message('valid_date', 'O campo %s não contém uma data válida.');
 
        $padrao = explode('/', $data);
 
        return checkdate($padrao[1], $padrao[0], $padrao[2]);
    }
}