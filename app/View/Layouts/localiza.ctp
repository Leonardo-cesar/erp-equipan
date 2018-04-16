<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('bootstrap', 'select2', 'datepicker3', 'jquery.tablesorter.pager', 'theme.bootstrap', 'style'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
        <script>
            var www_root = '<?php echo $this->Html->url('/') ?>';
        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script>
            function abrirPopup(url, w, h) {
                var newW = w + 200;
                var newH = h + 100;
                var left = (screen.width - newW) / 2;
                var top = (screen.height - newH) / 2;
                var newwindow = window.open(url, 'name', 'width=' + newW + ',height=' + newH + ',left=' + left + ',top=' + top);
                newwindow.resizeTo(newW, newH);

                //posiciona o popup no centro da tela
                newwindow.moveTo(left, top);
                newwindow.focus();
                return false;
            }
        </script>
    </head>
    <body>
        <div id="dvLoading" style="display: none;">
            <div class="col-md-2 col-md-offset-5">
                <?php echo $this->Html->image('loading.gif', array()); ?>
            </div>
        </div>
        <div class="container-fluid">
            <br clear='all'/>
            <?php echo $this->element('menu'); ?>
            <div id="content">
                <?php echo $this->fetch('content'); ?>
            </div>
            <hr />
            © <?php echo date("Y") ?> <?php echo $this->Html->link("Equipan Ltda.", "http://www.equipan.com.br", array('class' => 'cop')) ?>
        </div>
    </body>
    <?php
    echo $this->Html->script(array('bootstrap.min', 'bootstrap-datepicker', 'locales/bootstrap-datepicker.pt-BR', 'jquery.maskMoney.js', 'jquery.maskedinput.min', 'select2.min', 'jquery.validate.min', 'util.validate', 'srcipt'));
    echo $this->fetch('script');
    ?>
</html>
