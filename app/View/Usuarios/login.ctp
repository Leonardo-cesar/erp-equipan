<div class="row" style="margin-top: 15%">
    <div class="col-md-4 col-md-offset-4" style="background: #f8f8f8;
         border: 1px solid #e7e7e7;
         padding: 10px;
         moz-border-radius: 10px;
         -webkit-border-radius: 10px;
         border-radius: 10px;">
        <div class="col-md-12" style="text-align: center">
            <?php echo $this->Html->link($this->Html->image('logo.jpg'), '/', array('escape' => FALSE)) ?>
        </div>
        <div class="col-md-12" style="text-align: center">
            <i>ERP BETA 0.1 VS</i>
        </div>
        <br clear="all" />
        <br clear="all" />
        <?php echo $this->Session->flash('auth') ?>
        <?php echo $this->Form->create('Usuario', array("class" => "form-horizontal")); ?>
        <?php echo $this->Form->input('usuario', array('label' => 'Usuário', 'class' => 'form-control')); ?>
        <br clear="all" />
        <?php echo $this->Form->input('senha', array('label' => 'Senha', 'class' => 'form-control', 'type' => 'password')); ?>
        <br clear="all" />
        <div class="col-md-12" style="text-align: center">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Logar</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<br clear="all">