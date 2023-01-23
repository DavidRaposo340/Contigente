<!DOCTYPE HTML>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 

        //Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
        if (!empty($_SESSION['nome'])) 		 	$nome = $_SESSION['nome']; 				else $nome = "";
        if (!empty($_SESSION['idade'])) 		$idade = $_SESSION['idade']; 			else $idade = "";
        if (!empty($_SESSION['email'])) 	    $email = $_SESSION['email']; 		    else $email = "";
        if (!empty($_SESSION['password'])) 	    $password = $_SESSION['password']; 	    else $password = "";
        if (!empty($_SESSION['conf_pass'])) 	$temperatura = $_SESSION['conf_pass']; 	else $conf_pass = "";

        $_SESSION['nome'] = NULL;
        $_SESSION['idade'] = NULL;
        $_SESSION['email'] = NULL;
        $_SESSION['password'] = NULL;
        $_SESSION['conf_pass'] = NULL;
        ?>
    <br>
    <br>
    <br>

    <h2>Criar Conta:</h2>

    <form method="post" action="<?php echo $path2root; ?>acoes/geral/action_criar_conta.php">
            <p><label for="nome">       Nome:</label>                <input type="text" name=nome value= "<?php echo $nome; ?>" /> </p>
            <p><label for="idade">      Idade:</label>               <input type="text" name="idade" value= "<?php echo $idade; ?>" /> </p>
            <p><label for="email">      E-Mail:</label>              <input type="text" name="email" value= "<?php echo $email; ?>" /> </p>
            <p><label for="password">   Password:</label>            <input type="password" name="password" value= "<?php echo $password; ?>" /> </p>
            <p><label for="conf_pass">  Confirmar Password:</label>  <input type="password" name="conf_pass" value= "<?php echo $conf_pass; ?>" /> </p>
                        
            <!--CHECKBOXS-->
            <input type="checkbox" id="gluten" name="gluten" value="1">
            <label for="gluten"> Intoletante ao gluten</label><br>
            
            <input type="checkbox" id="lactose" name="lactose" value="1">
            <label for="lactose"> Intoletante ao lactose</label><br>
            
            <input type="checkbox" id="vegan" name="vegan" value="1">
            <label for="vegan"> Vegan</label><br><br>

            <p><input type="submit" value="Criar Conta" /> </p>
    </form>

    <?php
    /*
        //validar qual foi o erro que aconteceu
        if (isset($_GET["erro"])) {
            $msg_erro = "";
            switch ($_GET["erro"]) {
                case 1:
                    $msg_erro = "Erro. username ou password inexistente.";
                    break;
                //Neste switch poderão ser acrescentadas mais mensagens de erro
            }

            if ($msg_erro != "")
                echo "<h3>$msg_erro</h3>";
        }

            echo "Username: username; Password: password";
    */
    ?>

</body>
</html>
