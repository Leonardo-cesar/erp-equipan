<div class="pedidos form">
    <fieldset>
        <legend>Relatorio de Rank de Vendas</legend>
        <?php echo $this->Form->create('Pedidos', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <br clear="all"/>
        <div class="form-group col-sm-4">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'form-control', 'div' => 'col-sm-12', 'empty' => ' - Todas -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('tipo', array('type' => 'select', 'empty' => ' - Todos - ', 'div' => 'col-sm-12', 'class' => 'form-control', 'options' => array('0' => "À Vista", '1' => 'A Prazo'))); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-success" id="gerarVendas"><i class="glyphicon glyphicon-refresh"></i> Gerar</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divVE form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/pedidos/vimprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class='TableJquery' id="tableVendas">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Venda</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Usuário</th>
                        <th>Venda</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                            <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                            <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                            <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                            <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                            <select class="pagesize input-mini" title="Select page size">
                                <option selected="selected" value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                            <select class="pagenum input-mini" title="Select page number"></select>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir Grafico', '/pedidos/vgrafico/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <div id="donutchart" style="width: 900px; height: 500px;"></div>
        </div>
    </fieldset>
</div>