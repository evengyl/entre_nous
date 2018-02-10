<div class="col-xs-3 part_text_general"><?
    if(isset($general->img)){
        ?><img data-action="edit_img" data-table="specific_text_categ"  data-column="img" data-id-text="<?= $general->id; ?>" class="img-responsive" src="/images/<?= $general->img; ?>"><?
    }?>
</div>

<div class="col-xs-6 part_text_general">
        <a alt="<?= Config::$name_website; ?>" href="?page=home" style="text-decoration:none;">
            <p><img src="/images/welle_ft_logo.PNG"></p>
        </a><?
        if(isset($general->title)){
            ?><h2><b class="col-xs-12" data-action="edit" data-table="specific_text_categ"  data-column="title_<?= $_SESSION['lang']; ?>" data-id-text="<?= $general->id; ?>">&nbsp;<?= $general->title; ?></b></h2><?
        }?>
                
</div>

<div class="col-xs-3 part_text_general"><?
    if(isset($general->img_2)){
        ?><img data-action="edit_img" data-table="specific_text_categ"  data-column="img_2" data-id-text="<?= $general->id; ?>" class="img-responsive" src="/images/<?= $general->img_2; ?>"><?
    }?>
</div>

<div class="part_categ_desc col-xs-12" data-action="edit" data-table="specific_text_categ"  data-column="text_<?= $_SESSION['lang']; ?>" data-id-text="<?= $general->id; ?>"><? if(isset($general->text)) echo $general->text; ?></div>
