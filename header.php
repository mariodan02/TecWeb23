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
                    <a href="javascript:void(0)" class="dropbtn">Area personale</a>
                    <div class="dropdown-content">
                        <a href="reserved.php">Profilo</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <!-- Se l'utente non è loggato, mostra il link per creare un account -->
                <li><a href="registrazione.php">Registrati</a></li>
                <li><input type="text" size="30" onkeyup="showResult(this.value)"> <div id="livesearch"></div> </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
