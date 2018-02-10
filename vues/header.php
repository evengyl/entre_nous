<div id='header' class="container-fluid header col-without-padding">
	<div class="logo hidden-xs col-xs-8">
		<a alt="<?= Config::$name_website; ?>" href="?page=home" style="text-decoration:none;">
			<img src="/images/logo-matedex.jpg">
			<img src="/images/welle_ft_logo.PNG">
		</a>
	</div>
	<div class="col-xs-2 time_server">
		<?php echo "Heure Serveur : ".date('d/m/Y H:i:s'); ?>
	</div>
	<div class="hidden-xs col-sm-2" id="" style="color:white;">
		<?=($_SESSION['lang'] == 'fr')?'':'<a class="col-lg-2" href="'.$_SERVER["REQUEST_URI"].'&lang=fr"><img class="img-responsive" style="height:25px;" src ="/images/fr.png"></a>'; ?>
		<?=($_SESSION['lang'] == 'en')?'':'<a class="col-lg-2" href="'.$_SERVER["REQUEST_URI"].'&lang=en"><img class="img-responsive" style="height:25px;" src ="/images/en.png"></a>'; ?>
		<?=($_SESSION['lang'] == 'nl')?'':'<a class="col-lg-2" href="'.$_SERVER["REQUEST_URI"].'&lang=nl"><img class="img-responsive" style="height:25px;" src ="/images/nl.png"></a>'; ?>
	</div>
</div>

<div class="container-fluid nav_top col-without-padding">
	__MOD_nav_top__
</div>
