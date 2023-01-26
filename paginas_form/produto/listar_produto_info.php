<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
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

        $id = $_GET['id'];
        $produto=getProductByID($id);
        $row = pg_fetch_assoc($produto);
        
    ?>
    
        <div class="container-prodinfo">

            <div class="container-prodinfo-imginfo">
                <img src="<?php echo $path2root ?>images\<?php echo $row['img_path'] ?>" alt="<?php echo $row['nome'] ?>">
                <p>
                    Descriçao:
                    <br>
                    <?php echo $row['descr'] ?>

                </p>
            </div>

            <div class="container-prodinfo-details">
                    <h2> <?php echo $row['nome'] ?> </h2>
                    <h3> <?php echo $row['price'] ?> </h3>  
                    <button onclick="location.href='<?php echo $path2root ?>acoes/produto/action_add_carrinho.php?id=<?php echo $row['id'] ?>;'"\"> Adicionar ao carrinho</button>      
                    <div class="container-prodinfo-details-fam">
                        <h4> Família de Produto: </h4> 
                        <p> <?php echo $row['familia'] ?> </p>
                        <h4> Restrições alimentares: </h4> 
                        <?php /*
                            
                            $restr=getRestrictionsByID($id);
                            if (empty($restr))
                                echo "N/D";
                            else{
                                $row_restr = pg_fetch_assoc($restr);
                                while (isset($row_restr['restr'])){
                                    echo "<p>".$row_restr['restr']."</p>";
                                    $row_restr = pg_fetch_assoc($restr);
                                }      
                            } */
                        ?>
                    </div>
            </div>

        </div>


</body>

</html>
