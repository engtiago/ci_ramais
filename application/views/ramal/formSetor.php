<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($setor == null) {
    $titulo = "Novo Setor";
    $setor['id_setor'] = "";
    $setor['nome_setor'] = "";
    $setor['ramal_setor'] = "";
} else {
    $titulo = "Editar setor";
}
?>

<div class="container my-5">
<h2 class="my-3">
        <?= $titulo ?>
        <?= anchor("Admin_ramal/listaSetor", "Ver Setores", array(
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

    echo form_hidden("id_setor", $setor['id_setor']);

    echo ($div_form_col);
    echo form_label("Nome do setor:", "nome_setor");
    echo form_input(array(
        "name" => "nome_setor",
        "id" => "nome_setor",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $setor['nome_setor']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Ramal Principal:", "ramal_setor");
    echo form_input(array(
        "name" => "ramal_setor",
        "id" => "ramal_setor",
        "class" => "form-control",
        "maxlength" => "255",
        "value" =>  $setor['ramal_setor']
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