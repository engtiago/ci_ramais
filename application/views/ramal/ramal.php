<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container mt-4">

  <p class="texto-descricao">Lista com todos os Ramais</p>
</div>

<div class="container text-right my-3">
  <?php echo form_open('Ramal/listaRamais') ?>
  <div class="row">
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
  <?php echo form_close(); ?>
</div>

<div class="container mt-3 text-center">

  <div class="row">

    <?php
    if ($ramal == null) {
      echo '<h4>Não foi encontrado nenhum ramal</h4>';
    }
    ?>
    <div class="row">
      <?php foreach ($setor as $setor) : ?>

        <div class="col-sm-6 col-md-4">
          <div class="accordion m-2" id="ramal-teste">
            <div class="card">
              <div style="background-color: #fcb426;" class="card-header" id="setores">
                <h2 class="mb-0">
                  <button style="color: #383d41;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#S<?= $setor['id_setor'] ?>" aria-expanded="false" aria-controls="S<?= $setor['id_setor'] ?>">
                    <i class="fas fa-phone-alt"></i> <?= $setor['nome_setor'] ?>
                  </button>
                </h2>
              </div>
              <div id="S<?= $setor['id_setor'] ?>" class="collapse" aria-labelledby="setores" data-parent="#ramal-teste">

                <div class="card-body">

                  <div class="list-group">
                    <?php foreach ($ramal as $ramal2) : ?>
                      <?php if ($ramal2['setor_id_setor'] == $setor['id_setor']) : ?>


                        <!-- Button trigger modal -->
                        <button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#R_<?= $ramal2['id_ramal'] ?>">
                          <i class="fas fa-user"></i> <?= $ramal2['nome_ramal'] ?>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="R_<?= $ramal2['id_ramal'] ?>" tabindex="-1" role="dialog" aria-labelledby="R_<?= $ramal2['id_ramal'] ?>Title" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="R_<?= $ramal2['id_ramal'] ?>Title">Contato do <?= $ramal2['nome_ramal'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-6">
                                    <img class="img-fluid" src="<?= $this->load->geraQRCODE($ramal2['nome_ramal'], $ramal2['email_ramal'], $ramal2['celular_ramal'], '(91)34122100') ?>" alt="">
                                    Ler QRcode para adicionar contato Rápido.
                                  </div>
                                  <div class="col-6 lista-contato">
                                    <h3> <i class="far fa-address-card"></i> Contato</h3>
                                    <hr>
                                    <i class="fas fa-user"></i> Nome: <?= $ramal2['nome_ramal'] ?>
                                    <hr>
                                    <a href="tel:9134122100"> <i class="fas fa-phone"></i> Ramal: <?= $ramal2['numero_ramal'] ?></a>
                                    <hr>
                                    <a href="tel:<?= $ramal2['celular_ramal'] ?>"><i class="fas fa-mobile-alt"></i> Celular: <?= $ramal2['celular_ramal'] ?></a>
                                    <hr>
                                    <a href="mailto:<?= $ramal2['email_ramal'] ?>"><i class="far fa-envelope"></i> Email: <?= $ramal2['email_ramal'] ?></a>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php endif ?>

                    <?php endforeach ?>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach ?>
    </div>
    <div class="container mb-5">
    </div>

  </div>
</div>

