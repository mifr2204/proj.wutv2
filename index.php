<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/Post.class.php');

//header
$page_title = 'Blogginlägg';
include('includes/header.php');



$posts = Post::allPostsWithLimit(5); //skapar en lista med Post instanser med alla posts GG
?>
    <h1><?=$page_title;?></h1>

</div>
    </section>

<main>
    
    <?php
    //visa sidemenu
    include('includes/sidemenu.php');
    /*
    ?>
    <div class="articlegrid">
    <?php
    //visa alla Posts
    foreach($posts as $post) {
    ?>
        <article>

        <h2><a href="posts.php?id=<?= $post->id; ?>"><?= $post->title; ?></a></h2>

        <p class="crebyp">Skapad <?= $post->created; ?> </p>
        <div class="by">
            <p>Av:: </p>
            <p class="username"> <?= $post->getUser()->username;?> </p>
        </div>
 
        <div class="content">
            <?= $post->content; ?>
        </div>
        </article>
    <?php
    }
*/
?>
<div class="index-article-list">

<?php
    //visa alla Posts
    foreach($posts as $post) {
    ?>
        <article>

        <h2><a href="posts.php?id=<?= $post->id; ?>"><?= $post->title; ?></a></h2>

        <p class="crebyp">Skapad <?= $post->created; ?> </p>
        <div class="by">
            <p>Av:: </p>
            <p class="username"> <?= $post->getUser()->username;?> </p>
        </div>
 
        <div class="content">
            <?= $post->content; ?>
        </div>
        </article>
    <?php
    }

?>


    </div>

<?php
//footer
include('includes/footer.php');
?>