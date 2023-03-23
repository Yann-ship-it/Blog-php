<?php
  require_once 'refactoring.php';

  $page =1;
  $perPage =3;
  $total = pagination();
  $pages = ceil($total / $perPage);
  if (isset($_GET['page'])) {
    $page = $_GET['page'];

  }
    $posts = selectAll($page,$perPage);
  ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/ea2a4f6de0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  <title>TP - Blog (PHP)</title>
</head>
<body>
 <?php include('comp/header.php') ?>

    <!-- Post Slider -->
    <div class="posts">
      <h2 class="page-title">Articles</h2>
      <div class="post-container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
              <img src="<?php echo 'images/' . $post['image']; ?>" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                <i > <?php echo $post['author']; ?></i>
                &nbsp;
                <i > <?php echo date('d F, Y', strtotime($post['created_at'])); ?></i>
              </div>
            </div>
          <?php endforeach; ?>
      </div>

    <div class="pagination">
      <?php
        for ($i=1; $i <= $pages ; $i++) { ?>
          <a class="page <?= ($page == $i)?'active':'' ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a>
      <?php }
      ?>
    </div>

    <?php include('comp/footer.php') ?>