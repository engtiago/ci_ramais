<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="page-header site-bg" style="background: url('<?= base_url('assets/img/receita-bg-3.png') ?>') no-repeat center center">
</div>
<div class="container mt-4">
  <p class="texto-descricao" >Que tal variar o cardápio? Confira as receitas para preparar as refeições mais deliciosas para comer junto com toda a família.  Aproveite para usar vários ingredientes do catálogo variado da Mariza!</p>
</div>

<div class="container text-right my-3">
  <?php echo form_open('receitas/ver') ?>
  <div class="row">
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
  <?php echo form_close(); ?>
</div>

<div class="container mt-3 text-center">

  <div class="row">

    <?php
    if ($receitas == null) {
      echo '<h4>Não foi encontrado nenhuma receita</h4>';
    }
    ?>
    
    <?php foreach ($receitas as $receita) : ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card my-2">
          <div class="div-img-responsive">
            <img src="<?= base_url('upload/receita/') . $receita['foto_receita'] ?>" class="img-resposive" alt="...">
          </div>
          <h5 class="card-title"><?= html_escape(word_limiter($receita['nome_receita'], 3, "")) ?></h5>
          <div class="card-body">
            <p class="card-text"><?= html_escape($receita['descricao_receita']) ?></p>
            <a href="<?= base_url('receitas/receitasView/') . $receita['id_receita'] ?>" class="btn btn-card-receitas">Ver Receita</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
    <div class="container">
      <p><?php echo $links; ?></p>
    </div>

  </div>
</div>