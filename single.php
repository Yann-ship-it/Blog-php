<?php require_once 'refactoring.php'; ?>
<?php include 'traitement.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="css/style.css">

  <title>Article </title>
</head>

<body>

<?php include('comp/header.php') ?>

  <!-- Page Wrapper -->
  <div class="page-container">

    <!-- Content -->
    <div class="container">

      <!-- Main Content Wrapper -->
      <div class="">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title']; ?></h1>
          <div class="post-image">
              <img src="<?php echo 'images/' . $post['image']; ?>" alt="" >
          </div>
          <div class="post-content">
            <?php echo html_entity_decode($post['content']); ?>
          </div>
        </div>
        <div class="comments">
            <h2>Commentaires</h2>
          <?php foreach ($comments as $comment): ?>
          
            <div class="comment"
              <h3 class="auteur">Ecrit par <span class="authname"><?php echo strip_tags($comment['author']); ?><span> </h3>
              <p class="contenu" ><?php echo strip_tags($comment['comment']); ?><br>
              <i class="far fa-calendar"> <?php echo date('d F, Y', strtotime($comment['post_datecom'])); ?></i>
              <a class="sup" href="single.php?id=<?php echo $id ?>&amp;id_comment_delete=<?php echo $comment['id']; ?>">Supprimer</a>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
        <br>
        <form class="form-post" action="single.php"  method="post">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="name">
            <label>Votre Prenom</label>
            <input type="text" name="author" class="text-input">
          </div>
          <div class="commentaire">
            <label>Votre commentaire </label>
            <textarea name="comment" id="body" cols="130" rows="15"></textarea>
          </div><br>
          <div>
              <button type="submit" name="add-comment" class="bouton">Commentez</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
      <!-- // Main Content -->

     

  <!-- footer -->
  <?php include('comp/footer.php') ?>
  <!-- // footer -->

</body>

</html>