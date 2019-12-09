<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php

if ($ramal == null) {
    $titulo = "Novo ramal";
    $ramal['id_ramal'] = "";
    $ramal['nome_ramal'] = "";
    $ramal['numero_ramal'] = "";
    $ramal['email_ramal'] = "";
    $ramal['setor_id_setor'] = "";
    $ramal['celular_ramal'] = "";
} else {
    $titulo = "Editar ramal";
}

?>
<div class="container my-5">

    <h2 class="my-3">
        <?= $titulo ?>
        <?= anchor("Admin_ramal/listaRamais", "Ver Ramais", array(
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

    echo form_hidden("id_ramal", $ramal['id_ramal']);

    echo ($div_form_col);
    echo form_label("Nome:", "nome_ramal");
    echo form_input(array(
        "name" => "nome_ramal",
        "id" => "nome_ramal",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $ramal['nome_ramal']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Número:", "numero_ramal");
    echo form_input(array(
        "name" => "numero_ramal",
        "id" => "numero_ramal",
        "class" => "form-control",
        "maxlength" => "255",
        "value" =>  $ramal['numero_ramal']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Celular:", "celular_ramal");
    echo form_input(array(
        "name" => "celular_ramal",
        "id" => "celular_ramal",
        "class" => "form-control",
        "maxlength" => "255",
        "data-mask" => "(00)000000000",
        "value" =>  $ramal['celular_ramal']
    ));
    echo ($end_div);

    echo ($div_form_col);
    echo form_label("Email:", "email_ramal");
    echo form_input(array(
        "name" => "email_ramal",
        "id" => "email_ramal",
        "maxlength" => "255",
        "class" => "form-control",
        "value" =>  $ramal['email_ramal']
    ));
    echo ($end_div);

    echo ($div_form_col);

    $optionsSetor = [];
    foreach ($setor as $setores) {
        $optionsSetor[$setores["id_setor"]] = $setores["nome_setor"];
        
    }
    echo form_label("Setor:", "setor_id_setor");
    echo form_dropdown('setor_id_setor', $optionsSetor, $ramal['setor_id_setor'], array(
        "name" => "setor_id_setor",
        "id" => "setor_id_setor",
        "required" => "true",
        "class" => "form-control"
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