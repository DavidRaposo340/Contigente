<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
  <title>CONTIGENTE</title>
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="images/logo/icon.jpg">
</head>

<body>
  <?php
      $path2root = "";
      include("includes/navbar.php"); 
  ?>

  <div class="row">

    <div class="column_intro">
    
      <h1> CONTIGENTE </h1>

      <p> 
          Quer cozinhar, mas não sabe o quê?
          <br>
          <br>
          
          Sente que leva para casa mais ingredientes do que precisa e depois estes acabam por se estragar por não saber o que fazer com eles?
          Gira melhor as suas compras e as suas refeições no dia-a-dia com o Contigente!

          <br>
          <br>
      </p>

      <!-- SLIDESHOW -->
      <?php include("javascript/slideshow_receitas.php"); ?> 

    </div>

    <div class="column_about">

      <button class="accordion">Sobre nós</button>
        <div class="panel">
          <button class="sub_accordion"> David Raposo</button>  
          <button class="sub_accordion"> Tiago Correia</button>  
          <button class="sub_accordion"> Telma Moreira</button>  
        </div>

      <button class="accordion">Elementos para Download</button>
        <div class="panel">
          <button class="sub_accordion"> Relatório   </button>  
          <button class="sub_accordion"> Código Zip  </button>  
          <button class="sub_accordion"> CSS         </button>  
          <button class="sub_accordion"> Outro??     </button>    
        </div>
    </div>
    
  </div>

    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <script src="javascript\accordion_button.js"></script>
</body>

</html>
