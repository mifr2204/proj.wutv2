<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/User.class.php');

//header & sidemenu
$page_title = 'Skapa konto';
include('includes/header.php');



$showform = true;
$displaybutton = false;

//om formulär är skickat, försök skapa ny användare
if(isset($_POST['email'])) {
    $newUserArgs = array('forname' => $_POST['forname'], 'lastname' => $_POST['lastname'], 'email' => $_POST['email'], 'username' => $_POST['username'], 'password' => $_POST['password']);

    if ($_POST['password'] != $_POST['password2']) {
        $message = '<div class="alert">Lösenord och bekräftat lösenord stämmer inte överens.</div>';
    } else {
        try {
            $user = User::newUser($newUserArgs);
            $showform = false;
            $message = "<div class='status'>✔️ Andvändaren är skapad</div>";
            $displaybutton = true;
        } catch (Exception $e) {
            $message = '<div class="alert">' . $e->getMessage() . '</div>';
        }
    }

}
?>
    <h1><?=$page_title;?></h1>
    </div>
    </section>

<main>

<?php
include('includes/sidemenu.php');
?>

<?php
//om formuläret ska visas (om en användare inte precis har skapats)
if ($showform) {
    ?>
<form id="newUf"action="./newuser.php" method="post">


<div class="form-field">
    <label for="forname">Förnamn</label>
    <input type="text" name="forname" id="forname" class="maxsize" />
</div>
<div class="form-field">
    <label for="lastname">Efternamn</label>
    <input type="text" name="lastname" id="lastname" class="maxsize" />
</div>
<div class="form-field">
    <label for="email">E-mail</label>
    <input type="text" name="email" id="email" class="maxsize" />
</div>
<div class="form-field">
    <label for="username">Användarnamn</label>
    <input type="text" name="username" id="username" class="maxsize" />
</div>
<div class="form-field">
    <label for="password">Lösenord</label>
    <input type="password" name="password" id="password" class="maxsize" />
</div>
<div class="form-field">
    <label for="password2">Bekräfta lösenord</label>
    <input type="password" name="password2" id="password2" class="maxsize" />
</div>
<div class="form-field">
    <input type="submit" value="Skapa Konto" class="button flat" />
</div>

</form>
<?php
}

//visa dynamiskt meddelande
if(isset($message)) {
    echo $message;
}

//footer
include('includes/footer.php');
?>