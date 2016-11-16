
<?php 
    if(isset($clientes)){
        $acao = "Editar";
        $url = base_url().'clientes/editar/'.$clientes['PKCliente'];
    }
    else{
        $acao = "Cadastrar";
        $url = base_url().'clientes/cadastrar/';
    }
?>
<ol class="breadcrumb">
    <li><?php echo anchor('index', 'Página Inicial'); ?></li>
    <li><?php echo anchor('clientes', 'Clientes'); ?></li>
    <li class="active"><?php echo $acao;?> Cliente</li>
</ol>
<div class="panel panel-default conteiner-fluid">
    <div class="panel-heading"><?php echo $acao;?> Cliente</div>
    <div class="panel-body">
        <form action="<?php echo $url;?>" method="post" accept-charset="utf-8" class="form-horizontal">
            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='nome'>Nome</label>
                <div class="col-sm-4">
                    <input class="form-control" type='text' name='nome' value="<?php echo isset($clientes) ? $clientes['DSNome'] : set_value('nome') ?>" />
                    <?php echo form_error('nome', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='email'>Email</label>
                <div class="col-sm-4">
                    <input class="form-control" type='text' name='email' value="<?php echo isset($clientes) ? $clientes['DSEmail'] : set_value('email') ?>" />
                    <?php echo form_error('email', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='dt_nascimento'>Data de Nascimento</label>
                <div class="col-sm-4">
                    <input class="form-control" type='date' name='dt_nascimento' value="<?php echo isset($clientes) ? $clientes['DTNascimento'] : set_value('dt_nascimento') ?>" />
                    <?php echo form_error('dt_nascimento', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='logradouro'>Logradouro</label>
                <div class="col-sm-4">
                    <input class="form-control" type='text' name='logradouro' value="<?php echo isset($clientes) ? $clientes['DSLogradouro'] : set_value('logradouro') ?>" />
                    <?php echo form_error('logradouro', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='numero'>Número</label>
                <div class="col-sm-1">
                    <input class="form-control" type='text' name='numero' id='inumeros' onkeypress='mascara(this,msoNumeros)' value="<?php echo isset($clientes) ? $clientes['NMNumero'] : set_value('numero') ?>" />
                    <?php echo form_error('numero'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='complemento'>Complemento</label>
                <div class="col-sm-2">
                    <input class="form-control" type='text' name='complemento' value="<?php echo isset($clientes) ? $clientes['DSComplemento'] : set_value('complemento') ?>" />
                    <?php echo form_error('complemento', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='cep'>CEP</label>
                <div class="col-sm-2">
                    <input class="form-control" type='text' name='cep' id="icep" onkeypress="mascara(this,mcep)" maxlength="9" value="<?php echo isset($clientes) ? $clientes['DSCep'] : set_value('cep') ?>" />
                    <?php echo form_error('cep', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='estado'>Estado</label>
                <div class="col-sm-3">
                    <select class="form-control" name='estado' id="estado">
                        <option value="">Selecione</option>
                        <?php

                            for($i=0, $size = sizeof($estados); $i< $size; $i++){
                                $selected = (isset($clientes) && $clientes['IDEstado'] == $estados[$i]['PKEstado']) ? "selected" : "";
                                echo "<option value=\"".$estados[$i]['PKEstado']."\" ".$selected.">".$estados[$i]['DSUf']." - ".$estados[$i]['DSNome']."</option>";
                            }
                        
                        ?>
                    </select>
                    <?php echo form_error('estado', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='cidade'>Cidade</label>
                <div class="col-sm-3">
                    <select class="form-control" name='cidade' id="cidade">
                        <option value=''>Selecione a Cidade</option>
                        <?php
                            for($i=0, $size = sizeof($cidades); $i< $size; $i++){
                                $selected = (isset($clientes) && $clientes['FKCidade'] == $cidades[$i]['PKCidade']) ? "selected" : "";
                                echo "<option class=\"uf-".$cidades[$i]['FKEstado']."\" value=\"".$cidades[$i]['PKCidade']."\" ".$selected.">".$cidades[$i]['DSNome']."</option>";
                            
                            }
                        ?>
                    </select>                    
                    <?php echo form_error('cidade', '<p class="label label-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label" for='telefone_1'>Telefones</label>
                <div class="col-sm-2" id="telefones">
                <?php
                    $size = (isset($clientes['telefone'])) ? sizeof($clientes['telefone']) : 0;

                    if($size > 0){?>
                        <div class="col col-md-12">
                        <?php for($i=0; $i<$size; $i++){?>
                            <p><?php echo $clientes['telefone'][$i]['DSTelefone'];?> 
                                <a href="../excluirTelefone/<?php echo $clientes['telefone'][$i]['PKTelefone']?>" class="label label-danger" title="Excluir Telefone">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </p>
                        <?php }?>
                        </div>
                    <?php }
                    else{?>
                        <input class="form-control" type='text' name='telefone[]' id="itelefone1" onkeypress="mascara(this,mtelefone)" maxlength="14" /><br>
                        <input class="form-control" type='text' name='telefone[]' id="itelefone2" onkeypress="mascara(this,mtelefone)" maxlength="14" />
                <?php }?>  
                </div>                
            </div>
            <div class="form-group col-sm-12">
                <div class="col-sm-2 col-sm-offset-4">
                    <div class="btn btn-success btn-block" id="add-telefone">Adicionar Telefone</div>
                </div>                
            </div>            

            <div class="form-group col-sm-8 text-right">
                <input type='submit' value='<?php echo $acao;?> Cliente' class="btn btn-primary btn-right" />
            </div> 
        </form>
    </div>
</div>