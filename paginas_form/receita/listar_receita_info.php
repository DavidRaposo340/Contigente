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
        

        $id = $_GET['id'];
        //$receita=getProductByID($id);
        //$row = pg_fetch_assoc($receita);

        $row['id']=1;
        $row['nome']="NOME_REC";
        $row['difi']="dificil";
        $row['tempo']=58;
        $row['n_doses']=4;
        $row['total_price']=58;
        $row['type']="bolo";
        $row['descr']="passo 999";

        $row['list_prods']=1;
        $list_prods=$row['list_prods'];
        
        
        
    ?>
    


    <div class="row_title_img">
        <h1>
            <!-- Já tinha criado uma class para este tipo de titulo (é igual à pag1)-->
            <?php echo $row['nome'] ?>
        </h1>
        <img src="<?php echo $path2root ?>images\<?php echo $row['img_path'] ?>" alt="<?php echo $row['nome'] ?>">
        <p>
            Descriçao:
            <br>
            <?php echo $row['descr'] ?>

        </p>
    </div>


    <div class="row_resto">
        <div>
            <table>
                <tr>
                    <th>Tipo de Receita</th>
                    <td> <?php echo $row['type'] ?> </td>";
                </tr>
                <tr>
                    <th>Dificuldade</th>
                    <td> <?php echo $row['difi'] ?> </td>";
                </tr>
                <tr>
                    <th>Tempo de preparação</th>
                    <td> <?php echo $row['tempo'] ?> </td>";
                </tr>
                <tr>
                    <th>Nº Doses</th>
                    <td> <?php echo $row['n_doses'] ?> </td>";
                </tr>
                <tr>
                    <th>Preço total</th>
                    <td> <?php echo $row['total_price'] ?> </td>";
                </tr>
            </table>

            <p>
                Descriçao:
                <br>
                <?php echo $row['descr'] ?>
            </p>
        </div>


        <div>
            <ul>
                <?php /*// à espera da funçao...
                    $row_prod = pg_fetch_assoc($list_prods);
                    while (isset($row_prod['id'])) {
                        $nome_prod=getProductByID($row_prod['id']);
                        echo "<li> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row_prod['id']."\"> ".$nome_prod."</li>";                                                      
                        $row_prod = pg_fetch_assoc($list_prods);
                    }*/
                ?>
            </ul> 

            <button onclick="location.href='<?php echo $path2root ?>acoes/receita/action_add_carrinho.php?id=<?php echo $row['id'] ?>;'"\"> Adicionar produtos ao carrinho</button>      

        </div>

    </div>

</body>

</html>
