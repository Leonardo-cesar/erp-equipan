<div class="unidadesLancamentos form">
    <?php echo $this->Form->create('UnidadesLancamento'); ?>
    <fieldset>
        <legend><?php echo __('Edit Unidades Lancamento'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('nome');
        echo $this->Form->input('tipo', array('type' => 'select', 'multiple' => 'checkbox', 'options' => array('1' => 'Geradora', '2' => 'Pagadora', '3' => 'Recebedora')));
        echo $this->Form->input('ativo');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UnidadesLancamento.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('UnidadesLancamento.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Unidades Lancamentos'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Unidades Unidades Lancamentos'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Unidades Unidades Lancamento'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'add')); ?> </li>
    </ul>
</div>
