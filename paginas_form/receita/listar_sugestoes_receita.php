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
        include_once "../../database/recipes.php";    

        if (!empty($_SESSION['filtro_rec'])) $filtro_rec = $_SESSION['filtro_rec'];    else $filtro_rec = NULL;

        $list_receitas = getAllReceitas($filtro_rec);
        
    ?>
    
    <div>
        <p>
            Lorem ipsum
            <br>
            Lorem ipsum UM POUCO CONTEXTO..
            MOSTRAMOS RECEITAS PARA AJUDAR NA ALTURA DE IR AS COMPRAS ETC

        </p>

        <!--Search Bar-->
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Procurar receita..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <!-- SLIDESHOW -->
        <?php //include("javascript/slideshow_receitas.php"); ?> 

    </div>

    <table>
        <tr>
            <th>Nome da receita</th>
            <th>Dificuldade</th>
            <th>Tempo de preparação</th>
            <th>Preço total</th>
        </tr>
        <?php

            $row = pg_fetch_assoc($list_receitas);           

            while (isset($row['id'])) {

                echo "<tr>";
                echo "<td> <a href=\"".$path2root."paginas_form/receita/listar_receita_info.php?id=".$row['id']."\"> ".$row['nome']."</td>";
                echo "<td>".$row['difi']."</td>";
                echo "<td>".$row['total_time']." Minutos </td>";
                echo "<td>".$row['total_price']." €</td>";
                echo "<tr>";
                           
                $row = pg_fetch_assoc($list_receitas);
            }
            
        ?>
    </table>

    

</body>

</html>
