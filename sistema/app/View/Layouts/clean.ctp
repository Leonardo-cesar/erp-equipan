<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('bootstrap', 'style'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
        <script>
            var www_root = '<?php echo $this->Html->url('/') ?>';
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    </head>
    <body style="height: 100%; width: 100%;">
        <div style="height: 100%; width: 100%;" id="pisca">
            <div class="col-md-12" style="padding: 0;text-align: center;background: black;border-bottom: 5px solid red;margin-bottom: 30px;">
                <?php echo $this->Html->link($this->Html->image('logo-branca.png'), '/', array('escape' => FALSE)) ?>
            </div>
            <div class="container-fluid">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </body>
    <?php
    echo $this->Html->script(array('jquery.tablesorter', 'jquery.tablesorter.widgets', 'jquery.tablesorter.pager', 'bootstrap.min', 'bootstrap-datepicker', 'locales/bootstrap-datepicker.pt-BR', 'jquery.maskMoney.js', 'jquery.maskedinput.min', 'select2.min', 'jquery.validate.min', 'util.validate', 'srcipt'));
    echo $this->fetch('script');
    ?>
</html>
