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
    
    <div class="flex-box-generic">
        <h2> Carrinho de compras: </h2>

        <?php
            $row = pg_fetch_assoc($list_carrinho);
            if(!isset($row['id']))
                echo ' <p> Carrinho vazio. <br> Dirija-se à loja para adicionar produtos </p>';
            
            if (!empty($_SESSION['msgErro'])) {
                echo "<p style=\"color:red\">".$_SESSION['msgErro']."</p>";
                $_SESSION['msgErro'] = NULL;
            }
                
        ?>

        <div class="generic_table_style">
            <table>
                <?php
                    if(isset($row['id'])){
                        echo '<tr>';
                        echo '<th>Produto</th>';
                        echo '<th>Quantidade</th>';
                        echo '<th>Preço Total</th>';
                        echo '</tr>';
                    }

                    while (isset($row['id'])) {

                        echo "<tr>";
                        echo "<td> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['id_prod']."\"> ".$row['name']."</td>";
                        echo "<td>".$row['quant']." Unidade(s) </td>";
                        $total_price=getTotalPriceProductbyQuantity($row['id_prod'], $row['quant']); 
                        echo "<td> ".$total_price." € </td>";
                        //echo "<td>".$row['total_price']."</td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_add1un_carrinho.php?id=".$row['id_prod']."\"> <i class=\"fa fa-plus\"> </td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove1un_carrinho.php?id=".$row['id_prod']."\"> <i class=\"fa fa-minus\"> </td>";
                        echo "<td> <a href=\"".$path2root."acoes/cliente/action_remove_all_un_carrinho.php?id=".$row['id_prod']."\"> <i class=\"fa fa-trash\"> </td>";
                        echo "</tr>";
                                
                        $row = pg_fetch_assoc($list_carrinho);
                    }
                    
                ?>
            </table>
        </div>
        <br>    
        <?php
            $list_carrinho = getShoppingCartbyUserID($_SESSION['user']);
            $row = pg_fetch_assoc($list_carrinho);
            if(isset($row['id'])){
                echo "<button class=\"confirm_button\" onclick=\"location.href='".$path2root."acoes/cliente/action_finalizar_encomeda.php?id=".$_SESSION['user']."';\"> Finalizar Encomenda</button>";
                echo "<button class=\"cancel_button\" onclick=\"location.href='".$path2root."acoes/cliente/action_esvaziar_carrinho.php?id=".$_SESSION['user']."';\"> Esvaziar carrinho</button>";    
            }
        ?>     

        
    </div>


    

    

</body>

</html>
