<nav style="margin-bottom:0px;" class="navbar navbar-default nav_primal">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_primal" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <!--<a class="navbar-brand" href="?page=home"><?= Config::$name_head_nav ?></a>-->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=" navbar-collapse collapse" id="nav_primal">
            <ul class="nav navbar-nav">
                <li><a href="#">__TRANS_accueil__</a></li><?
                
                foreach($nav_top as $key => $nav_top_row)
                {
                    if(isset($nav_top[$key-1]) && ($nav_top[$key-1]->sub_categ == "2" && $nav_top[$key]->sub_categ != "2"))
                        echo "</ul></li>";

                    if($nav_top_row->sub_categ == "0")
                        echo '<li><a href="?page=categ&categ_id='.$nav_top_row->id.'">'.$nav_top_row->name_code.'</a></li>';

                    else if($nav_top_row->sub_categ == "1")
                    {?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $nav_top_row->name_code; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=categ&categ_id=<?= $nav_top_row->id; ?>"><?= $nav_top_row->name_code; ?></a></li><?
                    }

                    else if($nav_top_row->sub_categ == "2")
                    {?>
                        <li><a href="?page=categ&categ_id=<?= $nav_top_row->id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;- <?= $nav_top_row->name_code; ?></a></li><?
                    }


                    if(!isset($nav_top[$key+1]))
                        echo "</ul></li>";

                }?>
                <li><a href="?page=documentations">__TRANS_documentations__</a></li>
                <li><a href="?page=contact">__TRANS_contact_us__</a></li>
                <li><?php echo (isset($_SESSION['pseudo']) && $_SESSION['level'] == 3 && Config::$need_sys_connection == "true")?'<a href="?page=admin">Admin</a>' : ''; ?></li>
                <?php echo (!isset($_SESSION['pseudo']) && Config::$need_sys_connection == "true")?'<li><a href="?page=login">Se connecter</a></li>' : ''; ?>
                <?php echo (isset($_SESSION['pseudo']))?'<li><a href="?page=logout">Se déconnecter</a></li>' : ''; ?>
            </ul>
        </div>
    </div>
</nav>
