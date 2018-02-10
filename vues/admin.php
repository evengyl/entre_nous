<div class="col-xs-12 col-without-padding col-without-radius"><?

		if($_GET['page'] == "admin")
		{
			if(isset($_GET["action"]))
			{
				if($_GET['action'] == "pull_git")
				{
					?>__MOD_admin_git_pull__<?
				}
				else if($_GET['action'] == "edit_config_app")
				{
					?>__MOD_admin_edit_config_app__<?
				}
				else if($_GET['action'] == "eval")
				{
					?>__MOD_admin_eval__<?
				}
				else if($_GET['action'] == "list_user")
				{
					?>__MOD_admin_edit_user__<?
				}
				else if($_GET['action'] == "edit_user")
				{
					?>__MOD_admin_edit_user__<?
				}
				else if($_GET['action'] == "pull_bsd")
				{
					?>__MOD_admin_pull_bsd__<?
				}
				else if($_GET['action'] == "push_bsd")
				{
					?>__MOD_admin_push_bsd__<?
				}
				else if($_GET['action'] == "unit_test")
				{
					?>__MOD_admin_unit_test__<?
				}
				else if($_GET['action'] == "orm")
				{
					?>__MOD_admin_test_orm__<?
				}
					
			}
			else
			{?>
				<div class="col-xs-6 col-xs-offset-3">
					<a href="?page=admin&action=pull_git" type="button" class="btn btn-primary btn-lg btn-block">Git Pull To gitHub Origin master</a>
					<a href="?page=admin&action=edit_config_app" type="button" class="btn btn-primary btn-lg btn-block">Edit Option Config</a>
					<a href="?page=admin&action=list_user" type="button" class="btn btn-primary btn-lg btn-block">Edit list user</a>
					<a href="?page=admin&action=pull_bsd" type="button" class="btn btn-primary btn-lg btn-block">Pull BSD ( <?=Config::$base ?> )</a>
					<a href="?page=admin&action=push_bsd" type="button" class="btn btn-primary btn-lg btn-block">Push BSD ( <?=Config::$base ?> )</a>
					<a href="?page=admin&action=unit_test" type="button" class="btn btn-primary btn-lg btn-block">Test Unitaire</a>
					<a href="?page=admin&action=orm" type="button" class="btn btn-primary btn-lg btn-block">Test De l'orm</a>
					<a href="?page=admin&action=eval" type="button" class="btn btn-primary btn-lg btn-block">EVAL</a>
				</div><?
			}
		}?>

		
		<div style='font-size:13px; margin-bottom:0; color:red' class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">
			<?php echo (isset($_SESSION['error']))?'<label for="exampleInputPassword1">'.$_SESSION['error'].'</label>':''; ?>
		</div>
	</div>
</div>
