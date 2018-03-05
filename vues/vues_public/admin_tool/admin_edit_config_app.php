<div class="col-xs-6 col-lg-offset-3 col-without-padding col-without-radius content_game">
	<form action="#" method="post">
		<?
		foreach($_config as $key_config => $row_config)
		{?>
			<div class="form-group">
			    <label for="<?= $key_config; ?>" style="color:white;"><?= strtoupper($key_config); ?></label>
			    <input type="text" class="form-control" id="<?= $key_config; ?>" value="<?= $row_config; ?>" name="<?= $key_config; ?>" placeholder="<?= $row_config; ?>">
		    </div>
		    <?
		}?>
		<input type="hidden" name="form__config" value="71414242">
		<button type="submit" class="btn btn-default">Submit</button>
	<form>
</div>
