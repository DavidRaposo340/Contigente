<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
  <title>Login</title>
  <link rel="stylesheet" href="../../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
  <div class="navbar-separation">
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
    ?>
  </div>

  <div class="container-login">
    <div class="form-login">
      <h2>Iniciar Sessão:</h2>

      <form method="post" action="../../acoes/action_validar_login.php">
        <p>
          <label for="username">Username:</label>
          <input type="text" name="username"/> 
        </p>
        <p>
          <label for="password">Password:</label>
          <input type="password" name="password"/>
        </p>
        <p>
          <input type="submit" value="Login" />
        </p>
      </form>
    </div>
    <p> 
    <br>
      Não tem conta?
      <br>
      <br>
      <br>

      Criar conta <a href="form_criar_conta.php"> aqui</a>
    </p>
  </div>
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
