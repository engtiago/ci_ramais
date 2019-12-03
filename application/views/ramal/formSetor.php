<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($categoriaReceita == null) {
    $titulo = "Nova Categoria de Receita";
    $categoriaReceita['id_categoria_receita'] = "";
    $categoriaReceita['nome_categoria_receita'] = "";
    $categoriaReceita['descricao_categoria_receita'] = "";
} else {
    $titulo = "Editar Categoria de Receita";
}
?>

<div class="container my-5">
<h2 class="my-3">
        <?= $titulo ?>
        <?= anchor("Admin_receitas/listacategoriareceitas", "Ver categorias de Receitas", array(
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

    echo form_hidden("id_categoria_receita", $categoriaReceita['id_categoria_receita']);

    echo ($div_form_col);
    echo form_label("Nome da categoria:", "nome_categoria_receita");
    echo form_input(array(
        "name" => "nome_categoria_receita",
        "id" => "nome_categoria_receita",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $categoriaReceita['nome_categoria_receita']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Descricão Categoria:", "descricao_categoria_receita");
    echo form_input(array(
        "name" => "descricao_categoria_receita",
        "id" => "descricao_categoria_receita",
        "class" => "form-control",
        "maxlength" => "255",
        "value" =>  $categoriaReceita['descricao_categoria_receita']
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