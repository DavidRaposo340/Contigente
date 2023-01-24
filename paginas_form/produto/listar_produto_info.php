<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
    <!-- PARA DOUBLE RANGE SLIDER - elementos que nao aplico css ficam com estilo importado...
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    -->
    <!-- PARA ICON SEARCHBAR-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/products.php";    

        //$produto=getProductByID($id);
        //$row = pg_fetch_assoc($produto);
        $row['id']=1;
        $row['descr']="dwqdwqdw212dd";
        $row['img_path']="produtos\img_prod_azeite.jpg";
        $row['nome']="NOMEMEMEMEM";
        $row['price']=9999991;
        $row['familia']="1tyty";
        $row['restr']=16;
        
    ?>
    
        <div class="row">

            <div class="collumn_prod_img_info">
                <img src="<?php echo $path2root ?>images\<?php echo $row['img_path'] ?>" alt="AZEITE">
                <p>
                    Descriçao:
                    <br>
                    <?php echo $row['descr'] ?>

                </p>
            </div>

            <div class="collumn_prod_details">
                    <h2> <?php echo $row['nome'] ?> </h2>
                    <h3> <?php echo $row['price'] ?> </h2>  
                    <button onclick="location.href='<?php echo $path2root ?>acoes/produto/action_add_carrinho.php?id=<?php echo $row['id'] ?>;'"\"> Adicionar ao carrinho</button>      
                    <h3> Família de Produto: </h2> 
                    <p> <?php echo $row['familia'] ?> </p>
                    <h3> Restrições alimentares: </h2> 
                    <p> <?php echo $row['restr'] ?> </p>
                    <p> <?php echo $row['restr'] ?> </p>
                    <p> <?php echo $row['restr'] ?> </p>   
            </div>

        </div>


</body>

</html>
