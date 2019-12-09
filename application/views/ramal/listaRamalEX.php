<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<br>

<div class="container my-5">
  <h2 class="my-4">
    <button class="btn btn-secondary" onclick="window.history.go(-1)"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar </button> Lista de Ramais
  </h2>


  <?php echo form_open(base_url('Ramal/listaRamais')); ?>
  <div class="row text-center my-3">
    <div class="col-8 col-sm-9">
      <?php
      echo form_input(
        array(
          "name" => "pesquisa",
          "id" => "pesquisa",
          "class" => "form-control",
          "maxlength" => "255",
          "placeholder" => "Buscar ramais por nome, numero ou setor"
        )
      );
      ?>

    </div>
    <div class="col-4 col-sm-3">
      <?php echo form_button(array(
        "class" => "btn btn-secondary",
        "content" => "Pesquisar",
        "type" => "submit"
      )); ?>
    </div>
  </div>
  <?php echo form_close();
  ?>

  <?php if ($ramal == null) : ?>
    <h4>Não foi encontrado nenhum Ramal</h4>

  <?php else : ?>
    <table class="table table-striped table-responsive text-center">
      <thead>
        <tr>
          <th>QRCode</td>
          <th>Nome</td>
          <th>Setor</td>
          <th>Ramal</td>
          <th>Celular</td>
          <th>Email</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ramal as $ramal) : ?>
          <tr>
            <td>
              <button type="button" class="btn btn-light" data-toggle="modal" data-target="#R_<?= $ramal['id_ramal'] ?>"><i class="fas fa-qrcode"></i></button>
            </td>

            <td><?= html_escape($ramal['nome_ramal']) ?> </td>
            <td><?= html_escape($ramal['nome_setor']) ?> </td>
            <td><?= html_escape($ramal['numero_ramal']) ?></td>
            <td><?= html_escape($ramal['celular_ramal']) ?></td>
            <td><?= html_escape($ramal['email_ramal']) ?></td>
          </tr>


          <div class="modal fade" id="R_<?= $ramal['id_ramal'] ?>" tabindex="-1" role="dialog" aria-labelledby="R_<?= $ramal['id_ramal'] ?>Title" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="R_<?= $ramal['id_ramal'] ?>Title">Contato do <?= $ramal['nome_ramal'] ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <img class="img-fluid" src="<?= $this->load->geraQRCODE($ramal['nome_ramal'], $ramal['email_ramal'], $ramal['celular_ramal'], '(91)34122100') ?>" alt="">
                      Ler QRcode para adicionar contato Rápido.
                    </div>
                    <div class="col-6 lista-contato">
                      <h3> <i class="far fa-address-card"></i> Contato</h3>
                      <hr>
                      <i class="fas fa-user"></i> Nome: <?= $ramal['nome_ramal'] ?>
                      <hr>
                      <a href="tel:9134122100"> <i class="fas fa-phone"></i> Ramal: <?= $ramal['numero_ramal'] ?></a>
                      <hr>
                      <a href="tel:<?= $ramal['celular_ramal'] ?>"><i class="fas fa-mobile-alt"></i> Celular: <?= $ramal['celular_ramal'] ?></a>
                      <hr>
                      <a href="mailto:<?= $ramal['email_ramal'] ?>"><i class="far fa-envelope"></i> Email: <?= $ramal['email_ramal'] ?></a>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
              </div>
            </div>
          </div>



          </tr>
        <?php endforeach ?>
    </table>

  <?php endif ?>
</div>