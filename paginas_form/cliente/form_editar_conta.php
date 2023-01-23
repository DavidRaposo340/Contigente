<?php
	//verificaçao de conta iniciada
	/*
    session_start();
	if(!isset($_SESSION['username'])){
		header("Location: login.php");
	}
	include_once "../includes/opendb.php";
	include_once "../database/city.php";
    */
?>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
    ?>
    <br>
    <br>
    <br>

    <h2>Editar Conta:</h2>

    <form method="post" action="../actions/form_validar_login.php">
            <p><label for="nome">       Nome:</label>                <input type="text" name="nome"/> </p>
            <p><label for="idade">      Idade:</label>               <input type="text" name="idade"/> </p>
            <p><label for="email">      E-Mail:</label>              <input type="text" name="email"/> </p>
            <p><label for="password">   Password:</label>            <input type="password" name="password"/> </p>
            <p><label for="conf_pass">  Confirmar Password:</label>  <input type="password" name="conf_pass"/> </p>
                        
            <!--CHECKBOXS-->
            <input type="checkbox" id="gluten" name="gluten" value="1">
            <label for="gluten"> Intoletante ao gluten</label><br>
            
            <input type="checkbox" id="lactose" name="lactose" value="1">
            <label for="lactose"> Intoletante ao lactose</label><br>
            
            <input type="checkbox" id="vegan" name="vegan" value="1">
            <label for="vegan"> Vegan</label><br><br>

            <p><input type="submit" value="Criar Conta" /> </p>
    </form>

</body>
</html>
