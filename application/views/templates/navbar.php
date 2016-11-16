<div class="row">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Clientes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("clientes/", 'Listar'); ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?php echo anchor('clientes/cadastrar', 'Cadastrar'); ?></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>