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
            <p class="botao_filtro" onclick="hide_div('filtros_div')">Filtros</p>

            <!--Search Bar-->
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Procurar produto..." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div id="filtros_div" class="filtros">
            <form method="post" action="<?php echo $path2root; ?>acoes/produto/action_filtrar_loja.php">
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

                <p class="accordion">Restrições alimentares</p>
                    <div class="panel">
                        <!--CHECKBOXS-->
                        <input type="checkbox" id="gluten" name="gluten" value="1" <?php echo ($no_gluten==1 ? 'checked' : '');?>>
                        <label for="gluten"> Sem gluten</label><br>
                        
                        <input type="checkbox" id="lactose" name="lactose" value="1" <?php echo ($no_lact==1 ? 'checked' : '');?>>
                        <label for="lactose"> Sem lactose</label><br>
                        
                        <input type="checkbox" id="vegan" name="vegan" value="1" <?php echo ($vegan==1 ? 'checked' : '');?>>
                        <label for="vegan"> Vegan</label><br><br>
                    </div> 

                <p class="accordion">Outro filtro</p>
                    <div class="panel">
                        <!--  ...  -->
                    </div> 
                    
                <p class="accordion">Preço</p>
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


    <div class="aviso">
        <h1> Loja de Produtos: </h1>
        <?php
        //Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável
        if (!empty($_SESSION['msgAviso'])) {
            echo "<p style=\"color:#0d2137\">" . $_SESSION['msgAviso'] . "</p>";
            $_SESSION['msgAviso'] = NULL;
        }
        else
            echo "<br>"
        ?>
    </div> 

    <div class="flex-box">

        <?php
            
            $list_products = getAllProducts($familia, $no_gluten, $no_lact, $vegan, $price_min, $price_max );
            $row = pg_fetch_assoc($list_products);
            
            while (isset($row['id'])) {
                echo "<div class=\"cartao_produto\">";
                echo "<img src=" .$path2root. "images\\".$row['img_path']." alt=\"".$row['nome']."\">";
                echo "<div class=\"cartao_nome_preco\">";   
                echo "<h2> ".$row['nome']." </h2>";
                echo "<h3> ".$row['price']."€ </h2>";
                echo "</div>";
                echo "<div class=\"cartao_botoes\">";
                echo "<button onclick=\"location.href='".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['id']."';\"> Ver detalhes</button>";
                echo "<button onclick=\"location.href='".$path2root."acoes/produto/action_add_carrinho.php?id=".$row['id']."&quantity=1';\"> Adicionar ao carrinho</button>";
            
                echo "</div>";  
                echo "</div>";            
                $row = pg_fetch_assoc($list_products);
            }
            
            /* 
                //Formato docartao de produto
                <div class="cartao_produto">
                    <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
                    <div class="cartao_nome_preco">    
                        <h2> NOME </h2>
                        <h3> PREÇO </h2>
                    </div>    
                    <div class="cartao_botoes">
                        <button onclick="location.href='<?php echo $path2root ?>paginas_form/produto/listar_produto_info.php';"> Ver detalhes </button>
                        <button onclick="location.href='<?php echo $path2root ?>paginas_form/produto/listar_produto_info.php';"> Adicionar ao carrinho</button>
                    </div>
                </div>
            */
        ?>

    </div>

    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <script src="<?php echo $path2root ?>javascript\accordion_button.js"></script>
    <script src="<?php echo $path2root ?>javascript\hide_div.js"></script>
    <script src="<?php echo $path2root ?>javascript\confirm_button.js"></script>
</body>

</html>
