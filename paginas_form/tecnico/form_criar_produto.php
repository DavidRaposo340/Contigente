<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Criar Produto</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
    $path2root = "../../";
    include("../../includes/navbar.php");
    include_once "../../database/products.php";


    if (!empty($_SESSION['familia']))              $familia = $_SESSION['familia'];
    else $familia = "todas";

    $nome = "";
    $price = "";
    $quantity = "";

    $_SESSION['nome'] = NULL;
    $_SESSION['price'] = NULL;
    $_SESSION['quantity'] = NULL;

    ?>
    <div class="form-criar_produto"> <!--//TODO #70 action para criar produto-->
        <h2>Criar Produto:</h2>

        <form method="post" action="<?php echo $path2root; ?>acoes/tecnico/action_criar_produto.php" enctype="multipart/form-data">
            <p><label for="nome"> Nome:</label> <input type="text" name=nome value="<?php echo $nome; ?>" /> </p>
            <div class="form-criar_produto-familia">
            <p><label for="family"> Familia:</label>
            <div class="form-criar_produto-radio">
                <?php
                    $list_familias = getFamilyProducts();
                    $row = pg_fetch_assoc($list_familias);

                    while (isset($row['id'])) {
                        if ($familia == $row['name'])
                            echo '<input type="radio" id="familia"  name="familia" value="' . $row['name'] . '" checked>';
                        else
                            echo '<input type="radio" id="familia"  name="familia" value="' . $row['name'] . '" >';
                        echo '<label for="' . $row['name'] . '"> ' . $row['name'] . '</label><br>';
                        $row = pg_fetch_assoc($list_familias);
                    }
                ?>
            </div>
            </p>
            </div>
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