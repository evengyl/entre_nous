<div class="col-xs-6 col-xs-offset-3">
	<fieldset>
		<legend>WHERE</legend>
			<p class="btn btn-<?= $ok1_or_not[0] ?> btn-lg btn-block">
				Where tester where = "var = var"<br>
				Requète lancée : <b><?= $ok1_or_not[1] ?></b>
			</p>

			<p class="btn btn-<?= $ok2_or_not[0] ?> btn-lg btn-block">
				Where tester where = ["var" => "var"] (= par défault comme opérateur)<br>
				Requète lancée : <b><?= $ok2_or_not[1] ?></b>
			</p>

			<p class="btn btn-<?= $ok3_or_not[0] ?> btn-lg btn-block">
				Where tester where = ["var" => "var", "!="]<br>
				Requète lancée : <b><?= $ok3_or_not[1] ?></b>
			</p>

			<p class="btn btn-<?= $ok4_or_not[0] ?> btn-lg btn-block">
				Where tester where = ["var" , array(1,2,3,4,5)] (si array de id envoyer, alor IN utilisé)<br>
				Requète lancée : <b><?= $ok4_or_not[1] ?></b>
			</p>

			<p class="btn btn-<?= $ok5_or_not[0] ?> btn-lg btn-block">
				Where tester where = ["id" => array(1,2,3,4,5), "NOT IN"] (Array de id avec autre symbol)<br>
				Requète lancée : <b><?= $ok5_or_not[1] ?></b>
			</p>
	</fieldset>
	
</div>