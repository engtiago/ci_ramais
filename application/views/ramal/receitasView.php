<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container" style="">
  <div align="center">
    <h1 style="color:#b21f28; margin-top:15%">
      <button class="btn btn-card-receitas" onclick="window.history.go(-1)"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar </button> <?php echo ($receita['nome_receita']) ?> </h1>
  </div>
  <br><br>
  <div class="row">
    <div class="col-md-6">
      <div align="center">
        <div class="fb-share-button btn btn-card-receitas" data-href="<?= current_url() ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" style="color:white!important" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>&amp;src=sdkpreparse"><i class="fa fa-share-alt" aria-hidden="true"></i></a></div>
        <a title="Imprimir" class="btn btn-card-receitas" href="javascript:window.print()"><span><i class="fa fa-print" aria-hidden="true"></i></span></a>
        <a class="btn btn-card-receitas" href="https://api.whatsapp.com/send?text=Veja esta receita Mariza Acesse o site:<?= current_url() ?>"><i class="fab fa-whatsapp"></i></span></a>
        <br>
        <div class="my-3">
          <i class="fas fa-utensils" aria-hidden="true"></i> Rendimento: <?php echo ($receita['rendimento_receita']) ?>
          <i class="far fa-clock" aria-hidden="true"></i> Tempo de preparo: <?php echo ($receita['tempo_receita']) ?>
        </div>
        <div class="shot-item foto-view">
          <img class="foto-view" src="<?= base_url('upload/receita/') . $receita['foto_receita'] ?>">
        </div>
        <hr>
        <h5><?php echo ($receita['descricao_receita']) ?></h5>
      </div>
    </div>
    <div class="col-md-6 mt-5">
      <!-- Button trigger modal -->
      <h4 align="justify" style="color:#b21f28!important">Categoria:</h4>
      <?php echo ($receita['nome_categoria_receita']) ?>
      <hr>
      <h4 align="justify" style="color:#b21f28!important">Ingredientes:</h4>
      <?php echo ($receita['ingredientes_receita']) ?>
      <hr>
      <h4 align="justify" style="color:#b21f28!important">Modo de preparo:</h4>
      <?php echo ($receita['modo_preparo_receita']) ?>
      <hr>
    </div>

  </div>
</div>