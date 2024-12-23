<?php require_once '../signup/dbh.inc.php'; 

include '../signup/header_author.php';
require_once 'add_view.php';
require_once '../signup/config_seesion.inc.php';  
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
    exit();
}

if($_SERVER['REQUEST_METHOD']==='GET'){


    $art_id=$_GET['id'];
   
try{ $sql='SELECT * FROM article WHERE id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$art_id,PDO::PARAM_INT);


$stmt->execute();
$artcl_mdf=$stmt->fetch(PDO::FETCH_ASSOC);
echo 'article found';


}
catch(PDOException $e){

    echo 'connection failed '. $e->getMessage();
}


}?>
<form class="form-post" action="../authore/updatearticle.php" method="post">

<input class="ss" type="text" name="title" value="<?php echo htmlspecialchars($artcl_mdf['title'])?>
" placeholder="Title">
<input class="ss" type="text" name="url_img" value="<?php echo htmlspecialchars($artcl_mdf['url_img'])?> " >
<input class="ss" type="hidden" name="id" value="<?php echo htmlspecialchars($artcl_mdf['id'])?>">

<textarea class="ssd" name="content"><?php echo htmlspecialchars($artcl_mdf['content']); ?></textarea>
 <button class="vv" type="submit">Post</button>
</form>
<?php include '../authore/footer.php'?>

























