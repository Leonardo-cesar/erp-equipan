<div class="pedidos form">
    <fieldset>
        <legend>Relatorio de Códigos</legend>
        <?php echo $this->Form->create('Codigos', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <br clear="all"/>
        <div class="form-group col-sm-4">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'form-control', 'div' => 'col-sm-12', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('situacao', array('type' => 'select', 'empty' => ' - Todos - ', 'div' => 'col-sm-12', 'class' => 'form-control', 'options' => array('0' => 'Em Aberto', '1' => 'Entregue'))); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('produto_id', array('type' => 'select', 'empty' => ' - Todos - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-success" id="gerarCodigos"><i class="glyphicon glyphicon-refresh"></i> Gerar</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divCO form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/pedidos/gimprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class="TableJquery" id="tableCodigos">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Placa</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>Placa</th>
                        <th>Situação</th>
                    </tr>
                    <tr>
                        <th colspan="8" class="ts-pager form-horizontal">
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
            <br clear="all" />
            <div class="col-sm-12">
                <div class="col-sm-3 alert alert-success tv" style="text-align: center;" role="alert"></div>
                <div class="col-sm-3 col-md-offset-1 alert alert-danger tp" style="text-align: center;" role="alert"></div>
                <div class="col-sm-3 col-md-offset-1 alert alert-info tg" style="text-align: center;" role="alert"></div>
            </div>
        </div>
    </fieldset>
</div>