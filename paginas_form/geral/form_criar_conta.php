<!DOCTYPE HTML>
<head>
    <title>Criar Conta</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
        //session_start();
        $path2root = "../../";
        include("../../includes/navbar.php"); 

        //Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
        if (!empty($_SESSION['nome'])) 		 	$nome = $_SESSION['nome']; 				else $nome = "";
        if (!empty($_SESSION['address'])) 		$address = $_SESSION['address']; 			else $address = "";
        if (!empty($_SESSION['email'])) 	    $email = $_SESSION['email']; 		    else $email = "";
        if (!empty($_SESSION['password'])) 	    $password = $_SESSION['password']; 	    else $password = "";
        if (!empty($_SESSION['conf_pass'])) 	$conf_pass = $_SESSION['conf_pass']; 	else $conf_pass = "";

        $_SESSION['nome'] = NULL;
        $_SESSION['address'] = NULL;
        $_SESSION['email'] = NULL;
        $_SESSION['password'] = NULL;
        $_SESSION['conf_pass'] = NULL;

    ?>

    <div class="form-register">
        <h2>Criar Conta:</h2>

        <form method="post" action="<?php echo $path2root; ?>acoes/geral/action_criar_conta.php">
            <p><label for="nome">       Nome:</label>                <input type="text" name=nome value= "<?php echo $nome; ?>" /> </p>
            <p><label for="address">    Endereço:</label>            <input type="text" name="address" value= "<?php echo $address; ?>" /> </p>
            <p><label for="email">      E-Mail:</label>              <input type="text" name="email" value= "<?php echo $email; ?>" /> </p>
            <p><label for="password">   Password:</label>            <input type="password" name="password" value= "<?php echo $password; ?>" /> </p>
            <p><label for="conf_pass">  Confirmar Password:</label>  <input type="password" name="conf_pass" value= "<?php echo $conf_pass; ?>" /> </p>
                      
            <!--CHECKBOXS-->
            <div class="form-register-checkbox">
                <input type="checkbox" id="gluten" name="gluten" value="1">
                <label for="gluten"> Intolerante ao glúten</label><br>
                
                <input type="checkbox" id="lactose" name="lactose" value="1">
                <label for="lactose"> Intolerante ao lactose</label><br>
                
                <input type="checkbox" id="vegan" name="vegan" value="1">
                <label for="vegan"> Vegan</label><br><br>
            </div>

            <div class="error_msg-form">
                <?php
                //Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável
                
                    if (!empty($_SESSION['msgErro'])) {
                        echo "<p style=\"color:red\">".$_SESSION['msgErro']."</p>";
                        $_SESSION['msgErro'] = NULL;
                    }
                ?>
            </div>  
            
            <p><input type="submit" value="Criar Conta" /> </p>
    </div>
    
  

    </form>

</body>
</html>
