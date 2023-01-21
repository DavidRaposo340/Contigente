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
    ?>
    <br>
    <br>
    <br>

    <h2>Criar Conta:</h2>

    <form method="post" action="../actions/form_validar_login.php">
            <p><label for="nome">       Nome:</label>                <input type="text" name="nome"/> </p>
            <p><label for="idade">      Idade:</label>               <input type="text" name="idade"/> </p>
            <p><label for="email">      E-Mail:</label>              <input type="text" name="email"/> </p>
            <p><label for="password">   Password:</label>            <input type="password" name="password"/> </p>
            <p><label for="conf_pass">  Confirmar Password:</label>  <input type="password" name="conf_pass"/> </p>
            <!--CHECKBOXS-->
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
