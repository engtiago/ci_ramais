<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if ($post_blog == null) {
    $titulo = "Nova Instrução";
    $post_blog['id_post_blog'] = "";
    $post_blog['titulo_post_blog'] = "";
    $post_blog['categoria_post_blog'] = "";
    $post_blog['texto_post_blog'] = "";
    $post_blog['img_post_blog'] = "";
} else {
    $titulo = "Editar Instrução";
}
?>

<div class="container my-5">

    <h2 class="my-3">
        <?= $titulo ?>
        <?= anchor(base_url() . "Admin_instrucoes/listaPostsBlog", "Ver Instruções", array(
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

    echo form_hidden("id_post_blog", $post_blog['id_post_blog']);

    echo ($div_form_col);
    echo form_label("Titulo Post:", "titulo_post_blog");
    echo form_input(array(
        "name" => "titulo_post_blog",
        "id" => "titulo_post_blog",
        "class" => "form-control",
        "maxlength" => "1000",
        "required" => "true",
        "value" =>  $post_blog['titulo_post_blog']
    ));
    echo ($end_div);


    echo ($div_form_col);
    echo form_label("Categoria:", "categoria_post_blog");
    echo form_input(array(
        "name" => "categoria_post_blog",
        "id" => "categoria_post_blog",
        "class" => "form-control",
        "maxlength" => "255",
        "required" => "true",
        "value" =>  $post_blog['categoria_post_blog']
    ));
    echo ($end_div);

    echo ('<div class="col-md-12 mt-3 form-group">');
    echo form_label("Instrução:", "texto_post_blog");
    echo form_textarea(array(
        "name" => "texto_post_blog",
        "id" => "texto_post_blog",
        "class" => "form-control",
        "maxlength" => "10000",
        "rows" => "15",
        "value" =>  $post_blog['texto_post_blog']
    ));
    echo ($end_div);


    if ($post_blog['img_post_blog'] != null) {
        echo form_hidden("img_post_blog", $post_blog['img_post_blog']);
    };
    echo ($div_form_col);
    echo form_label("Imagem:", "img_post_blog");
    echo form_upload(array(
        "type" => "text",
        "class" => "form-control-file",
        "name" => "img_post_blog",
        "id" => "img_post_blog"
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

<!-- importa o text box  -->
<script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=l1ho0r7zsdvg6m1ovbuawez8ufxh41ygzvygnd2o1zuv6x1r'></script>
<script>
    tinymce.init({
        selector: '#texto_post_blog'
    });
</script>