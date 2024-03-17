<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');

//användare att hämta Posts från, id från $_GET eller inloggad användare om id från $_GET inte existerar
if (isset($_GET['userid'])) {
    $selectedUser = User::getUnique(intval($_GET['userid']));
} else {
    $selectedUser = User::getLoggedInUser();
}

//header & sidemenu
$page_title = 'Blogginlägg';
include('includes/header.php');
?>


</div>
    </section>
    

<main>
<?php
include('includes/sidemenu.php');


//inloggad användare
if (User::isAuthenticated())
{
    $loggedInUser = User::getLoggedInUser();
} else {
    $loggedInUser = false;
}

//aktuell sida för pagination, 1 som standard
$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}

//antal rader per sida, 50 som standard
$pagesize = 50;
if (isset($_GET['pagesize'])) {
    $pagesize = intval($_GET['pagesize']);
}



//hämta alla Posts från vald användare
$posts = $selectedUser->getPosts($page, $pagesize);
?>
<div>
    <h1><?=$page_title;?></h1>

<table class="table">
    <thead>
        <tr>
        <th>
            Titel
        </th>
        <th>
            Skapad
        </th>
        <th>
            Innehåll
        </th>
        <th></th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $post) {
    ?>

<tr>
    <td>
        <?= custom_strimwidth($post->title, 0, 50, "..."); ?>
    </td>
    <td>
        <?= $post->created; ?>
    </td>
    <td>
        <?= custom_strimwidth($post->content, 0, 50, "..."); ?>
    </td>
    <td>
        <a class="readbtn" href="./posts.php?id=<?= $post->id; ?>">Läs mer</a>
        <?php
        if ($loggedInUser)
        {
        if ($loggedInUser->id === $selectedUser->id)
        {
        ?>
        |
        <a class="changebtn" href="./changePost.php?id=<?= $post->id; ?>">Ändra</a>
        <?php
        }
        }
        ?>
    </td>
</tr>
    
    <?php
}

?>
    </tbody>
</table>




<ul class="pagination">
<?php
//pagination - visa navigation för pages
$numberOfPages = Post::postPagesByUserId($selectedUser->id, $pagesize);
$url = '?a=1';
if (isset($_GET['userid'])) {
        $url = $url . '&userid=' . $_GET['userid'];
}

echo '<li><a href="' . $url . '&page=1">|</a></li>';
for ($i = 1; $i <= $numberOfPages; $i++) {
    echo '<li>';
    $class = '';
    if ($i == $page) {
        $class = 'current';
    }
    echo '<a href="' . $url . '&page=' . $i . '" class="' . $class . '">' . $i . '</a>';
    echo '</li>';
}
echo '<li><a href="' . $url . '&page=' . $numberOfPages . '">>|</a></li>';
?>
</ul>

</div>


<?php
//footer
include('includes/footer.php');
?>