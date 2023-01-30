<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
    $path2root = "../../";
    include("../../includes/navbar.php");
    include_once "../../includes/opendb.php";
    include_once "../../database/products.php";

    $id = $_GET ["id"];
    
    $product=getProductByID($id);

    $row = pg_fetch_assoc($product);
    $family=$row['familia'];
    $quantity=$row['quantity'];
    $price=$row['price'];
    $img_path=$row['img_path'];
    $nome=$row['nome'];
    
    $restrictions=getBoolRestrictionsofProductbyID($id);
    $no_gluten=$restrictions['no_gluten'];
    $no_lactose=$restrictions['no_lactose'];
    $vegan=$restrictions['vegan'];
    ?>

    <div class="form-criar_produto"> <!--//TODO #71 editar para criar produto-->
        <h2>Editar Produto:</h2>

        <form method="post" action="<?php echo $path2root; ?>acoes/cliente/action_editar_produto.php">
            <p><label for="nome"> Nome:</label> <input type="text" name=nome value="<?php echo $nome; ?>" /> </p>
            <p><label for="family"> Familia:</label> <input type="text" name="family" value="<?php echo $family; ?>" /> </p>
            <p><label for="price"> Preço:</label> <input type="text" name="price" value="<?php echo $price; ?>" /> </p>
            <p><label for="quantity"> Quantidade:</label> <input type="number" name="quantity" value="<?php echo $quantity; ?>" /> </p>
            <p class="form-criar_produto-file"><label for="file"> Imagem:<br></label> <input type="file" name="file" /></p>

            <div class="form-criar_produto-checkbox">
                <h3>Alérgenos:</h2>
                    <input type="checkbox" id="gluten" name="gluten" value="1" <?php echo ($no_gluten=='t' ? 'checked' : '');?>>
                    <label for="gluten"> Sem Glúten</label><br>

                    <input type="checkbox" id="lactose" name="lactose" value="1" <?php echo ($no_lactose=='t' ? 'checked' : '');?>>
                    <label for="lactose"> Sem Lactose</label><br>

                    <input type="checkbox" id="vegan" name="vegan" value="1" <?php echo ($vegan=='t' ? 'checked' : '');?>>
                    <label for="vegan"> Vegan</label><br><br>
            </div>

            <p class="form-criar_produto-button"><input name="checkbox_confirmar" type="submit" value="Confirmar" /> </p>
            <p class="form-criar_produto-button"><input name="checkbox_cancelar" type="submit" value="Cancelar" /> </p>

    </div>

    </form>

</body>

</html>