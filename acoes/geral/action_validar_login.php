<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/users.php";

print_r($_POST);

$email = $_POST["email"];
$password = $_POST['password'];

if (empty($email) ||  empty($password)  ){

  //Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
  $_SESSION['msgErro'] = "Pelo menos um dos campos em falta"; 

  $_SESSION['email'] = $email;
  $_SESSION['password'] = $password;

  //Depois de criadas as variáveis de sessão, o script é redirecionado para o formulário que irá apresentar os dados que o utilizador tinha introduzido anteriormente
  header("Location: ".$path2root."paginas_form/geral/form_login.php");

}
else{
  //A encriptação da password para contactar com a bass de dados
  $encrypt_pass = md5($password);

  //falta criar esta funçao
  $user = getUserByEmailAndPass($email, $encrypt_pass);

  if ($user == NULL) {
      $_SESSION['msgErro'] = "Erro ao iniciar sessão <p>";     
      header("Location: ".$path2root."paginas_form\geral\form_login.php");
  } else{
      $_SESSION['user'] = $user;
      header("Location: ".$path2root."index.php");
  }
}





?>
