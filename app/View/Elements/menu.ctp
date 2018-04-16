<div class="col-md-6">
    <div class="col-md-12">
        <?php echo $this->Html->link($this->Html->image('logo.jpg'), '/', array('escape' => FALSE)) ?>
    </div>
    <div class="col-md-12">
        <i>ERP BETA 0.3 VS</i>
    </div>
</div>
<div class="col-md-6" style="border: 1px solid;moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;padding: 10px 0;margin-bottom: 20px;">
    <div class="col-md-7"><?php echo $this->Html->image('user.png', array('class' => 'col-md-3', 'style' => 'width:57px')) ?><samp class="col-md-9" style="margin-top: 5px;"><?php echo $this->Session->read('Auth.User.nome') ?></samp></div>
    <div class="col-md-5"><?php echo $this->Html->image('logout.png', array('class' => 'col-md-4', 'style' => 'width:57px')) ?><samp class="col-md-6"  style="margin-top: 5px;"><?php echo $this->Html->link('Sair', '/usuarios/logout', array('style' => 'text-decoration: none;color: red;font-weight: bold;')) ?></samp></div>
</div>
<br clear="all"/>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if ($this->Session->read('Auth.User.nivel_id') != 3 || in_array(4, $this->Session->read('Auth.User.Setor'))) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estoque <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link('Ajuste', '/logEstoques/add') ?></li>
                            <li><?php echo $this->Html->link('Cadastrar Códigos', '/codigos') ?></li>
                            <li><?php echo $this->Html->link('Controle de Estoque', '/estoques/controle') ?></li>
                            <li><?php echo $this->Html->link('Informar Perda', '/perdas/add') ?></li>
                            <li><?php echo $this->Html->link('Visualizar', '/estoques') ?></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->Session->read('Auth.User.nivel_id') != 3 || in_array(1, $this->Session->read('Auth.User.Setor'))) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Balcão <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Clientes', '/clientes') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Cadastrar Cliente', '/clientes/add') ?></li>
                                    <li><?php echo $this->Html->link('Ver Clientes', '/clientes') ?></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Pedidos', '/caixas') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Gerar Pedido', '/pedidos/add') ?></li>
                                    <li><?php echo $this->Html->link('Pedidos Localiza', '/pedidos/localiza') ?></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Caixa', '/caixas') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Baixar Pedido', '/caixas') ?></li>
                                    <li><?php echo $this->Html->link('Baixa Parcial', '/caixas/parcial') ?></li>
                                    <li><?php echo $this->Html->link('Baixa em Lote', '/caixas/lote') ?></li>
                                    <li><?php echo $this->Html->link('Fechamento de Caixa', '/caixas/fechamento') ?></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Entrega', '/entregas/add') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Entrega', '/entregas/add') ?></li>
                                    <li><?php echo $this->Html->link('Entrega Localiza', '/entregas/lote') ?></li>
                                </ul>
                            </li>
                            <li><?php echo $this->Html->link('Pesquisar Pedido', '/pedidos/pesquisar') ?></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->Session->read('Auth.User.nivel_id') != 3 || in_array(2, $this->Session->read('Auth.User.Setor'))) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Financeiro <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link('Lançamento de Caixa', '/lancamentos/add') ?></li>
                            <li><?php echo $this->Html->link('Buscar Lançamento', '/lancamentos/busca') ?></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->Session->read('Auth.User.nivel_id') != 3) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Financeiro', '#') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Consolidado', '/lancamentos/consolidado') ?></li>
                                    <li><?php echo $this->Html->link('Detalhado', '/lancamentos/detalhado') ?></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Vendas', '#') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Pedidos Gerados', '/pedidos/gerados') ?></li>
                                    <li><?php echo $this->Html->link('Pedidos a Receber', '/pedidos/receber') ?></li>
                                    <li><?php echo $this->Html->link('Rank de Vendas', '/pedidos/vendas') ?></li>
                                    <li><?php echo $this->Html->link('Resumo de Pedidos', '/pedidos/resumo') ?></li>
                                    <!--<li><?php echo $this->Html->link('Pedidos Excluidos', '/pedidosexcluidos/relatorio') ?></li>-->
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <?php echo $this->Html->link('Estoque', '#') ?>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Códigos', '/codigos/relatorio') ?></li>
                                    <li><?php echo $this->Html->link('Movimento', '/LogEstoques/movimento') ?></li>
                                    <li><?php echo $this->Html->link('Perda de Material', '/Perdas/relatorio') ?></li>
                                    <li><?php echo $this->Html->link('Produtos', '/LogEstoques/produtos') ?></li>
                                    <li><?php echo $this->Html->link('Produtos Consolidado', '/KitsPedidos/produtos') ?></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            <!--<li><?php echo $this->Html->link('Produção', '/Producao') ?></li>-->
            </ul>
            <?php if ($this->Session->read('Auth.User.nivel_id') == 1) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administração <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation" class="dropdown-header">CLIENTES</li>
                            <li><?php echo $this->Html->link('Categorias', '/categorias') ?></li>
                            <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">PRODUTOS</li>
                            <li><?php echo $this->Html->link('Produtos', '/produtos') ?></li>
                            <li><?php echo $this->Html->link('Kits', '/kits') ?></li>
                            <li><?php echo $this->Html->link('Preços', '/precos') ?></li>
                            <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">USUÁRIOS</li>
                            <li><?php echo $this->Html->link('Usuários', '/usuarios') ?></li>
                            <li><?php echo $this->Html->link('Níveis', '/niveis') ?></li>
                            <li><?php echo $this->Html->link('Setores', '/setores') ?></li>
                            <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">UNIDADES</li>
                            <li><?php echo $this->Html->link('Unidades', '/unidades') ?></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>