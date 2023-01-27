<?php
  session_start();
  include_once "../../database/user_type.php"; 
  function getPath($page) {
      $current_dir = dirname($_SERVER['PHP_SELF']);
      if ($current_dir == '/') {
          $current_dir = '';
      }
      return $current_dir . '/' . $page;
  }
?>

<nav>
  <div class="nav_backside">
  </div>
  <div class="nav_center">
    <a href="<?php echo $path2root; ?>index.php"> CONTIGENTE</a>
  </div>

  <div class="nav_block">

      <a href="<?php echo $path2root; ?>paginas_form\produto\listar_loja_produtos.php"> Loja</a>
      <a href="<?php echo $path2root; ?>paginas_form\receita\listar_sugestoes_receita.php"> Sugestões</a>    
      
    <div class="nav_right">
      <a href="<?php echo $path2root; ?>paginas_form\cliente\listar_carrinho.php"> Carrinho</a>    

    <?php
        //include_once "../../database/user_type.php";  
        
        //Se houver sessao inciada apresenta botao conta, senao apresenta iniciar sessao
        if (!empty($_SESSION['user'])) {
          //echo '<a href="'.$path2root.'paginas_form\geral\form_conta.php"> Conta</a> ';
          echo '<div class="dropdown">';
          echo '<a class="dropdown-toggle" href="#">Conta</a>';
          echo '<div class="dropdown-content">';
          echo '<a href="'.$path2root.'a_page">Dados Pessoais</a>';
          echo '<a href="'.$path2root.'b_page">Encomendas</a>';
          if (getUserTypebyID($_SESSION['user'])==2 || getUserTypebyID($_SESSION['user'])==3)
            echo '<a href="'.$path2root.'b_page">Produtos</a>';
          if (getUserTypebyID($_SESSION['user'])==3)
            echo '<a href="'.$path2root.'b_page">Estatistica</a>';

          echo '<a href="'.$path2root.'b_page">Logout</a>';

          echo '</div>';
          echo '</div>';

          /* //formato dropdown button
            <div class="dropdown">
              <a class="dropdown-toggle" href="#">Carrinho</a>
              <div class="dropdown-content">
                <a href="<?php echo $path2root; ?>a_page">Dados Pessoais</a>
                <a href="<?php echo $path2root; ?>b_page">Encomendas</a>
              </div>
            </div>
          */
        }
        else {
          echo '<a href="'.$path2root.'paginas_form\geral\form_login.php"> Iniciar sessão</a> ';
        }
      ?>




    </div>
  </div>
</nav>
  