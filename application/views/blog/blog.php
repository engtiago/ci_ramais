<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<link href="<?= base_url('assets/css/blog.css') ?>" rel="stylesheet">

<div class="page-header site-bg" style="background: url('<?= base_url('assets/img/blog_bg.png') ?>') no-repeat center center">
</div>


<div class="container-blog mt-3">

  <div class="posts">

   

    <?php
          if ($post_blog == null) {
            echo '<h4>Não foi encontrado nenhuma Instrução</h4>';
          }
          ?>
    <?php foreach ($post_blog as $post_blog) : ?>
      <div class="post">
        <h2 class="post-title">
          <a href="<?= base_url("blog/ver/{$post_blog['titulo_post_blog']}") ?>">
            <?= $post_blog['titulo_post_blog'] ?>
          </a>
        </h2>
        <span class="post-date"> <?= $post_blog['nome_pessoa'] ?> - <?php echo (date('d/m/Y', strtotime($post_blog['data_post_blog']))); ?></span>
            <div class="centralizarImagem">
            <img class="img-blog" src="<?= base_url() . 'upload/blog/' . $post_blog['img_post_blog'] ?>" alt="">
            </div>
        <p><?= $post_blog['texto_post_blog'] ?></p>
      </div>
    <?php endforeach ?>
    <div class="container">
      <p><?php echo $links; ?></p>
    </div>


  </div>


</div>