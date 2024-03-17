<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');

//header & sidemenu
$page_title = 'Radera';
include('includes/header.php');


//användare måste vara inloggad för att på se sidan
if(!User::isAuthenticated()) {
    header('location: login.php?message=Du måste vara inloggad');
    die();
}

//om formulär har skickats, radera valda Posts
if(isset($_POST['checkboxn'])) {
    foreach($_POST['checkboxn'] as $id)
    {
        try {
            $post = Post::getUnique($id);
            $post->delete();
        } catch (Exception $e) {
            $message = '<div class="alert">' . $e->getMessage() . '</div>';
        }
    }
}

//hämta alla posts för inloggad användare
$user = User::getLoggedInUser();
$posts = $user->getPosts();


//felmeddelande
if(isset($message)) {
    echo $message;
}
?>

<div>
    <h1><?=$page_title;?></h1>

    </div>
    </section>

<main>

<?php
include('includes/sidemenu.php');
?>

<form action="./delete.php" method="post">

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Titel</th>
            <th>Skapad</th>
            <th>Innehåll</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $post) {
?>
        <tr class="table-select">
            <td>
                <input type="hidden" name="id[]" value="<?=$post->id?>">
                <input type="checkbox" name="checkboxn[]" class="checkbox" id="<?=$post->id?>" value="<?=$post->id?>">
            </td>
            <td>
                <?= $post->title; ?>
            </td>
            <td>
                <?= $post->created; ?>
            </td>
            <td>
                <?= custom_strimwidth($post->content, 0, 50, "..."); ?>
            </td>
        </tr>
<?php
}
?>
    </tbody>
</table>
    
    <div class="form-field">
        <input id="deletebtn" type="submit" value="Ta bort inlägg" class="button flat" />
    </div>
    
</form>
</div>

<?php
//footer
include('includes/footer.php');
?>