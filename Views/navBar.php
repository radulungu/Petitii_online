<?php
    #session_start();
    /*var_dump($_SESSION["Auth_id"]);
    var_dump($_SESSION["Auth_name"]);
    exit();*/
?>
<h1>Petitii online</h1>

<ul>
	<li><a href="acasa.php"><i class="fa fa-home" aria-hidden="true"></i> Acasa</a></li>
	<li><a href="creeaza_petitie.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Creeaza petitie</a></li>
	<li><a href="lista_petitii.php"><i class="fa fa-list" aria-hidden="true"></i> Lista petitii</a></li>
    <?php if(!isset($_SESSION["Auth_id"]) || $_SESSION["Auth_id"] == 0) { echo "<li><a href=\"login.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Log in | Inregistrare</a></li>"; }
    else { echo "<li><a href=\"logged.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i>" . $_SESSION["Auth_name"] . "</a></li>"; }?>
</ul>