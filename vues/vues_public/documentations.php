<?
$text_thumb = new stdClass();
$text_thumb->are_you_gimbling_your_health = array(
		"fr" => "Ce documents contient toutes les information utiles pour connaître les dangers et les risques lié aux fumée de soudures, vapeurs, colles, laser, etc...",
		"en" => "This document contains all the information you need to know the dangers and risks of welding, vapor, glue, laser smoke, etc.",
		"nl" => "Dit document bevat alle informatie die u nodig hebt om de gevaren en risico's van lassen, dampen, lijm, laserrook, enz. Te kennen."
	);
$text_thumb->system_filtration_2017 = array(
		"fr" => "Ce documents contient tous les produits concernant les extractions de fumées de Weller, extracteurs, filtres, bras, kits, accessoires, ect...",
		"en" => "This document contains all the products concerning Weller fume extraction, extractors, filters, arms, kits, accessories, ect ...",
		"nl" => "Dit document bevat alle producten met betrekking tot Weller rookafzuiging, extractors, filters, armen, kits, accessoires, ect ..."
	);
$text_thumb->laser_line_borchure = array(
		"fr" => "Ce documents contient tous les produits concernant les extractions de fumées de Weller Laser-Line, extracteurs, filtres, bras, kits, accessoires, ect...",
		"en" => "This document contains all the products concerning the extraction of fumes from Weller Laser-Line, extractors, filters, arms, kits, accessories, ect ...",
		"nl" => "Dit document bevat alle producten met betrekking tot het afzuigen van dampen van Weller Laser-Line, afzuigers, filters, armen, kits, accessoires, ect ..."
	);
$text_thumb->catalogue_ft_2014 = array(
		"fr" => "(OLD) Ce documents contient tous les produits concernant les extractions de fumées de Weller, extracteurs, filtres, bras, kits, accessoires, ect...",
		"en" => "(OLD) This document contains all the products concerning Weller fume extraction, extractors, filters, arms, kits, accessories, ect ...",
		"nl" => "(OUD) Dit document bevat alle producten met betrekking tot Weller rookafzuiging, extractors, filters, armen, kits, accessoires, ect ..."
	);

?>


<div class="col-xs-12 col-without-padding page_documentations">
	<h2 style="text-align:center;" class="title">__TRANS_documentations__</h2>

	<div class="col-xs-3">
		<div class="thumbnail col-xs-12">
			<img src="/pdf/are_you_gimbling_your_health.PNG" style="max-height:200px;" class="img-responsive" alt="Are You Gimbling your Health">
			<div class="caption col-xs-12">
				<h3>__TRANS_are_u_gambling__</h3>
				<p><?= $text_thumb->are_you_gimbling_your_health[$_SESSION['lang']]; ?></p>
				<p><a target="_blank" href="/pdf/are_you_gimbling_your_health_<?= $_SESSION['lang']; ?>.pdf" class="col-xs-12 btn btn-primary" role="button">__TRANS_voir_pdf__</a></p>
			</div>
		</div>
	</div>

	<div class="col-xs-3">
		<div class="thumbnail col-xs-12">
			<img src="/pdf/system_filtration_2017.PNG" style="max-height:200px;" class="img-responsive" alt="System FT 2017">
			<div class="caption col-xs-12">
				<h3>__TRANS_system_filtration_new__</h3>
				<p><?= $text_thumb->system_filtration_2017[$_SESSION['lang']]; ?></p>
				<p><a target="_blank" href="/pdf/system_filtration_2017.pdf" class="col-xs-12 btn btn-primary" role="button">__TRANS_voir_pdf__</a></p>	
			</div>
		</div>
	</div>

	<div class="col-xs-3">
		<div class="thumbnail col-xs-12">
			<img src="/pdf/laser_line_borchure.PNG" style="max-height:200px;" class="img-responsive" alt="Laser Line Brochure">
			<div class="caption col-xs-12">
				<h3>__TRANS_brochure_laserline__</h3>
				<p><?= $text_thumb->laser_line_borchure[$_SESSION['lang']]; ?></p>
				<p><a target="_blank" href="/pdf/laser_line_borchure.pdf" class="col-xs-12 btn btn-primary" role="button">__TRANS_voir_pdf__</a></p>
			</div>
		</div>
	</div>

	<div class="col-xs-3">
		<div class="thumbnail col-xs-12">
			<img src="/pdf/catalogue_ft_2014.PNG" style="max-height:200px;" class="img-responsive" alt="Catalogue FT 2014">
			<div class="caption col-xs-12">
				<h3>__TRANS_catalogue_ft_old__</h3>
				<p><?= $text_thumb->catalogue_ft_2014[$_SESSION['lang']]; ?></p>
				<p><a target="_blank" href="/pdf/catalogue_ft_2014.pdf" class="col-xs-12 btn btn-primary" role="button">__TRANS_voir_pdf__</a></p>
			</div>
		</div>
	</div>
</div>