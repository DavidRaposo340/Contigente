<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Lista de Produtos</title>
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

        //Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
        if (!empty($_SESSION['familia'])) 		 	$familia = $_SESSION['familia']; 			else $familia = "todas";
        if (!empty($_SESSION['price_min'])) 		$price_min = $_SESSION['price_min']; 		else $price_min = 0;
        if (!empty($_SESSION['price_max'])) 	    $price_max = $_SESSION['price_max']; 		else $price_max = 1000;
        if (!empty($_SESSION['no_gluten'])) 	    $no_gluten = $_SESSION['no_gluten']; 	    else $no_gluten = 0;
        if (!empty($_SESSION['no_lact'])) 	        $no_lact = $_SESSION['no_lact']; 	        else $no_lact = 0;
        if (!empty($_SESSION['vegan'])) 	        $vegan = $_SESSION['vegan']; 	            else $vegan = 0;       
        
    ?>
    <div class="all_filtros">
        <div class="pre_filtros">
            <p class="botao_filtro" onclick="hide_div('filtros_div')">Filtros <i class="fa-solid fa-filter"> </i>  </p>

            <!--Search Bar-->
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Procurar produto..." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div id="filtros_div" class="filtros">
            <form method="post" action="<?php echo $path2root; ?>acoes/tecnico/action_filtrar_produto_tecnico.php">
                <p class="accordion">Família de produtos</p>
                    <div class="panel">
                        <!--Radio buttons-->
                        <input type="radio" id="familia"  name="familia" value="todas" <?php echo ($familia=="todas" ? 'checked' : '');?>>
                        <label for="todas"> Todas as familias</label><br>
                        <?php
            
                            $list_familias = getFamilyProducts();
                            $row = pg_fetch_assoc($list_familias);
                            
                            while (isset($row['id'])) {
                                if ($familia==$row['name'])
                                    echo '<input type="radio" id="familia"  name="familia" value="'.$row['name'].'" checked>';
                                else
                                    echo '<input type="radio" id="familia"  name="familia" value="'.$row['name'].'" >';
                                echo '<label for="'.$row['name'].'"> '.$row['name'].'</label><br>';
                                $row = pg_fetch_assoc($list_familias);
                            }
                            
                            /* 
                                //Formato do cartao de produto
                                <input type="radio" id="familia"  name="familia" value="todas" <?php echo ($familia=="todas" ? 'checked' : '');?>>
                                <label for="todas"> Todas as familias</label><br>
                            */
                        ?>
                        
                    </div> 

                <p class="accordion">Restrições alimentares <i class="fa-solid fa-wheat-awn-circle-exclamation"></i></p>
                    <div class="panel">
                        <!--CHECKBOXS-->
                        <input type="checkbox" id="gluten" name="gluten" value="1" <?php echo ($no_gluten==1 ? 'checked' : '');?>>
                        <label for="gluten"> Sem gluten</label><br>
                        
                        <input type="checkbox" id="lactose" name="lactose" value="1" <?php echo ($no_lact==1 ? 'checked' : '');?>>
                        <label for="lactose"> Sem lactose</label><br>
                        
                        <input type="checkbox" id="vegan" name="vegan" value="1" <?php echo ($vegan==1 ? 'checked' : '');?>>
                        <label for="vegan"> Vegan</label><br><br>
                    </div> 

                    <div class="panel">
                        <!--  ...  -->
                    </div> 
                    
                <p class="accordion">Preço <i class="fa-solid fa-euro-sign"></i> </p>
                    <div class="panel">
                        <!--  Range slider  -->
                        <div data-role="rangeslider">
                            <label for="price-min">Preço mínimo :</label>
                            <input type="range" name="price-min" id="price-min" value=<?php echo $price_min;?> min="0" max="50">
                            <br>
                            <label for="price-max">Preço máximo:</label>
                            <input type="range" name="price-max" id="price-max" value=<?php echo $price_max;?> min="0" max="50">
                        </div>    
                    </div> 

                <input class="confirm_button" type="submit" value="Submit">
            </form> 
        </div>
    </div>

    
    <div class="flex-box-encomendas">
        <h2> Lista de Produtos: </h2>

        <?php	

            echo"<div class=\"table_style\">";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th><th>Nome</th><th>Família</th><th>Em Stock</th><th>Preço</th>";
            echo "</tr>";	
            
            $list_products = getAllProducts($familia, $no_gluten, $no_lact, $vegan, $price_min, $price_max );
            $row = pg_fetch_assoc($list_products);

            while (isset($row['id'])) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td style='width:90px;padding:10px 5px'>".$row['nome']."</td>";
                echo "<td>".$row['familyid']."</td>"; 
                echo "<td>".$row['quantity']."</td>";
                echo "<td>".$row['price']." €</td>";

                echo "<td style='width:90px;padding:0px'> <a href=\"".$path2root."acoes/tecnico/form_editar_produto.php?id=".$row['id']."\" style='width:90px;padding:6px 7px'>Editar</td>";
                echo "<td style='width:90px;padding:0px'> <a href=\"".$path2root."acoes/tecnico/remover_produto.php?id=".$row['id']."\" style='width:90px;padding:6px 7px'>Remover</td>";
                echo "<td style='width:90px;padding:0px'> <a href=\"".$path2root."acoes/tecnico/form_gerir_stock.php?id=".$row['id']."\" style='width:90px;padding:6px 7px'>Stock</td>";
                $row = pg_fetch_assoc($list_products);
            }
            echo "</table>";
            echo "</div>";
        ?>
    </div>
    
    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <script src="<?php echo $path2root ?>javascript\accordion_button.js"></script>
    <script src="<?php echo $path2root ?>javascript\hide_div.js"></script>
    <script src="<?php echo $path2root ?>javascript\confirm_button.js"></script>
</body>

</html>
