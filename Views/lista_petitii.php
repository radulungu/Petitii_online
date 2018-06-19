<?php
    
    session_start();
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lista petitii</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>

		#paragraf {
			text-indent: 30px;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 15px;
			margin: 3% 1%;
			border: 1px solid black;
			border-radius: 20px;
    		background-color: rgba(180,180,180,0.3);
    		padding: 10px;
    		box-shadow: 8px 8px 5px rgb(120,120,120);
		}

		form {
			font-family: 'Comic Sans MS', cursive, sans-serif;
			text-align: center;
			margin-bottom: 2%;
		}

		p.text {
			text-indent: 30px;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 15px;
			margin: 5px;
			margin-right: 1%;
		}

		#lista-petitii .petitie .description {
			float: left;
			width: 100%;
		}

		#lista-petitii .box {
			margin-left: 5%;
			float: left;
			width: 90%;
		}

		#lista-petitii .petitie {
			float: left;
			text-align: center;
			display: inline-block;
			border: 1px solid black;
			border-radius: 20px;
    		margin-left:auto;
    		margin-right:auto;
    		position: relative;
    		width:100%;
    		margin-bottom: 2%;
    		background-color: rgba(180,180,180,0.3);
    		box-shadow: 8px 8px 5px rgb(120,120,120);
		}

		#lista-petitii .description {
			float: left;
		}


		#lista-petitii .box .description .imagine {
    		width: 90%;
		}

		li img {
			float: left;
			width: 25%;
			height: 100%;
			margin: 0px 1% 0px 0px;
			padding: 0px 0px;
			text-align: center;
			border-radius: 20px 0px 0px 20px;
		}

		#lista-petitii button {
			margin-bottom: 1%;
			margin-top: 1%;
			text-align: center;
		}

	</style>
</head>
<body>

    <?php
        require "navBar.php";
        require "../Controllers/listPetitii.php";
    ?>

    <div id="paragraf">
        <p align="justify">Petitii online ofera utilizatorilor site-ului posibilitatea de a fi la curent cu toate noile petitii aparute. Mai jos puteti gasi o lista cu toate petitiile deschise!</p>
    </div>

    <form action="lista_petitii.php" method=GET>
        Denumire petitie:
        <input type="text" class="campuri" name="denumire_petitie" placeholder="Denumire petitie...">
        Domeniu petitie:
        <select class="campuri" name="domeniu">
            <option value="All">Afiseaza toate</option>
            <option value="cultural">Cultural</option>
            <option value="ecologic">Ecologic</option>
            <option value="economic">Economic</option>
            <option value="legislativ">Legislativ</option>
            <option value="social">Social</option>
        </select>
        Numar semnaturi:
        <select class="campuri" name="interval">
            <option value="All">Afiseaza toate</option>
            <option value="0-5.000">0-5.000</option>
            <option value="5.000-10.000">5.000-10.000</option>
            <option value="10.000-50.000">10.000-50.000</option>
            <option value="50.000-100.000">50.000-100.000</option>
            <option value="100.000-1.000.000">100.000-1.000.000</option>
        </select>
        <input type="submit" class="button" value="Sorteaza petitiile!">
    </form>
    
    <section id="lista-petitii">
        <div class="box">
        <?php foreach($results as $row): ?>
            <li class="petitie">
                <div class="description">
                <div class="imagine">
                    <img src=<?php echo $row["DOMENIU"] . ".jpg"; ?> width=100%>
                </div>
                <strong><?php echo $row["NAME"]; ?><br>Domeniu: <?php echo $row["DOMENIU"]; ?> | Data expirarii: <?php echo $row["EXPIRARE"];  ?>|
                 Numar semnaturi: <?php echo $row["NUMAR_SEMNATURI"]; ?></strong>
                <p class="text" align="justify"><?php echo $row["DESCRIERE"]; ?> </p>
                
                <?php
                
                    if (isset($_SESSION["Auth_id"]) && $_SESSION["Auth_id"] != 0) {
                        
                        echo '<a href=' . "../Controllers/signPetition.php?petitie_id=" . $row['ID'] . '>';
                        echo '<button class="button">Semneaza petitia!</button> ';
                        echo '</a>';
                        
                    } else {
                        
                        echo '<a href=' . 'login.php' . '>';
                        echo '<button class="button">Semneaza petitia!</button> ';
                        echo '</a>';
                        
                    }
                
                ?>
                
                
                
                
            </div>
            </li>
            
        <?php endforeach; ?>
        </div>
    </section>
    
</body>
</html>