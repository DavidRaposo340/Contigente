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
          <p class="sub_accordion_intro"> David Raposo <br> <a href="mailto:up201806281@edu.fe.up.pt"> up201806281@edu.fe.up.pt </a> 
            <img src="images\autores\david.png">
          </p>  
          <p class="sub_accordion_intro"> Tiago Correia <br> <a href="mailto:up201806248@edu.fe.up.pt"> up201806248@edu.fe.up.pt </a>
            <img src="images\autores\tiago.png">
          </p>  
          <p class="sub_accordion_intro"> Telma Moreira <br> <a href="mailto:up201806586@edu.fe.up.pt"> up201806586@edu.fe.up.pt </a> 
            <img src="images\autores\telma.png">
          </p>  
        </div>

      <button class="accordion">Elementos para Download</button>
        <div class="panel">
          <p class="sub_accordion"> <a href="Relatorio_final.pptx"> Relatório PPT  </a>  </p> 
          <p class="sub_accordion"> <a href="Projeto2.xlsx"> Relatório Excel  </a> </p>   
          <p class="sub_accordion"> <a href="Projeto2.xlsx"> Código Zip  </a> </p>  
        </div>

      <button class="accordion">Credencias de acesso</button>
        <div class="panel">
          <p class="sub_accordion">  Conta de gestor <br> E-mail: admin@gmail.com Password:1234   </p> 
          <p class="sub_accordion">  Conta de técnico <br> E-mail: tecnico@gmail.com Password:1234    </p> 
          <p class="sub_accordion">  Conta de cliente <br> E-mail: david@gmail.com Password:1234    </p> 
 
        </div>
    </div>
    
  </div>

    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <script src="javascript\accordion_button.js"></script>
</body>

</html>
