<div class="col-xs-10 col-xs-offset-1"><hr><?
    if(!empty($products))
    {
        foreach($products as $product)
        {?>
            <div class="col-xs-4">
                <div class="thumbnail col-xs-12">
                    <a href="?page=product&product_id=<?= $product->id ?>" class="col-xs-12 col-without-padding" role="button">
                        <h3><?= $product->name; ?></h3>
                        <div class="col-xs-12 col-without-padding img_categ">
                            <center><img src="/images/product/<?= $product->img ?>.jpg" class="img-responsive" alt="<?= $product->name; ?>"></center>
                        </div>
                        <div class="caption col-xs-12">
                            <p><b>Code : </b><b class="code"><?= $product->no_code ?></b></p>
                            <p class="intro_text"><?= $product->text; ?></p>
                        </div>
                    </a>
                </div>
            </div><?
        }
    }?>
</div>

