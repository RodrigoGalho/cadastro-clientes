<ol class="breadcrumb">
  	<li><?php echo anchor('index', 'Página Inicial'); ?></li>
  	<li><?php echo anchor('clientes/', 'Clientes'); ?></li>
  	<li class="active">Listar</li>
</ol>
<div class="conteiner-fluid menu-buttons">
	<?php echo anchor("clientes/cadastrar/", "Cadastrar Novo Cliente", "class=\"btn btn-success\""); ?>
</div>

<div class="panel panel-default conteiner-fluid">
	<div class="panel-heading">Clientes</div>
	<div class="panel-body">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
		  <input type="text" id="search" class="form-control" placeholder="Pesquisar" aria-describedby="basic-addon1">
		</div><br>		  
	  	<table class="table table-bordered table-striped" id="searchTable">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>Cadastrado desde</th>
					<th>Atualizado em</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
		    <?php foreach ($clientes as $cliente): ?>
				<tr>
			        <td><?php echo "$cliente[DSNome]"; ?></td>
			        <td><?php echo "$cliente[DSEmail]"; ?></td>
			        <td><?php echo "$cliente[DTRegistro]"; ?></td>
			        <td><?php echo "$cliente[DTAtualizacao]"; ?></td>

			        <td width="20%" align="center">
			        	<a href="clientes/visualizar/<?php echo $cliente['PKCliente'];?>" class="btn btn-info" title="Vizualizar">
			        		<i class="glyphicon glyphicon-eye-open"></i>
			        	</a>
			        	<a href="clientes/editar/<?php echo $cliente['PKCliente'];?>" class="btn btn-warning" title="Editar">
			        		<i class="glyphicon glyphicon-pencil"></i>
			        	</a>
			        	<a href="clientes/excluir/<?php echo $cliente['PKCliente'];?>" class="btn btn-danger" title="Excluir">
			        		<i class="glyphicon glyphicon-remove"></i>
			        	</a>
			        </td>
		        </tr>
		    <?php endforeach ?>
		    </tbody>
		</table>
	</div>
</div>