<div class="page_product col-xs-12 col-without-padding">
    <div class="col-xs-12" id='product_page' data-id-product="<?= $product->id ?>">
        <? require('../vues/vues_ajax/ajax_edit_product.php'); ?>
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
            <a class="btn btn-default" id="trash" title="Trash"><span class="fas fa-trash"></span></a>
            <a class="btn btn-default" id="hide" title="Hide"><span class="fas fa-window-close "></span></a>
        </div>
    </div>
      


    <script>

        function add_icon()
        {
            //on ajoute les icon indiquant qu'on peux modifier
            var icon_pencil = '&nbsp;&nbsp;<span style="display:inline-block; color:#ffcfcf;" class="glyphicon glyphicon-pencil"></span>';
            $("[data-action='edit'").after(icon_pencil).css({"border" : "1px dashed #ffcfcf"});

            var icon_add = '&nbsp;&nbsp;<span style="cursor:pointer; color:#00f9dc;" class="glyphicon glyphicon-plus" id="add_attribut"></span>';
            $("#block_attribut h3").append(icon_add);

            var icon_add = '&nbsp;&nbsp;<span style="cursor:pointer; color:#00f9dc;" class="glyphicon glyphicon-plus" id="add_caract"></span>';
            $("#block_caract h3").append(icon_add); 

            //ON ADD LE BOUTON D ADD DOC
            $("#product_document").append('<button class="btn btn-primary col-xs-6 col-xs-offset-3" data-action="add_document">Add Document on this product<span class="glyphicon glyphicon-plus"></span></button>');     
            $("#product_document .thumbnail").append('<button class="btn btn-default"><span style="cursor:pointer;" data-action="delete_document" class="glyphicon glyphicon-trash"></span></button>');     

        }

        $(document).ready(function()
        {
            //récup prod id
            var prod_id = $("#product_page").attr('data-id-product');


            var edit_product_way = "/controller_ajax/ajax_edit_product.php";

            add_icon();

            $('#product_page').on('click', "[data-action='edit']", function(){
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
                    var id = block_data_edit.attr("data-id");

                    
                    if(typeof(block_data_edit.attr("data-id-attribut")) !== "undefined"){
                        var id_attribut = block_data_edit.attr("data-id-attribut");
                    }else{
                        var id_attribut = "";
                    }

                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:'action=edit&data='+changed+'&column='+column+'&table='+table+'&id_product='+id+'&id_attribut='+id_attribut+'',
                        success: function(data_return){
                            $("#product_page").html( data_return );
                            add_icon();
                        }
                    });
                    
                });

                $(content_global).on('click', "#hide", function(){
                    block_data_edit.unwrap().removeAttr('id');
                    toolbar_actual.remove();

                });


                $(content_global).on('click', "#trash", function(){


                    var column = block_data_edit.attr("data-column");
                    var table = block_data_edit.attr("data-table");
                    var id = block_data_edit.attr("data-id");

                    
                    if(typeof(block_data_edit.attr("data-id-attribut")) !== "undefined"){
                        var id_attribut = block_data_edit.attr("data-id-attribut");
                    }else{
                        var id_attribut = "";
                    }

                    if(typeof(block_data_edit.attr("data-id-line-product")) !== "undefined"){
                        var id_line_caract = block_data_edit.attr("data-id-line-product");
                    }else{
                        var id_line_caract = "";
                    }

                    
                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:'action=trash&column='+column+'&table='+table+'&id_product='+id+'&id_attribut='+id_attribut+'&id_line_caract='+id_line_caract,
                        success: function(data_return){
                            $("#product_page").html( data_return );
                            add_icon();
                        }
                    });

                    block_data_edit.unwrap().removeAttr('id');
                    toolbar_actual.remove();
                });

            });


            $("#product_page").on('click', '#add_caract' ,function(){
                $.post(edit_product_way, {"action":"get_all_caract_name"}, function( data_return )
                {
                    $("#box_for_add_caract").html( data_return );
                });
            

                $("#product_page").on("click", "#save_caract", function(event){
                    event.preventDefault();
                    var selected_id_caract_name = $("#form_add_caract select option:selected").val(); //l'id du select name sélectionné
                    var input_caract_value = $("#form_add_caract input[data-name='value_caract']").val(); //valeur du input value que l'on à écris

                    //on test si y c'est un new name ajouter
                    var new_caract_name_fr = "";
                    var new_caract_name_en = "";
                    var new_caract_name_nl = "";

                    if($("#form_add_caract select option:selected").val() == "other")
                    {
                        new_caract_name_fr = $("#form_add_caract label input[data-name='value_new_caract_fr']").val();
                        new_caract_name_en = $("#form_add_caract label input[data-name='value_new_caract_en']").val();
                        new_caract_name_nl = $("#form_add_caract label input[data-name='value_new_caract_nl']").val();
                    }

                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:"action=add_caract&id_product="+prod_id+"&id_caract_name="+selected_id_caract_name+"&caract_value="+input_caract_value+"&new_caract_name_fr="+new_caract_name_fr+"&new_caract_name_en="+new_caract_name_en+"&new_caract_name_nl="+new_caract_name_nl+"",
                        success: function(data_return){
                            $("#product_page").html( data_return );
                            add_icon();
                        }
                    });

                    $("#product_page").on("change", "#form_add_caract select", function()
                    {
                        var selected_value_caract_name = $("#form_add_caract select option:selected").val();
                        if(selected_value_caract_name == "other")
                        {
                            $('label').show();
                        }
                        else
                        {
                            $('label').hide();
                        }
                    });

                });
            });


            



            


           


            $("#product_page").on('click', '#add_attribut' ,function(){

                $("#box_for_add_attribut").html('<form id="form_add_attribut"><label>\
                    <input class="form-control" data-name="new_attribut_name_fr" placeholder="New Name Attribut. FR"></input>\
                    <input class="form-control" data-name="new_attribut_name_en" placeholder="New Name Attribut. EN"></input>\
                    <input class="form-control" data-name="new_attribut_name_nl" placeholder="New Name Attribut. NL"></input>\
                </label><a class="col-xs-12 btn btn-primary" style="padding-left:10px; padding-right:10px;" id="save_attribut" title="Save"><span class="fas fa-save">&nbsp;Save New attribute</span></a></form>')


                $("#product_page").on("click", "#save_attribut", function()
                {
                    var new_attribut_name_fr = $("#form_add_attribut label input[data-name='new_attribut_name_fr']").val();
                    var new_attribut_name_en = $("#form_add_attribut label input[data-name='new_attribut_name_en']").val();
                    var new_attribut_name_nl = $("#form_add_attribut label input[data-name='new_attribut_name_nl']").val();

                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:"action=add_attribut&id_product="+prod_id+"&new_attribut_name_fr="+new_attribut_name_fr+"&new_attribut_name_en="+new_attribut_name_en+"&new_attribut_name_nl="+new_attribut_name_nl,
                        success: function(data_return){
                            $("#product_page").html( data_return );
                            add_icon();
                        }
                    });
                });
            });

            
            $("#product_page").on('click', '[data-action="add_document"]' ,function(){

                if ($("#block_add_new_document").length) return;

                $(this).after('<div id="block_add_new_document" class="col-xs-6 col-xs-offset-3" style="padding:15px;">\
                                        <input type="text" data-input="new_name_doc_fr" placeholder="Document Name FR" class="col-xs-12">\
                                        <input type="text" data-input="new_name_doc_en" placeholder="Document Name EN" class="col-xs-12">\
                                        <input type="text" data-input="new_name_doc_nl" placeholder="Document Name NL" class="col-xs-12">\
                                        <input type="text" data-input="new_doc_url" value="(document)/pdf/product_document/" class="col-xs-12">\
                                        <input type="text" data-input="new_doc_img" value="(image)/pdf/product_document/" class="col-xs-12">\
                                        <div class="btn-group col-xs-12" style="padding-top:15px;">\
                                            <a class="col-xs-6 btn btn-success" id="save" title="Save"><span class="fas fa-save"></span></a>\
                                            <a class="col-xs-6 btn btn-warning" id="hide" title="Hide"><span class="fas fa-window-close "></span></a>\
                                        </div>\
                                    </div>');


                $("#block_add_new_document").on("click", "#save", function()
                {
                    var new_name_doc_fr = $("input[data-input='new_name_doc_fr']").val();
                    var new_name_doc_en = $("input[data-input='new_name_doc_en']").val();
                    var new_name_doc_nl = $("input[data-input='new_name_doc_nl']").val();
                    var new_doc_url = $("input[data-input='new_doc_url']").val();
                    var new_doc_img = $("input[data-input='new_doc_img']").val();

                    $.ajax({
                        url: edit_product_way,
                        type: "POST",
                        data:"action=add_document&id_product="+prod_id+"&new_name_doc_fr="+new_name_doc_fr+"&new_name_doc_en="+new_name_doc_en+"&new_name_doc_nl="+new_name_doc_nl+"&new_doc_url="+new_doc_url+"&new_doc_img="+new_doc_img,
                        success: function(data_return){
                            $("#product_page").html( data_return );
                            add_icon();
                        }
                    });
                });


                $("#block_add_new_document").on('click', "#hide", function(){
                    $("#block_add_new_document").remove();
                });
            });


            $("#product_page").on('click', '[data-action="delete_document"]' ,function(){

                if(!confirm("Voulez-vous vraiment supprimer le document ?")) return;

                $.ajax({
                    url: edit_product_way,
                    type: "POST",
                    data:"action=delete_document&id_document="+$(this).parent().attr("data-id")+"&id_product="+prod_id,
                    success: function(data_return){
                        $("#product_page").html( data_return );
                        add_icon();
                    }
                });
            });
        });
    </script><?
}?>

