<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log in/Inregistrare</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>

		legend {
			color: rgb(120,120,120);
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 200%;
			text-align: center;
			text-shadow: 2px 2px rgb(200,200,200);
		}

		fieldset {
			border:2px solid black;
			padding: 40px;
			height: 370px;
		}

		form {
			text-align: center;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			color: black;
			font-size: 15px;
			width: 50%;
			padding: 0;
		}

		.button_admin {
			cursor: pointer;
			color: white;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			background-color: #ff0000;
			font-size: 13px;
			padding: 5px 10px;
			border: 1px solid #cc0000;
			border-radius: 4px;
			transition-duration: 0.4s;
			width: 172px;
		}

		.button_admin:hover {
			background-color: #cc0000;
		}

		#div1 {
			position: absolute;
			top: 25%;
			left: 5%;
		}

		#div2 {
			position: absolute;
			top: 25%;
			left: 30%;
		}

		div.imagine {
			position: absolute;
			top: 40%;
			left: 60%;
		}

		@media all and (max-width: 1024px) {
			#div1 {
			top: 25%;
			left: 5%;
			width: auto;
		}

		#div2 {
			
			top: 25%;
			left: 53%;
			width: auto;
		}

		div.imagine {
			
			display: none;

		}	
		}

		@media all and (max-width: 580px){
		#div1 {
			
			top: 25%;
			left: 5%;
			width: auto;
		}

		#div2 {
			
			top: 100%;
			left: 5%;
			width: auto;
		}

		div.imagine {
			
			display: none;
		}	
		}

		@media all and (max-height: 450px){
		#div1 {
			top: 38%;
			left: 5%;
			bottom: 5%;
			width: auto;
		}

		#div2 {
			top: 195%;
			left: 5%;
			width: auto;
		}

		div.imagine {
			display: none;
		}
		}

		@media all and (max-height: 280px){
		#div1 {
			top: 100%;
			left: 5%;
		}

		#div2 {
			top: 100%;
			left: 25%;
			
		}

		div.imagine {
			display: none;
		}	
}

	</style>
</head>
<body>

<?php
    require "navBar.php";
?>

<div align=center style="<?php if (isset($_SESSION["ERROR_MSG"])) { echo "color:red"; } else { echo "color:green"; } ?>">

    <br><br>

    <?php
    
        if (isset($_SESSION["ERROR_MSG"])) {
            
            echo $_SESSION["ERROR_MSG"];
            
        }
        
        if (isset($_SESSION["SUCCESS_MSG"])) {
            
            echo $_SESSION["SUCCESS_MSG"];
            
        }
        
        $_SESSION["ERROR_MSG"] = null;
        $_SESSION["SUCCESS_MSG"] = null;
    
    ?>

</div>

<div id="div1">
	<form action="../Controllers/auth.php" method="post">
  	<fieldset id="fieldset1">
    	<legend>Log in</legend>
    	Nume utilizator:<br>
    	<input type="text" class="campuri" name="username" maxlength="20" placeholder="Nume utilizator..." required>
    	<br>
    	Parola:<br>
    	<input type="password" class="campuri" name="password" placeholder="Parola..." required>
    	<br><br>
    	<input type="submit" class="button" value="Log in">
  	</fieldset>
	</form>
</div>

<div id="div2">
	<form action="../Controllers/register.php" method="post">
  	<fieldset id="fieldset2">
        Nume utilizator:<br>
        <input type="text" class="campuri" name="username" maxlength="20" placeholder="Nume utilizator..." required>
        <br>
    	<legend>Inregistrare</legend>
    	E-mail:<br>
    	<input type="email" class="campuri" name="email" placeholder="E-mail..." required>
    	<br>
    	Parola:<br>
    	<input type="password" class="campuri" name="password" placeholder="Parola..." required>
    	<br>
    	Confirmare parola:<br>
    	<input type="password" class="campuri" name="confirmed_password" placeholder="Confirmare parola..." required>
    	<br><br>
    	<input type="submit" class="button" value="Inregistrare">
  	</fieldset>
	</form>
</div>

<div class="imagine">
	<img src="fundal.jpg" alt="imagine">
</div>

</body>
</html>