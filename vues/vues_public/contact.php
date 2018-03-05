<?
$text = array(
	"fr" => "Par le biais de cette page vous pourrez nous soumettre toutes demandes d'informations.",
	"en" => "Through this page you will be able to submit any requests for information.",
	"nl" => "Via deze pagina kunt u verzoeken om informatie indienen."
	);

$text_success = array(
	"fr" => "Votre message à bien été envoyé",
	"en" => "Your message has been sent",
	"nl" => "Uw bericht is verzonden"
	);
?>

<h2 style="text-align:center;" class="title">__TRANS_documentations__</h2>
<div class="col-xs-12" style="padding:5px;">
	<p style="text-align:center;"><?= $text[$_SESSION['lang']]; ?></p>
</div><?
if(isset($_SESSION['error_mail']))
{?>
	<h2 style="color:green; text-align:center;" class="title">-<?= $text_success[$_SESSION['lang']]; ?>-</h2><?
	unset($_SESSION['error_mail']);
}?>
<form action="#" method="post" class="col-lg-6 col-lg-offset-3">

	<div  class="col-xs-12 form-group">				
		<input name="email" type="email" class="form-control" required placeholder="Adresse Email (pas de pub)">
	</div>

	<div  class="col-xs-12 form-group">				
		<textarea name="text" type="text" class="form-control " required placeholder="Votre message"></textarea>
	</div>

	<input type="hidden" name="key_safe" value="55157141">
	
	<input type="hidden" name="return_post_contact" value="1">
	<button type="submit" class="col-lg-4 btn btn-default">__TRANS_envoyer__</button>

</form>
