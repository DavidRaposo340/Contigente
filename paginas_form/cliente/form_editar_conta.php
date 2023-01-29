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
    <title>Editar Conta</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
    $path2root = "../../";
    include("../../includes/navbar.php");

    $user_info=getUserbyID($_SESSION['user']);
    $_SESSION['password'] = NULL;
    $_SESSION['conf_pass'] = NULL;

    if (!empty($_SESSION['nome']))              $nome = $_SESSION['nome'];
    else $nome = $user_info['name'];
    if (!empty($_SESSION['address']))         $address = $_SESSION['address'];
    else $address = $user_info['address'];
    if (!empty($_SESSION['email']))         $email = $_SESSION['email'];
    else $email = $user_info['email'];
    if (!empty($_SESSION['password']))         $password = $_SESSION['password'];
    else $password = "";
    if (!empty($_SESSION['conf_pass']))     $conf_pass = $_SESSION['conf_pass'];
    else $conf_pass = "";

    if ($user_info['no_gluten']=="t")     $no_gluten =1;
    else $no_gluten = 0;
    if ($user_info['no_lact']=="t")     $no_lact =1;
    else $no_lact = 0;
    if ($user_info['vegan']=="t")     $vegan =1;
    else $vegan = 0;
    ?>

    <div class="form-editar">
        <h2>Editar Conta:</h2>

        <form method="post" action="<?php echo $path2root; ?>acoes/cliente/action_editar_conta.php">
            <p><label for="nome"> Nome:</label> <input type="text" name=nome value="<?php echo $nome; ?>" /> </p>
            <p><label for="address"> Endereço:</label> <input type="text" name="address" value="<?php echo $address; ?>" /> </p>
            <p><label for="email"> E-Mail:</label> <input type="text" name="email" value="<?php echo $email; ?>" /> </p>
            <p><label for="password"> Password:</label> <input type="password" name="password" value="<?php echo $password; ?>" /> </p>
            <p><label for="conf_pass"> Confirmar Password:</label> <input type="password" name="conf_pass" value="<?php echo $conf_pass; ?>" /> </p>

            <div class="form-editar-checkbox">
                <input type="checkbox" id="gluten" name="gluten" value="1" <?php echo ($no_gluten==1 ? 'checked' : '');?>>
                <label for="gluten"> Intoletante ao gluten</label><br>

                <input type="checkbox" id="lactose" name="lactose" value="1" <?php echo ($no_lact==1 ? 'checked' : '');?>>
                <label for="lactose"> Intoletante ao lactose</label><br>

                <input type="checkbox" id="vegan" name="vegan" value="1" <?php echo ($vegan==1 ? 'checked' : '');?>>
                <label for="vegan"> Vegan</label><br><br>
            </div>

            
            <div class="error_msg-form">
                <?php
                //Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável

                if (!empty($_SESSION['msgErro'])) {
                    echo "<p style=\"color:red\">" . $_SESSION['msgErro'] . "</p>";
                    $_SESSION['msgErro'] = NULL;
                }
                ?>
            </div>

            <p><input name="checkbox_confirmar" type="submit" value="Confirmar" /> </p>
            <input name="checkbox_cancelar" type="submit" value="Cancelar" />

    </div>

    </form>

</body>

</html>