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
        include_once "../../database/recipes.php";    
        
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        $id = $_GET['id'];
        $receita=getReceitaByID($id);
        $row = pg_fetch_assoc($receita);
               
    ?>
    


    <div class="row_title_img">
        
        <div class="column_title_descr">
            <h1>
                <?php echo $row['nome'] ?>
            </h1>
            <br>
            <br>
            
            <h3> Descrição: </h3> 
            <p>
                <?php echo $row['descr'] ?>
            </p>

            <br>
            
            <h3> Modo de preapração: </h3>    
            <p>
                <?php echo $row['method'] ?>
            </p>
        </div>
        <div class="column_img">
            <img src="<?php echo $path2root ?>images\<?php echo $row['img_path'] ?>" alt="<?php echo $row['nome'] ?>">
        </div>
        
    </div>


    <div class="row_resto">
        <div class="column_receita">
            <div class="mini-table_style">
                <table>
                    <tr>
                        <th>Tipo de Receita</th>
                        <td> <?php echo $row['type'] ?> </td>
                    </tr>
                    <tr>
                        <th>Dificuldade</th>
                        <td> <?php echo $row['difi'] ?> </td>
                    </tr>
                    <tr>
                        <th>Tempo de preparação</th>
                        <td> <?php echo $row['total_time'] ?> Minutos </td>
                    </tr>
                    <tr>
                        <th>Nº Doses</th>
                        <td> <?php echo $row['n_doses'] ?> Pessoas </td>
                    </tr>
                    <tr>
                        <th>Preço total</th>
                        <td> <?php echo $row['total_price'] ?> €</td>
                    </tr>
                </table>
            </div>
        </div>



        <div class="column_receita">
            <h3> Lista de ingredientes: </h3> 
            <ul>
                <?php 
                    $list_prods=getProductsandQuantityofRecipe($id);
                    $row_prod = pg_fetch_assoc($list_prods);
                    while (isset($row_prod['id_products'])) {
                        $prod=getProductByID($row_prod['id_products']);
                        $nome_prod=pg_fetch_assoc($prod);
                        echo "<li> ".$row_prod['quantity']." Unidade(s) - <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row_prod['id_products']."\"> ".$nome_prod['nome']."</a> </li>";                                                                              
                        $row_prod = pg_fetch_assoc($list_prods);
                    }
                ?>
            </ul> 
            
            <button class="confirm_button" onclick="location.href='<?php echo $path2root ?>acoes/receita/action_add_carrinho.php?id=<?php echo $row['id'] ?>'"\"> Adicionar produtos ao carrinho</button>      

        </div>

    </div>

</body>

</html>
