<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container my-5">
  <h2 class="my-4">
    Todas as Instruções
    <?= anchor(base_url("Admin_instrucoes/novopost"), "Nova Instrução", array(
      "role" => "button",
      "class" => "btn btn-secondary"
    )); ?>
  </h2>

  <?php echo form_open(base_url('Admin_instrucoes/listaPostsBlog')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "titulo_post_blog",
          "id" => "titulo_post_blog",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar posts"
        )
      );
      ?>

    </div>
    <div class="col-4 col-sm-3">
      <?php echo form_button(array(
        "class" => "btn btn-danger",
        "content" => "Pesquisar",
        "type" => "submit"
      )); ?>
    </div>
  </div>
  <?php echo form_close();

  if ($post_blog == null) {
    echo '<h4>Não foi encontrado nenhuma receita</h4>';
  }
  ?>


  <table class="table table-striped">
    <thead>
      <tr>
        <th>Foto</td>
        <th><a href="<?= base_url('Admin_instrucoes/listaPostsBlog/titulo_post_blog/' . $pesquisa . "/" . $this->uri->segment(5)) ?>">Titulo<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_instrucoes/listaPostsBlog/categoria_post_blog/' . $pesquisa . "/" . $this->uri->segment(5)) ?>">Categoria<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_instrucoes/listaPostsBlog/texto_post_blog/' . $pesquisa . "/" . $this->uri->segment(5)) ?>">Texto<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>

        <th>Editar</td>
        <th>Excluir</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($post_blog as $post_blog) : ?>
        <tr>
          <td style="max-width: 15px; max-height: 15px;">
            <img style="max-width: 40%; max-height: 40%;" src="<?= base_url('upload/blog/') ?><?= html_escape($post_blog['img_post_blog']) ?>" alt="">
          </td>
          <td><?= html_escape($post_blog['titulo_post_blog']) ?> </td>
          <td><?= html_escape($post_blog['categoria_post_blog']) ?></td>
          <td><?php
              $teste =  html_escape($post_blog['texto_post_blog']);
              echo character_limiter($teste, 30, "..."); ?></td>
          <td>
            <?= anchor("Admin_instrucoes/verEditPost/{$post_blog['id_post_blog']}", "Editar", array(
              "role" => "button",
              "class" => "btn btn-primary"
            )); ?>
          </td>

          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post_<?= $post_blog['id_post_blog'] ?>">Excluir</button>
          </td>
        </tr>

        <div class="modal fade" id="post_<?= $post_blog['id_post_blog'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você deseja realmente excluir o post: <?= html_escape($post_blog['titulo_post_blog']) ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?=anchor("Admin_instrucoes/function_deletarPost/{$post_blog['id_post_blog']}", "Excluir", array(
                  "role" => "button",
                  "class" => "btn btn-danger"
                )); ?>
                <!-- <button type="button" class="btn btn-danger">Excluir</button> -->
              </div>
            </div>
          </div>
        </div>

        </tr>
      <?php endforeach ?>
  </table>
  <p><?php echo $links; ?></p>
</div>