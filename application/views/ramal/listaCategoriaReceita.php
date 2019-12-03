<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- //var_dump($categoriaReceita); exit;  -->
<div class="container my-5">
    <h2 class="my-4">
    Lista de categorias de receitas
        <?= anchor("Admin_receitas/novacategoriareceita", "Nova Categoria de receita", array(
            "role" => "button",
            "class" => "btn btn-secondary"
        )); ?>
    </h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Categoria</td>
      <th>Descricão</td>
      <th>Editar</td>
      <th>Excluir</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categoriaReceita as $categoriaReceita) : ?>
      <tr>
        <td><?= html_escape($categoriaReceita['nome_categoria_receita']) ?></td>
        <td><?= html_escape(word_limiter($categoriaReceita['descricao_categoria_receita'],3,"...")) ?></td>
        <td>
            <?= anchor("Admin_receitas/vereditcategoriareceita/{$categoriaReceita['id_categoria_receita']}", "Editar", array(
              "role" => "button",
              "class" => "btn btn-primary"
            )); ?>
          </td>

          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#categoria_<?= $categoriaReceita['id_categoria_receita'] ?>">Excluir</button>
          </td>
        </tr>

        <div class="modal fade" id="categoria_<?= $categoriaReceita['id_categoria_receita'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você deseja realmente excluir a categoria: <?= html_escape($categoriaReceita['nome_categoria_receita']) ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?=anchor("Admin_receitas/function_deletCategoriaReceita/{$categoriaReceita['id_categoria_receita']}", "Excluir", array(
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
</div>