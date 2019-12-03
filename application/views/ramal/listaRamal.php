<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container my-5">
  <h2 class="my-4">
    Lista de Receitas
    <?= anchor("Admin_receitas/novareceita", "Nova Receita", array(
      "role" => "button",
      "class" => "btn btn-secondary"
    )); ?>
  </h2>
    
  <?php echo form_open(base_url('admin_receitas/listareceitas')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "nome_receita",
          "id" => "nome_receita",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar Receitas"
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
  
  if ($receitas == null) {
    echo '<h4>Não foi encontrado nenhuma receita</h4>';
  }
  ?>

  

  <table class="table table-striped table-responsive">
    <thead>
      <tr>
        <th>Foto</td>
        <th><a href="<?= base_url('Admin_receitas/listareceitas/nome_receita/'.$pesquisa."/".$this->uri->segment(5)) ?>">Titulo<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_receitas/listareceitas/status_receita/'.$pesquisa."/".$this->uri->segment(5)) ?>">Status<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th><a href="<?= base_url('Admin_receitas/listareceitas/nome_categoria_receita/'.$pesquisa."/".$this->uri->segment(5)) ?>">Categoria<i style="font-size:11px" class="fas fa-chevron-down"></i></a></td>
        <th>Editar</td>
        <th>Excluir</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($receitas as $receitas) : ?>
        <tr>
          <td style="max-width: 15px; max-height: 15px;">
            <img style="max-width: 40%; max-height: 40%;" src="<?= base_url('upload/receita/') ?><?= html_escape($receitas['foto_receita']) ?>" alt="">
          </td>
          <td><?= html_escape($receitas['nome_receita']) ?> </td>
          <td><?= html_escape($receitas['status_receita']) ?></td>
          <td><?= html_escape($receitas['nome_categoria_receita']) ?></td>
          <td>
            <?= anchor("Admin_receitas/vereditreceita/{$receitas['id_receita']}", "Editar", array(
              "role" => "button",
              "class" => "btn btn-primary"
            )); ?>
          </td>

          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#receita_<?= $receitas['id_receita'] ?>">Excluir</button>
          </td>
        </tr>

        <div class="modal fade" id="receita_<?= $receitas['id_receita'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você deseja realmente excluir a Receita: <?= html_escape($receitas['nome_receita']) ?> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?=anchor("Admin_receitas/function_deletarReceita/{$receitas['id_receita']}", "Excluir", array(
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