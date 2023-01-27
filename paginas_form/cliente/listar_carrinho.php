<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
        <!-- PARA ICONS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/shopping_cart.php";    
        include_once "../../database/products.php";        
        include_once "../../database/recipes.php";  
          
        if(empty($_SESSION['user']))
            header("Location: ".$path2root."index.php");

        $list_carrinho = getShoppingCartbyUserID($_SESSION['user']);
        
    ?>
    
    <div class="flex-box-encomendas">
        <h2> Lista de Encomendas: </h2>
        <div class="table_style">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Total</th>
                </tr>
                <?php
                
                    $row = pg_fetch_assoc($list_carrinho);

                    while (isset($row['id'])) {

                        echo "<tr>";
                        echo "<td> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['prod']."\"> ".$row['prod']."</td>";
                        echo "<td>".$row['quant']." Unidade(s) </td>";
                        $total_price=getTotalPriceProductbyQuantity($row['prod'], $row['quant']); 
                        echo "<td> ".$total_price." € </td>";
                        //echo "<td>".$row['total_price']."</td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_add1un_carrinho.php?id=".$row['prod']."\"> + 1 unidade </td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove1un_carrinho.php?id=".$row['prod']."\"> - 1 unidade </td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove_all_un_carrinho.php?id=".$row['prod']."\"> Remover tudo </td>";
                        echo "</tr>";
                                
                        $row = pg_fetch_assoc($list_carrinho);
                    }
                    
                ?>
            </table>
        </div>
    </div>


    

    

</body>

</html>
