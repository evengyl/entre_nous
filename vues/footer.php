<div class="col-xs-12 footer">
	<div class="container">

	    <div class="col-xs-4"><!-- widgets column left -->
	        <ul class="list-unstyled clear-margins"><!-- widgets -->
	        	<li class="widget-container widget_nav_menu"><!-- widgets list -->
	                <h2 class="title-widget">__TRANS_how_to_choise_your_extract__</h2>
	                <ul>
						<li><a href="#">Why use a Fume Extraction ?</a></li>
	                    <li><a href="#">Volume Fume Extraction Selection Guide</a></li>
	                    <li><a href="#">Understand Spare Filter</a></li>
	                    <li><a href="#">Which Filter for which Extractor ?</a></li>
	                </ul>
				</li>
				<li class="widget-container widget_nav_menu"><!-- widgets list -->
	                <h2 class="title-widget">__TRANS_autre__</h2>
	                <ul>
	                	<li><a href="#">Tools Guide Selector</a></li>
						<li><a href="?page=documentations">__TRANS_documentations__</a></li>
	                    <li><a href="?page=contact">__TRANS_contact_us__</a></li>
	                    <li><a href="?page=find_us">__TRANS_ou_nous_trouver__</a></li>
	                    <li><a href="https://www.matedex.be" target="_blank">Matedex Electronic Tools - Website</a></li>
	                </ul>
				</li>
	        </ul>
	    </div><!-- widgets column left end -->
	                
	    <div class="col-xs-4"><!-- widgets column left -->
	        <ul class="list-unstyled clear-margins"><!-- widgets -->
	        	<li class="widget-container widget_nav_menu"><!-- widgets list -->
	                <h2 class="title-widget">__TRANS_categories__</h2>
	                <ul>
	                	<?
		                foreach($nav_top as $key => $nav_top_row)
		                {
		                    if(isset($nav_top[$key-1]) && ($nav_top[$key-1]->sub_categ == "2" && $nav_top[$key]->sub_categ != "2"))
		                        echo "</ul></li>";

		                    if($nav_top_row->sub_categ == "0")
		                        echo '<li><a href="?page=categ&categ_id='.$nav_top_row->id.'">'.$nav_top_row->name_code.'</a></li>';

		                    else if($nav_top_row->sub_categ == "1")
		                    {?>
		                        <li>
		                            <a href="?page=categ&categ_id=<?= $nav_top_row->id; ?>"><?= $nav_top_row->name_code; ?></a>
		                            <ul><?
		                    }

		                    else if($nav_top_row->sub_categ == "2")
		                    {?>
		                        <li><a href="?page=categ&categ_id=<?= $nav_top_row->id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;- <?= $nav_top_row->name_code; ?></a></li><?
		                    }


		                    if(!isset($nav_top[$key+1]))
		                        echo "</ul></li>";

		                }?>
	                </ul>
				</li>
	        </ul>
		</div><!-- widgets column left end -->

	                
	    <div class="col-xs-4"><!-- widgets column center -->
	        <ul class="list-unstyled clear-margins"><!-- widgets -->
	        	<li class="widget-container widget_recent_news"><!-- widgets list -->
	                <h2 class="title-widget">__TRANS__contact_detail__</h2>
	                <div class="footerp"> 
	                    <h2 class="title-median">Matedex S.A</h2>
	                    <p><b>Email : </b><a href="mailto:matedex@matedex.be">Matedex@matedex.be</a></p>
	                    <p><b>__TRANS_horaire__ : </b><b style="color:#9FC418;">__TRANS_horaire_list__</b></p>
					    <p><b>__TRANS_address_title__ : </b>4 Avenue de l'artisanat, 1420 Braine-l'Alleud, Belgique</p>
						<p><b>__TRANS_tel__ : </b> +32 (0)2 387 03 00</p>
						<p><b>Fax : </b>  +32 (0)2 387 03 66</p>
	                </div>
	    		</li>
	        </ul>
	    </div>

		<div class="footer-bottom">
			<div class="col-xs-12" style="text-align:center;">
				<p>© Matedex S.A. 1949-<?php echo date('Y'); ?> __TRANS_footer_price__.</p>
			</div>
		</div>
	</div>
</div>