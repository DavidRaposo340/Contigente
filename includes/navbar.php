<?php
  session_start();
  function getPath($page) {
      $current_dir = dirname($_SERVER['PHP_SELF']);
      if ($current_dir == '/') {
          $current_dir = '';
      }
      return $current_dir . '/' . $page;
  }
?>

<nav>
  <div class="nav_center">
    <a href="<?php echo $path2root; ?>index.php"> CONTIGENTE</a>
  </div>

  <div class="nav_block">

      <a href="<?php echo $path2root; ?>paginas_form\produto\listar_loja_produtos.php"> Loja</a>
      <a href="<?php echo $path2root; ?>paginas_form\receita\listar_sugestoes_receita.php"> Sugestões</a>    
      
    <div class="nav_right">
      <a href="<?php echo $path2root; ?>paginas_form\cliente\listar_carrinho.php"> Carrinho</a>
       

      <?php
      
        //Se houver sessao inciada apresenta botao conta, senao apresenta iniciar sessao
        if (!empty($_SESSION['user'])) {
          echo '<a href="'.$path2root.'paginas_form\geral\form_conta.php"> Conta</a> ';
        }
        else {
          echo '<a href="'.$path2root.'paginas_form\geral\form_login.php"> Iniciar sessão</a> ';
        }

        /*      
          <a href="<?php echo $path2root; ?>paginas_form\geral\form_login.php"> Conta</a>
          <a href="<?php echo $path2root; ?>paginas_form\geral\form_login.php"> Iniciar sessão</a>
        
        */
      ?>
 
    </div>
  </div>
</nav>
  