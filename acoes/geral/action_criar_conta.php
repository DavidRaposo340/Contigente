<?php
$path2root = "../../";

session_start();
include_once "../../includes/opendb.php";
include_once "../../database/users.php";

print_r($_POST);


$nome = $_POST['nome'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_pass = $_POST['conf_pass'];


//Validação dos dados
//Assume-se que todos os campos são obrigatórios (a query insert apenas é executada se todos os campos  preenchidos)
if (empty($nome) || empty($address) || empty($email) ||  empty($password)||  empty($conf_pass)){
        $dadosValidos = false;
        //Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
        $_SESSION['msgErro'] = "Pelo menos um dos campos em falta <p>"; 
}

else if ( $password != $conf_pass ){
        $dadosValidos = false;
        $_SESSION['msgErro'] = "Password e password de confirmação não correspondem <p>";
}

else if ( /*VERIFCAR SE JA EXISTE EMAIL*/ 0 ){
        $dadosValidos = false;
        //Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
        $_SESSION['msgErro'] = "Já existe uma conta com o e-mail introduzido <p>";     
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
        header("Location: ".$path2root."paginas_form/geral/form_criar_conta.php");
    }
    else {
        if (isset($_POST['gluten']) && $_POST['gluten'] == '1') $no_gluten = true; 
        else $no_gluten = false;

        if (isset($_POST['lactose']) && $_POST['lactose'] == '1') $no_lact = true;
        else $no_lact = false;
        
        if (isset($_POST['vegan']) && $_POST['vegan'] == '1') $vegan = true;
        else $vegan = false;
        
        $encrypt_pass = md5($password);
        //$result = createConta($nome, $address, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan);

        //inicia sessão automaticamnte
        $user = getUserByEmailAndPass($email, $encrypt_pass);
        $_SESSION['username'] = $user;
        header("Location: ".$path2root."index.php");
    }



?>