<?php
    session_start();
?>

<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

<header>   
    <nav>
        <img src="img/other-img/logo_bianco.png" alt="logo">
        <ul>
            <li><a href="homepage.php">Homepage</a></li>
            <li><a href="confronta.php">Confronta</a></li>
            <!-- Verifica se l'utente è loggato -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <!-- Se l'utente è loggato, mostra il link all'area personale e il menu a tendina -->
                <li class="dropdown">
        <!-- Verificare spazio -->
                  <br>
                    <a href="javascript:void(0)" class="dropbtn">Area personale</a>
                    <div class="dropdown-content">
                        <a href="reserved.php">Profilo</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
                <li>  
                  <?php
                    $username = htmlspecialchars($_SESSION['username']);
                    $fileBase = "uploads/" . $username;

                    if (file_exists($fileBase . ".jpg")) {
                        echo '<img src="' . $fileBase . '.jpg" alt="" class="personal-area-icon">';
                    } elseif (file_exists($fileBase . ".png")) {
                        echo '<img src="' . $fileBase . '.png" alt="" class="personal-area-icon">';
                    } elseif (file_exists($fileBase . ".gif")) {
                        echo '<img src="' . $fileBase . '.gif" alt="" class="personal-area-icon">';
                    } else {
                        echo '<img src="uploads/user.png" alt="" class="personal-area-icon">';
                    }
                  ?>
                </li>
            <?php else: ?>
                <!-- Se l'utente non è loggato, mostra il link per creare un account -->
                <li><a href="registrazione.php">Registrati</a></li>
            <?php endif; ?>
            <li><input type="text" size="30" onkeyup="showResult(this.value)" class="textf-head"> <div id="livesearch"></div> </li>
        </ul>
    </nav>
</header>
