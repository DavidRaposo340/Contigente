
<head>
<title>Editar Produto</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 

        //Falta a componente de PHP e database (Isert e update) Criar action
    ?>

    <div class="form-criar_produto">
    <h2>Criar Produto:</h2>

    <form method="post" action="<?php echo $path2root; ?>acoes/cliente/action_editar_produto.php">
        <p><label for="nome">       Nome:</label>                <input type="text" name=nome value= "<?php echo $nome; ?>" /> </p>
        <p><label for="address">    Familia:</label>            <input type="text" name="address" value= "<?php echo $address; ?>" /> </p>
        <p><label for="email">      Preço:</label>              <input type="text" name="email" value= "<?php echo $email; ?>" /> </p>

        <div class="form-criar_produto-checkbox">
        <h3>Alérgenos:</h2>
            <input type="checkbox" id="gluten" name="gluten" value="1">
            <label for="gluten"> Gluten</label><br>
            
            <input type="checkbox" id="lactose" name="lactose" value="1">
            <label for="lactose"> Lactose</label><br>
            
            <input type="checkbox" id="vegan" name="vegan" value="1">
            <label for="vegan"> Vegan</label><br><br>
        </div>

        <p class="form-criar_produto-button"><input name="checkbox_confirmar" type="submit" value="Confirmar" /> </p>
        <p class="form-criar_produto-button"><input name="checkbox_cancelar" type="submit" value="Cancelar" /> </p>

    </div>

    </form>

</body>
</html>