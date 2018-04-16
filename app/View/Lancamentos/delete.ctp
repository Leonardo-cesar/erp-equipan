<div class="pedidos form">
    <?php echo $this->Form->create('Lancamento', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Lançamento de Caixa</legend>
        <div class="cliente" style="text-align: center">
            <p class="tituloLancamento col-sm-12">Você tem certeza que deseja excluir o lançamento?</p>
            <span class="numeroLancamento col-sm-12">ID <?php echo $id ?></span>
            <br clear="all"/>
            <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Confirmar Exclusão</button>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>