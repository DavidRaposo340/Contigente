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
    ?>
    
    <div class="pre_filtros">
        <button class="botao_filtro" onclick="hide_div('filtros_div')">Filtros</button>

        <!--Search Bar-->
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Procurar produto..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div id="filtros_div" class="filtros">

            <button class="accordion">Família de produtos</button>
                <div class="panel">
                    <!--Radio buttons-->
                    <form action="/action_page.php">
                        <input type="radio" id="famila"  name="famila" value="vegetais">
                        <label for="vegetais"> Vegetais</label><br>

                        <input type="radio" id="famila"  name="famila" value="laticineos">
                        <label for="laticineos"> Laticíneos</label><br>

                        <input type="radio" id="famila"  name="famila" value="gorduras">
                        <label for="gorduras"> Gorduras</label><br>
                        
                        <input type="radio" id="famila"  name="famila" value="hidratos">
                        <label for="hidratos"> Hidratos</label><br>
                        <!--continuar pls-->
                        <input type="submit" value="Submit">
                    </form>
                </div> 

            <button class="accordion">Restrições alimentares</button>
                <div class="panel">
                    <form action="/action_page.php">
                        <!--CHECKBOXS-->
                        <input type="checkbox" id="gluten" name="gluten" value="1">
                        <label for="gluten"> Sem gluten</label><br>
                        
                        <input type="checkbox" id="lactose" name="lactose" value="1">
                        <label for="lactose"> Sem lactose</label><br>
                        
                        <input type="checkbox" id="vegan" name="vegan" value="1">
                        <label for="vegan"> Vegan</label><br><br>
                        <!--continuar pls-->
                        <input type="submit" value="Submit">
                    </form>
                </div> 

            <button class="accordion">Outro filtro</button>
                <div class="panel">
                    <!--  ...  -->
                </div> 
                
            <button class="accordion">Preço</button>
                <div class="panel">
                    <form action="/action_page.php">
                        <!--  Range slider  -->
                        <div data-role="rangeslider">
                            <label for="price-min">Price:</label>
                            <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
                            
                            <label for="price-max">Price:</label>
                            <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
                        </div>
                        <input type="submit" value="Submit">
                    </form>    
                </div> 

        </div>

    </div>


    <div class="flex-box">
      <div class="cartao_produto">
            <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
        <div class="cartao_nome_preco">    
            <h2> Azeite </h2>
            <h3> Preço </h2>
        </div>    
        <div class="cartao_botoes">
            <button>Ver detalhes</button>
            <button>Adicionar ao carrinho</button>
        </div>
      </div>

      <div class="cartao_produto">
            <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
        <div class="cartao_nome_preco">    
            <h2> Azeite </h2>
            <h3> Preço </h2>
        </div>    
        <div class="cartao_botoes">
            <button>Ver detalhes</button>
            <button>Adicionar ao carrinho</button>
        </div>
      </div>

      <div class="cartao_produto">
            <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
        <div class="cartao_nome_preco">    
            <h2> Azeite </h2>
            <h3> Preço </h2>
        </div>    
        <div class="cartao_botoes">
            <button>Ver detalhes</button>
            <button>Adicionar ao carrinho</button>
        </div>
      </div>
      <div class="cartao_produto">
            <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
        <div class="cartao_nome_preco">    
            <h2> Azeite </h2>
            <h3> Preço </h2>
        </div>    
        <div class="cartao_botoes">
            <button>Ver detalhes</button>
            <button>Adicionar ao carrinho</button>
        </div>
      </div>

      <div class="cartao_produto">
            <img src="<?php echo $path2root ?>images\produtos\img_prod_azeite.jpg" alt="AZEITE">
        <div class="cartao_nome_preco">    
            <h2> Azeite </h2>
            <h3> Preço </h2>
        </div>    
        <div class="cartao_botoes">
            <button>Ver detalhes</button>
            <button>Adicionar ao carrinho</button>
        </div>
      </div>
      <!--  gerar TODOS os produtos dinamicamente  -->

    </div>

    
    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <script src="<?php echo $path2root ?>javascript\accordion_button.js"></script>
    <script src="<?php echo $path2root ?>javascript\hide_div.js"></script>
</body>

</html>
