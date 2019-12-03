<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php

if ($receita == null) {
    $titulo = "Nova Receita";
    $receita['id_receita'] = "";
    $receita['nome_receita'] = "";
    $receita['ingredientes_receita'] = "";
    $receita['modo_preparo_receita'] = "";
    $receita['rendimento_receita'] = "";
    $receita['tempo_receita'] = "";
    $receita['status_receita'] = "Ativo";
    $receita['categoria_receita_id_categoria_receita'] = 1;
    $receita['foto_receita'] = null;
    $receita['descricao_receita'] = "";
} else {
    $titulo = "Editar Receita";
}

?>

<div class="container my-5">

    <h2 class="my-3">
        <?= $titulo ?>
        <?= anchor("Admin_receitas/listareceitas", "Ver Receitas", array(
            "role" => "button",
            "class" => "btn btn-secondary"
        )); ?>
    </h2>


    <?php
    $div_form_row = '<div class="form-row">';
    $div_form_col = '<div class="col-md-6 mt-3 form-group">';
    $end_div = '</div>';


    echo form_open_multipart($formsubmit);
    echo ($div_form_row);

    echo form_hidden("id_receita", $receita['id_receita']);

    echo ($div_form_col);
    echo form_label("Titulo Receita:", "nome_receita");
    echo form_input(array(
        "name" => "nome_receita",
        "id" => "nome_receita",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $receita['nome_receita']
    ));
    echo ($end_div);


    echo ($div_form_col);
    echo form_label("Rendimento:", "rendimento_receita");
    echo form_input(array(
        "name" => "rendimento_receita",
        "id" => "rendimento_receita",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $receita['rendimento_receita']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Tempo:", "tempo_receita");
    echo form_input(array(
        "name" => "tempo_receita",
        "id" => "tempo_receita",
        "maxlength" => "255",
        "required" => "true",
        "class" => "form-control",
        "value" =>  $receita['tempo_receita']
    ));
    echo ($end_div);


    echo ($div_form_col);
    foreach ($categorias as $categorias) {
        $optionsCategorias[$categorias["id_categoria_receita"]] = $categorias["nome_categoria_receita"];
        //print_r($option);
    }
    echo form_label("Categoria:", "categoria_receita_id_categoria_receita");
    echo form_dropdown('categoria_receita_id_categoria_receita', $optionsCategorias, $receita['categoria_receita_id_categoria_receita'], array(
        "name" => "categoria_receita_id_categoria_receita",
        "id" => "categoria_receita_id_categoria_receita",
        "required" => "true",
        "class" => "form-control"
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Ingredientes:", "ingredientes_receita");
    echo form_textarea(array(
        "name" => "ingredientes_receita",
        "id" => "ingredientes_receita",
        "class" => "form-control",
        "maxlength" => "1000",
        "rows" => "3",
        "value" =>  $receita['ingredientes_receita']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Modo de preparo:", "modo_preparo_receita");
    echo form_textarea(array(
        "name" => "modo_preparo_receita",
        "id" => "modo_preparo_receita",
        "class" => "form-control",
        "maxlength" => "2500",
        "rows" => "3",
        "value" =>  $receita['modo_preparo_receita']
    ));
    echo ($end_div);

    echo ($div_form_col);
    $optionsStatus = array(
        'ativo' => 'Ativo',
        'inativo' => 'Inativo'
    );
    echo form_label("Status:", "status_receita");
    echo form_dropdown('status_receita', $optionsStatus, $receita['status_receita'], array(
        "name" => "status_receita",
        "id" => "status_receita",
        "required" => "true",
        "class" => "form-control"
    ));
    echo ($end_div);


    if ($receita['foto_receita'] == null) {
        $testa_foto_required = "required";
    } else {
        $testa_foto_required = "POG";
    };
    if (!$receita['foto_receita'] == null) {
        echo form_hidden("foto_receita", $receita['foto_receita']);
    };
    echo ($div_form_col);
    echo form_label("Foto da Receita:", "foto_receita");
    echo form_upload(array(
        "type" => "text",
        "class" => "form-control-file",
        $testa_foto_required => "true",
        "class" => "form-control-file",
        "name" => "foto_receita",
        "id" => "foto_receita"
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Descrição:", "descricao_receita");
    echo form_textarea(array(
        "name" => "descricao_receita",
        "id" => "descricao_receita",
        "class" => "form-control",
        "maxlength" => "255",
        "rows" => "3",
        "value" =>  $receita['descricao_receita']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_button(array(
        "class" => "btn btn-primary ml-alto",
        "content" => "Salvar",
        "type" => "submit"
    ));
    echo ($end_div);


    echo ($end_div); //end form_row


    echo form_close();
    ?>
</div>
</div>

<script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=l1ho0r7zsdvg6m1ovbuawez8ufxh41ygzvygnd2o1zuv6x1r'></script>
<script>
    tinymce.init({
        selector: '#ingredientes_receita'
    });

    tinymce.init({
        selector: '#modo_preparo_receita'
    });
</script>