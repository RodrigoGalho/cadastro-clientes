<ol class="breadcrumb">
    <li><?php echo anchor('index', 'Página Inicial'); ?></li>
    <li><?php echo anchor('clientes/', 'Clientes'); ?></li>
    <li class="active">Dados do Cliente</li>
</ol>
<div class="bs-callout bs-callout-info">
	<h4>Registro</h4>
	<p>
		<strong>Cadastrado em:</strong> <?php echo $cliente['DTRegistro'];?><br>
		<strong>Última Atualização em:</strong> <?php echo $cliente['DTAtualizacao'];?>
	</p>
</div>
<div class="panel panel-default conteiner-fluid">
    <div class="panel-heading">Dados Pessoais</div>
    <div class="panel-body">
		<p><strong>Nome:</strong> <?php echo $cliente['DSNome'];?></p>
        <p><strong>Data de Nascimento:</strong> <?php echo $cliente['DTNascimento'];?></p>
    </div>
</div>
<div class="panel panel-default conteiner-fluid">
    <div class="panel-heading">Contato</div>
    <div class="panel-body">
		<p><strong>Email:</strong> <?php echo $cliente['DSEmail'];?></p>
        <p><strong>Fone:</strong> <?php echo $cliente['telefones'];?></p>
    </div>
</div>
<div class="panel panel-default conteiner-fluid">
    <div class="panel-heading">Endereço</div>
    <div class="panel-body">
		<p><strong>Endereço:</strong> <?php echo $cliente['DSLogradouro'];?>, <?php echo $cliente['NMNumero'];?> <?php echo $cliente['DSComplemento'];?></p>
        <p><strong>CEP:</strong> <?php echo $cliente['DSCep'];?></p>
		<p><strong>Cidade:</strong> <?php echo $cliente['NMCidade'];?></p>
		<p><strong>Estado:</strong> <?php echo $cliente['NMEstado'];?></p>
    </div>
</div>
