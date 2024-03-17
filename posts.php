<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/Post.class.php');

//id för post måste vara angivet som parameter för sidan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ./index.php");
}

//hämta vald Post som variabel
$post = Post::getUnique($id);


//header & sidemenu
$page_title = $post->title;
include('includes/header.php');

?>

    <h1><?=$page_title;?></h1>

</div>
    </section>

<main >
<?php
include('includes/sidemenu.php');
?>

<?= $post->content; ?>

<div id="id">

</div>


<?php
//footer
include('includes/footer.php');
?>