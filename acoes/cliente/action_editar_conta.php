<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/users.php";

print_r($_POST);

$user_logged = $_SESSION['user'];    
$nome = $_POST['nome'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_pass = $_POST['conf_pass'];

$dadosValidos = true;

if(isset($_POST['checkbox_confirmar']) ){
    //Validação dos dados
    //Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
    //Assume-se que todos os campos são obrigatórios 
    if (empty($nome) || empty($address) || empty($email)){
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Pelo menos um dos campos em falta!"; 
    }
    else if ( $password != $conf_pass ){
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Password e password de confirmação não correspondem!";
    }

    else if ( emailExists($email)){
        $user_info=getUserbyID($_SESSION['user']);
        if ($user_info['email']!=$email){
            $dadosValidos = false;
            $_SESSION['msgErro'] = "Já existe uma conta com o e-mail introduzido!";     
        }
      }        
    else {
    $dadosValidos = true;
    }


    if (!$dadosValidos){

        //são registados em variáveis de sessão os dados introduzidos pelo utilizador no formulário
        $_SESSION['nome'] = $nome;
        $_SESSION['address'] = $address;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['conf_pass'] = $conf_pass;

        //Depois de criadas as variáveis de sessão, o script é redirecionado para o formulário que irá apresentar os dados que o utilizador tinha introduzido anteriormente
        header("Location: ".$path2root."paginas_form/cliente/form_editar_conta.php");
    }
    else {
        if (isset($_POST['gluten']) && $_POST['gluten'] == '1') $no_gluten = 'true'; 
        else $no_gluten = 'false';

        echo $no_gluten;

        if (isset($_POST['lactose']) && $_POST['lactose'] == '1') $no_lact = 'true';
        else $no_lact = 'false';
        
        if (isset($_POST['vegan']) && $_POST['vegan'] == '1') $vegan = 'true';
        else $vegan = 'false';
        
        $encrypt_pass = md5($password);
        editConta($user_logged, $nome, $address, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan);

        $_SESSION['password'] = NULL;
        $_SESSION['conf_pass'] = NULL;
        header("Location: ".$path2root."paginas_form/cliente/form_editar_conta.php");

        
    }
}

if (isset($_POST['checkbox_cancelar'])){
    header("Location: ".$path2root."index.php");
}

if (isset($_POST['checkbox_remover_conta'])){
    header("Location: ".$path2root."acoes/cliente/action_remover_conta.php");
}


?>