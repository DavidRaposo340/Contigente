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

        $list_carrinho = getShoppingCart();
        
    ?>
    


    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Total</th>
        </tr>
        <?php
            // à espera da funçao...
            /*
            $row = pg_fetch_assoc($list_receitas);
            $row['id']=1;
            $row['quant']=12;
            $row['total_price']=999;
            $row['prod']="azeite";
            

            while (isset($row['nome'])) {

                echo "<tr>";
                echo "<td> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['id']."\"> ".$row['prod']."</td>";
                echo "<td>".$row['quant']."</td>";
                echo "<td>".$row['total_price']."</td>";
                echo "<td> <a href=\"".$path2root."acoes/cliente/action_add_1.php?id=".$row['id']."\"> Adicionar 1 unidade </td>";
                echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove_1.php?id=".$row['id']."\"> Remover 1 unidade </td>";
                echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove_all.php?id=".$row['id']."\"> Remover tudo </td>";
                echo "<tr>";
                           
                $row = pg_fetch_assoc($result);
            }
            */
        ?>
    </table>

    

</body>

</html>
