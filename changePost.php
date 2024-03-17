<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/User.class.php');
include_once('includes/classes/Post.class.php');

//header & sidemenu
$page_title = 'Redigera inlägg';
include('includes/header.php');

    
//användare måste vara inloggad för att på se sidan
if(!User::isAuthenticated()) {
    header('location: login.php?message=Du måste vara inloggad');
    die();
}

//id för post måste vara angivet som parameter för sidan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ./index.php");
}

//om formuläret har skickats, försök uppdatera post
if(isset($_POST['title'])) {
        
    $post = Post::getUnique($id);
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $post->setTitle($title);
        $post->setContent($content);
        $post->update();
        $message = "<div class='status'>✔️ Inlägget är uppdaterat</div>";
    } catch (Exception $e) {
        $message = '<div class="alert">' . $e->getMessage() . '</div>';
    }


}

//visa dynamiskt meddelande
if(isset($message)) {
    echo $message;
}


//hämta Post som variabel
$post = Post::getUnique($id);
?>


    <h1><?=$page_title;?></h1>

    </div>
    </section>

<main>

<?php
include('includes/sidemenu.php');
?>
<div id="createForm">
    <form action="./changePost.php?id=<?php echo $_GET['id']; ?>" method="post">
        <div class="form-field">
            <label for="postid">ID</label>
            <input type="text" name="postid" id="postid" value="<?= $post->id; ?>" class="maxsize" disabled />
        </div>
        <div class="form-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" value="<?= $post->title; ?>" class="maxsize" />
        </div>
        <div class="form-field">
            <label for="content">Innehåll</label>
            <textarea name="content" id="content" rows="15" class="maxsize"><?= $post->content; ?></textarea>
        </div>

        <div class="form-field">
            <input id="createbtn" type="submit" value="Uppdatera Inlägg" class="button flat" />
        </div>
    </form>
</div>



<script>
    CKEDITOR.replace( 'content' );
</script>
<script type="text/javascript" src="assets/js/js.js"></script>
<?php
//footer
include('includes/footer.php');
?>