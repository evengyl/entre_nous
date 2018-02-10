<div class="col-xs-4 block_image">
    <p><img class="img-responsive" src="/images/product/<?= $product->img ?>.jpg" style="max-height:350px;" alt="<?= $product->name; ?>"></p>
</div>
<div class="second_column col-xs-8">

    <div class="col-xs-12 block_name_code">
        <div class='col-xs-10 block_name'>
            <h3 style="display: inline-block;" data-action="edit" data-table="ma_ft_product" data-id="<?= $product->id ?>" data-column="name_<?= $_SESSION['lang']; ?>"><?= $product->name; ?></h3>
            <small>
        	<span style="color:#9FC418;">&nbsp;&nbsp;Code : </span>
        	<span data-action="edit" data-table="ma_ft_product" data-id="<?= $product->id ?>" data-column="no_code" class="code_matedex"><?= $product->no_code ?></span>
        </small>
        </div>
    </div>

    <div class='col-xs-12 block_text_product'>
        <div data-action="edit" data-table="ma_ft_product" data-id="<?= $product->id ?>" data-column="text_<?= $_SESSION['lang']; ?>" class="text"><?= $product->text; ?></div>
    </div>

    <div class="block_spec col-xs-12 col-without-padding">
        <div class='col-xs-6' id="block_attribut">
        	<h3>__TRANS_attribut__</h3><?
    		foreach($product->attribut as $key => $array_attribut)
    		{?>
    			<span data-action="edit" data-table="ma_ft_product_attribut" data-column="attribut_<?= $_SESSION['lang']?>" data-id-attribut="<?= $array_attribut->id ?>" data-id="<?= $product->id ?>" class="attribut"><?= $array_attribut->attribut; ?></span></br><?
    		}?>
            <div style="margin-top:15px;" class="col-xs-12" id="box_for_add_attribut"></div>
        </div>

        <div class='col-xs-6' id="block_caract">
        	<h3>__TRANS_caract__</h3><?
            if(!empty($product->caract))
            {
                foreach($product->caract as $array_caract)
                {?>
                    <span data-action="edit" data-table="ma_ft_product_caract_name" data-column="name_<?= $_SESSION['lang']?>" data-id-attribut="<?= $array_caract->id_name ?>" data-id="<?= $product->id ?>" class="caract" style="color:#9FC418;" ><?= $array_caract->name; ?></span>
                    <span data-action="edit" data-id-line-product="<?= $array_caract->id_line_caract; ?>" data-table="ma_ft_product_caract_value" data-column="value" data-id-attribut="<?= $array_caract->id_value ?>" data-id="<?= $product->id ?>" class="caract"><?=(empty($array_caract->value))?"N/C":$array_caract->value; ?></span><br><?
                }   
            }?>
    		<div style="margin-top:15px;" class="col-xs-12" id="box_for_add_caract"></div>
        </div>
    </div>

    <div class="col-xs-12" id="product_document">
        <h3>__TRANS_documentations__</h3><?
        foreach($product->documentation as $row_doc)
        {?>
            <div class="col-xs-4">
                <div data-id='<?= $row_doc->id; ?>' class="thumbnail col-xs-12">
                    <a target="_blank" href="/pdf/product_document/<?= $row_doc->url ?>" class="col-xs-12 col-without-padding" role="button">
                        <img src="/pdf/product_document/<?= $row_doc->img; ?>" style="max-height:200px;" class="img-responsive" alt="<?= $row_doc->name ?>">
                        <h4 style="text-align:center; color:white;"><?= $row_doc->name ?>&nbsp;(<?= $row_doc->type; ?>)</h4>
                    </a>
                </div>
            </div><?
        }?>
    </div>
</div>

