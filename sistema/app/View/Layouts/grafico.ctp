<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('bootstrap', 'imprimir'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>
    <body style="">
        <div class="col-sm-12" style="
             padding: 20px 0 0;
             border-bottom: 1px solid #ddd;
             ">
            <div style="
                 font-size: 24px;
                 font-weight: bold;
                 padding-top: 6px;
                 font-style: oblique;
                 float: left;
                 ">
                <?php echo $titulo ?>            
            </div>
            <div style="
                 text-align: right;
                 padding-bottom: 15px;
                 ">
                     <?php echo $this->Html->image('logo.jpg') ?>
            </div>
        </div>
        <br clear="all" />
        <?php echo $this->fetch('content'); ?>
        <hr />
        <h6 style="text-align: center"> © Equipan LTDA <?php echo date('d/m/Y H:m:s') ?><br />www.equipan.com.br</h6>
    </body>
</html>
