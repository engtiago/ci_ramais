<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<br>

<div class="container my-5">
  <h2 class="my-4">
    Lista de Setores
    <?= anchor("Admin_ramal/novoSetor", "Novo Setor", array(
      "role" => "button",
      "class" => "btn btn-secondary"
    )); ?>
  </h2>

  <?php echo form_open(base_url('Admin_ramal/listaSetor')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "pesquisa",
          "id" => "pesquisa",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar setor"
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

  if ($setor == null) {
    echo '<h4>Não foi encontrado nenhum Setor</h4>';
  }
  ?>

  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Nome</td>
        <th>Setor</td>
        <th>Editar</td>
        <th>Excluir</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($setor as $setor) : ?>
        <tr>

          <td><?= html_escape($setor['nome_setor']) ?> </td>
          <td><?= html_escape($setor['ramal_setor']) ?> </td>

          <td>
            <?= anchor("Admin_ramal/verEditSetor/{$setor['id_setor']}", "Editar", array(
                "role" => "button",
                "class" => "btn btn-primary"
              )); ?>
          </td>

          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#setor<?= $setor['id_setor'] ?>">Excluir</button>
          </td>
        </tr>
        
        
        <div class="modal fade" id="setor<?=$setor['id_setor'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você deseja realmente excluir o setor: <?= html_escape($setor['nome_setor']) ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?= anchor("Admin_ramal/function_deletarSetor/{$setor['id_setor']}", "Excluir", array(
                    "role" => "button",
                    "class" => "btn btn-danger"
                  )); ?>
                <!-- <button type="button" class="btn btn-danger">Excluir</button> -->
              </div>
            </div>
          </div>
        </div>
        



      <?php endforeach ?>
  </table>
</div>