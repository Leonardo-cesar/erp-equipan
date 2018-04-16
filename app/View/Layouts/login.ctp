<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css(array('bootstrap', 'login'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
    </head>
    <body>
        <div class="container">
            <div id="content">
		<?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <?php
            echo $this->Html->script(array('bootstrap.min', 'srcipt'));
            echo $this->fetch('script');
	?>
</html>
