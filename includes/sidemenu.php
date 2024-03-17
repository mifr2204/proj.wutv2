<?php 
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

    include_once('system/config.php');
    include_once('includes/classes/User.class.php');
?>

<section class="mid">
        
        <nav class="sidebar" id="sidebar">
            
            <ul>
                <li>
                    <a class="mainmen" href="./index.php">Startsidan</a>
                </li>
                
<?php
        //om användaren är inloggad, visa logga ut knappen
        if(User::isAuthenticated()) {
?>
        <li>
            <a class="mainmen" id="logoutbtn" href="./logout.php">Logga ut</a>
        </li>
<?php
        } else {
        // ... annars visa logga in knappen
?>
        <li>
            <a class="mainmen" id="loginbtn" href="./login.php" >Logga in</a>      
        </li>
         
<?php
        }
    
        //om användaren är inloggad, visa blogg menyn
        if(User::isAuthenticated()) {
?>
        <li>
            <a href="#" id="blogglink" >BLOGG MENY &dArr;</a>
        </li>
        <li>
            <a class="submenu" id="alllink" href="./userpost.php" >ALLA MINA INLÄGG</a>
        </li>
        <li>
            <a class="submenu" id="createlink" href="./create.php" >SKAPA INLÄGG</a>
        </li>
        <li>
            <a class="submenu" id="deletelink" href="./delete.php" >RADERA INLÄGG</a>
        </li>
<?php
        }
?>
        </ul>
<?php
        $users = User::allUsers(); //skapar en array av User instanser med alla users GG
    ?>
    <div class="users">
        <ul>
        <li>
            <a href="#" id="userlistbtn" >Andvändare &dArr;</a>
        </li>
    <?php
        foreach($users as $user) {
            //räkna hur många posts varje användare har
            $numerOfPosts = Post::countPostsByUserId($user->id);
    ?>
            <li><a class="submenu" href="./userpost.php?userid=<?= $user->id; ?>"><?= $user->username; ?> (<?= $numerOfPosts; ?>)</a></li>   
    <?php
        }
    ?>
        </ul>
    </div>
            </nav>
     

