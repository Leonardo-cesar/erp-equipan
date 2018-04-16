<?php echo $this->Session->flash('permissao') ?> 
<div class="col-md-12 home">
    <legend>Balcão</legend>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>clientes/add" class="col-sm-12"><?php echo $this->Html->image('cliente.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Cliente</span></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>pedidos/add" class="col-sm-12"><?php echo $this->Html->image('pedido.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Pedido</samp></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>caixas" class="col-sm-12"><?php echo $this->Html->image('caixa.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Caixa</samp></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>entregas/add" class="col-sm-12"><?php echo $this->Html->image('entrega.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Entrega</samp></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>pedidos/pesquisar" class="col-sm-12"><?php echo $this->Html->image('pesquisar.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Pesquisar</samp></a></div>
</div>
<br clear="all"/>
<br clear="all"/>
<div class="col-md-12 home">
    <legend>Estoque</legend>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>codigos" class="col-sm-12"><?php echo $this->Html->image('codigo.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Códigos</span></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>estoques" class="col-sm-12"><?php echo $this->Html->image('visualizar.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Visualizar</samp></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>logEstoques/add" class="col-sm-12"><?php echo $this->Html->image('ajustar.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Ajuste</samp></a></div>
    <div class="col-md-2"><a href="<?php echo $this->here; ?>perdas/add" class="col-sm-12"><?php echo $this->Html->image('perda.png', array('class' => 'col-md-12')) ?><span class="col-md-12">Perda</samp></a></div>
</div>
<br clear="all"/>
<br clear="all"/>