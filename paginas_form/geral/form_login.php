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
        //session_start();
        $path2root = "../../";
        include("../../includes/navbar.php"); 

        //Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
        if (!empty($_SESSION['email'])) 	    $email = $_SESSION['email']; 		    else $email = "";
        if (!empty($_SESSION['password'])) 	    $password = $_SESSION['password']; 	    else $password = "";

        $_SESSION['email'] = NULL;
        $_SESSION['password'] = NULL;

    ?>
  </div>

    <h2>Iniciar Sessão:</h2>

    <form method="post" action="<?php echo $path2root; ?>acoes/geral/action_validar_login.php">
            <p><label for="email">E-mail:</label><input type="text" name="email" value= "<?php echo $email; ?>" /> </p> 
            <p><label for="password">Password:</label><input type="password" name="password" value= "<?php echo $password; ?>" /> </p>
            <p><input type="submit" value="Login" /> </p>


    </form>

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

            Não tem conta?
            <br>
            <br>
            
            Criar conta <a href="form_criar_conta.php"> aqui</a>
            <br>
            <br>
    </p>
    <?php
        //Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável
        if (!empty($_SESSION['msgErro'])) {
            echo "<p style=\"color:red\">".$_SESSION['msgErro']."<p>";
            $_SESSION['msgErro'] = NULL;
        }
    ?>


</body>
</html>
