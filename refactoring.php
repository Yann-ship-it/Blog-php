<?php
function getPDO(){

    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db_name = 'Blog';

    return new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
}

function create($author,$title,$content,$image){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO blog(author,title,content,image,created_at) VALUES(:author,:title,:content,:image,NOW())');
    $query->execute(compact('author','title','content','image'));
    $id = $query->insert_id;
    return $id;
}
function selectAll($page,$perPage){
    $perPage = $perPage;
    $page =  $page;
    $pdo =getPDO();
    $resultats = $pdo->query('SELECT * FROM blog ORDER BY created_at DESC LIMIT '.($perPage *($page-1)).','. $perPage );
    $posts = $resultats->fetchAll();
    return $posts;
} 
function pagination(){
    $pdo =getPDO();
    $query = $pdo->query("SELECT COUNT(*) as nbr_articles FROM blog");
        $nombres= $query->fetch();
    return $nombres['nbr_articles'];
}

function selectOne($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM blog WHERE id = :id');
    $query->execute(['id' => $id]);

    $post = $query->fetch();
    return $post;
}
function findAllComments($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comment WHERE id = :id');
    $query->execute(['id' => $id]);

    $comments = $query->fetchAll();
    return $comments;
}

function findComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comment WHERE id = :id');
    $query->execute(['id'=> $id]); 
    $comment =$query->fetch();
    return $comment;
}

function deletePost($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM blog WHERE id = :id');
    $query->execute(['id'=> $id]); 
}
function updatePost($id,$author,$title,$content,$image){
    $pdo =getPDO();
    $query = $pdo->prepare('UPDATE blog SET author = :author, title = :title,content = :content,image = :image WHERE id =:id');
    $query->execute(compact('author','title','content','image','id'));
    $id = $stmt->insert_id;
    return $id;
}


function deleteComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM comment WHERE id = :id');
    $query->execute(['id'=> $id]);
}

function saveComment($post_author,$id,$post_comment){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO comment(id,post_author,post_comment,post_datecom) VALUES(:id,:post_author,:post_comment,NOW())');
    $query->execute(compact('id','post_author','post_comment'));
    return $query;
}
?>