<?php


include_once 'user.php';
include_once 'user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['username'])){
    echo "Hay sesion";
}else if(isset($_POST['username']) && isset($_POST['password'])){
   // echo "Valicacion del login";
   $userForm = $_POST['username'];
   $passForm = $_POST['password'];

   if ($user->userExists($userForm, $passForm) == 1){
       echo "Admin";
       $userSession->setCurrentUser($userForm);
       $user->setUser($userForm);
       include_once 'admin_principal.php';
   }
   else if(($user->userExists($userForm, $passForm) == 2)){
       echo "User";
       $userSession->setCurrentUser($userForm);
       $user->setUser($userForm);
       include_once 'index_ventas.php';
       
   }else{
    echo "Datos incorrectos";
    echo $userForm;
    echo $passForm;
   }
}else{
    echo "Login";
    include_once 'login_form.php';
    
}

?>