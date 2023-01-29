<head>
    <title>Criar Produto</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
    $path2root = "../../";
    include("../../includes/navbar.php");

    $nome = "";
    $family = "";
    $price = "";
    $quantity = "";

    $_SESSION['nome'] = NULL;
    $_SESSION['family'] = NULL;
    $_SESSION['price'] = NULL;
    $_SESSION['quantity'] = NULL;

    ?>
    <div class="form-criar_produto"> <!--//TODO #70 action para criar produto-->
        <h2>Criar Produto:</h2>

        <form method="post" action="<?php echo $path2root; ?>acoes/tecnico/action_criar_produto.php">
            <p><label for="nome"> Nome:</label> <input type="text" name=nome value="<?php echo $nome; ?>" /> </p>
            <p><label for="family"> Familia:</label> <input type="text" name="family" value="<?php echo $family; ?>" /> </p>
            <p><label for="price"> Preço:</label> <input type="text" name="price" value="<?php echo $price; ?>" /> </p>
            <p><label for="quantity"> Quantidade:</label> <input type="number" name="quantity" value="<?php echo $quantity; ?>" /> </p>
            <p class="form-criar_produto-file"><label for="file"> Imagem:<br></label> <input type="file" name="file" /></p>

            <div class="form-criar_produto-checkbox">
                <h3>Alérgenos:</h2>
                    <input type="checkbox" id="gluten" name="gluten" value="1">
                    <label for="gluten"> Glúten</label><br>

                    <input type="checkbox" id="lactose" name="lactose" value="1">
                    <label for="lactose"> Lactose</label><br>

                    <input type="checkbox" id="vegan" name="vegan" value="1">
                    <label for="vegan"> Vegan</label><br><br>
            </div>
            <?php
            //Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável
            if (!empty($_SESSION['msgErro'])) {
                echo "<p style=\"color:red\">" . $_SESSION['msgErro'] . "</p>";
                $_SESSION['msgErro'] = NULL;
            }
            ?>
            <p class="form-criar_produto-button"><input name="checkbox_confirmar" type="submit" value="Confirmar" /> </p>
            <p class="form-criar_produto-button"><input name="checkbox_cancelar" type="submit" value="Cancelar" /> </p>

    </div>

    </form>

</body>

</html>