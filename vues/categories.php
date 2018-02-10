<div class="page_categ col-xs-12 col-without-padding">
    <div class="col-xs-12 col-without-padding" id="page_categ_text" data-categ-id="<?= $_GET['categ_id'] ?>">
        <? require('../vues/vues_ajax/ajax_edit_categ_text.php'); ?>

    </div>

    <div class="col-xs-12" id="page_categ_product" data-categ-id="<?= $_GET['categ_id'] ?>">
        <? require('../vues/vues_ajax/ajax_edit_product_categ.php'); ?>
    </div>
</div><?

if((isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == 'evengyl') && (isset($_SESSION['level']) && $_SESSION['level'] == 3))
{?>
    <div id="tool_bar_unique" class="btn-toolbar" data-role="editor-toolbar"  style="display:none;">
        <div class="btn-group">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Size"><span class="fas fa-text-height"></span>&nbsp;<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-edit="fontSize 5"><font size="5">Grand</font></a></li>
                <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                <li><a data-edit="fontSize 1"><font size="1">Petit</font></a></li>
            </ul>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><span class="glyphicon glyphicon-bold"></span></a>
            <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><span class="fas fa-italic"></span></a>
            <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><span class="fas fa-strikethrough"></span></a>
            <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><span class="fas fa-underline"></span></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><span class="fas fa-list-ul"></span></a>
            <a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><span class="glyphicon glyphicon-indent-right"></span></a>
            <a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><span class="glyphicon glyphicon-indent-left"></span></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><span class="fas fa-align-left"></span></a>
            <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><span class="fas fa-align-center"></span></a>
            <a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><span class="fas fa-align-right"></span></a>
        </div>
      <div class="btn-group">
            <a class="btn btn-default" id="save" title="Save"><span class="fas fa-save"></span></a>
            <a class="btn btn-default" id="hide" title="Hide"><span class="fas fa-window-close "></span></a>
        </div>
    </div>

    <script>

        $(document).ready(function()
        {
            function add_button_all()
            {
                //on ajoute les icon indiquant qu'on peux modifier
                var icon_pencil = '&nbsp;&nbsp;<span style="display:inline-block; color:#ffcfcf;" class="glyphicon glyphicon-pencil"></span>';
                $("[data-action='edit'], [data-action='edit_img']").after(icon_pencil).css("border", "1px dashed #ffcfcf");

                //ON ADD LE BOUTON D ADD PRODUT
                $("#page_categ_product").append('<button class="btn btn-primary col-xs-6 col-xs-offset-3" data-action="add_product">Add Product in this categ <span class="glyphicon glyphicon-plus"></span></button>');    
            }

            add_button_all();
            var edit_product_way = "/controller_ajax/ajax_edit_categ_text.php";

            
            

            $('#page_categ_text').on('click', "[data-action='edit']", function(){
                //quand on a cliquer sur un objet editable on ajoute un IDspécifique
                var block_data_edit = $(this);

                if (block_data_edit.attr('id') == 'editor') return;
     
                block_data_edit.attr('id', 'editor').after($("#tool_bar_unique").clone());
                var toolbar_actual = block_data_edit.next("[data-role='editor-toolbar']");

                toolbar_actual.removeAttr('id').css('display', 'block').attr(block_data_edit.attr('id'));

                block_data_edit.wrap("<div id='content_now_edit' class='col-xs-12'></div>").parent().append(toolbar_actual);
                block_data_edit.wysiwyg();
                var content_global = block_data_edit.parent();


                $(content_global).on('click', "#save", function(){
                    var changed = block_data_edit.html();


                    var column = block_data_edit.attr("data-column");
                    var table = block_data_edit.attr("data-table");
                    var id_text = block_data_edit.attr("data-id-text");
                    var id_categ = $("#page_categ_text").attr("data-categ-id");


                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:'action=edit&data='+changed+'&column='+column+'&table='+table+'&id_text='+id_text+'&id_categ='+id_categ+'',
                        success: function(data_return){
                            $("#page_categ_text").html( data_return );
                            add_button_all();
                        }
                    });
                    
                });

                $(content_global).on('click', "#hide", function(){
                    block_data_edit.unwrap().removeAttr('id');
                    toolbar_actual.remove();

                });

            });


            $('#page_categ_text').on('click', "[data-action='edit_img']", function(){
                //quand on a cliquer sur un objet editable on ajoute un IDspécifique
                var block_img_edit = $(this);

                //on empeche de ré-ouvrir l'éditeur si il est déjà actif
                if (block_img_edit.attr('id') == 'img_editor') return;


                var src_actuel = block_img_edit.attr('src');
                block_img_edit.attr('id', 'img_editor');

                block_img_edit.after('<input type="text" value="'+src_actuel+'" class="col-xs-12"><div class="btn-group">\
                                        <a class="btn btn-default" id="save" title="Save"><span class="fas fa-save"></span></a>\
                                        <a class="btn btn-default" id="hide" title="Hide"><span class="fas fa-window-close "></span></a>\
                                    </div>');

                var content_global_edit_image = block_img_edit.parent();

                $(content_global_edit_image).on('click', "#save", function(){
                    var changed = content_global_edit_image.children('input').val();
                    var column = block_img_edit.attr("data-column");
                    var table = block_img_edit.attr("data-table");
                    var id_categ = $("#page_categ_text").attr("data-categ-id");

                    console.log(id_categ);

                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:'action=edit_img&img='+changed+'&column='+column+'&table='+table+'&id_categ='+id_categ+'',
                        success: function(data_return){
                            $("#page_categ_text").html( data_return );
                            add_button_all();
                        }
                    });
                    
                });

                $(content_global_edit_image).on('click', "#hide", function(){
                    block_img_edit.removeAttr('id');
                    content_global_edit_image.children('input').remove();
                    content_global_edit_image.children('.btn-group').remove();

                });

            });

            $('#page_categ_product').on('click', "[data-action='add_product']", function(){
                
                //quand on a cliquer sur un objet editable on ajoute un IDspécifique
                var new_product = $(this);

                if ($("#block_add_new_product").length) return;

                new_product.after('<div id="block_add_new_product" class="col-xs-6 col-xs-offset-3" style="padding:15px;">\
                                        <input type="text" data-input="new_name_fr" placeholder="Product Name FR" class="col-xs-12">\
                                        <input type="text" data-input="new_name_en" placeholder="Product Name EN" class="col-xs-12">\
                                        <input type="text" data-input="new_name_nl" placeholder="Product Name NL" class="col-xs-12">\
                                        <input type="text" data-input="new_code" placeholder="Code Matedex" class="col-xs-12">\
                                        <input type="text" data-input="new_image" value="/images/product/" class="col-xs-12">\
                                        <div class="btn-group col-xs-12" style="padding-top:15px;">\
                                            <a class="col-xs-6 btn btn-success" id="save" title="Save"><span class="fas fa-save"></span></a>\
                                            <a class="col-xs-6 btn btn-warning" id="hide" title="Hide"><span class="fas fa-window-close "></span></a>\
                                        </div>\
                                    </div>');


                $("#block_add_new_product").on('click', "#save", function(){
                    var name_fr = $("#block_add_new_product [data-input='new_name_fr']").val();
                    var name_en = $("#block_add_new_product [data-input='new_name_en']").val();
                    var name_nl = $("#block_add_new_product [data-input='new_name_nl']").val();
                    var code = $("#block_add_new_product [data-input='new_code']").val();
                    var image = $("#block_add_new_product [data-input='new_image']").val();
                    var id_categ = $("#page_categ_text").attr("data-categ-id");


                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:'action=add_product&name_fr='+name_fr+'&name_en='+name_en+'&name_nl='+name_nl+'&code='+code+'&image='+image+'&table=ma_ft_product&id_categ='+id_categ,
                        success: function(data_return){
                            $("#page_categ_product").html( data_return );
                            add_button_all();
                        }
                    });
                    
                });

                $("#block_add_new_product").on('click', "#hide", function(){
                    $("#block_add_new_product").remove();
                });
            });
            
        });
    </script><?
}?>