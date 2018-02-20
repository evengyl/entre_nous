///////////////////////////////
//  Editing simple with ajax //
//  baudoux loic             //
//  19/02/2018               //
///////////////////////////////

// utilisation, mettre dans un text translatable de la bsd ex : data-action="edit_simple_lang" data-global="table.champ(sans _fr_en_nl).id(id de la ligne dans la table)"

$(document).ready(function()
{
    //part mise en marche avec l'ajout de l'icon de modif de translate
    var icon_pencil = '<div class="col-xxs-12 block_icon_translate"><span class="glyphicon glyphicon-pencil"></span>&nbsp;<span class="fa fa-language"></span></div>';
    $("[data-action='edit_simple_lang']").after(icon_pencil);

});


//part editing translating words and sentences
function fct_edit_translate(obj_this, data_global, block_to_reload, way_controller)
{

    //travail sur le data global
    var data = data_global.split('.');

    var table = data[0];
    var champ_to_translate = data[1];
    var id = data[2];

    //fin

    $(".block_edit_trans").fadeOut("slow");


    $.post(way_controller, {"action":"get_form_for_change_trans_ajax", "id":id, "table":table, "var":champ_to_translate}, function( data_return )
    {  
        $(obj_this).after(data_return);

        $("[data-action='save_trans_modified']").on('click', function()
        {
            var change_fr = $(".block_edit_trans [data-spec='fr']").val();
            var change_en = $(".block_edit_trans [data-spec='en']").val();
            var change_nl = $(".block_edit_trans [data-spec='nl']").val();

            $.post(way_controller, {"action":"save_modified_trans", fr:change_fr, en:change_en, nl:change_nl, "table":table, "id":id, "var":champ_to_translate}, function( data_return )
            {
                $(obj_this).html( data_return );
                $(".block_edit_trans").fadeOut("slow");
                console.log($(obj_this).find('span .glyphicon-pencil').length)
                if($(obj_this).find('span .glyphicon-pencil').length){
                    $(obj_this).after(icon_pencil);
                }
            });
        });

        $("[data-action='remove_form_trans']").on('click', function()
        {
            $(".block_edit_trans").fadeOut("slow");
        });
    });
}
