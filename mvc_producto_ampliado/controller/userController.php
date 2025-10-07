<?php
require_once("repository/userRepository.php");
class UserController{

    private static UserRepository $userRepository;

    public function __construct(){
        if(!isset($userRepository)){
            self::$userRepository = new UserRepository();
        }
    }    
    
    public function login(){
        include_once("view/login.php");
    }

    public function validate(){
        $user =  (new User())->setName($_POST['name'])->setPass(md5($_POST['pass']));
        $user = self::$userRepository->verifyUser($user);

        if(isset($user)){
            $_SESSION['role'] =  $user['role'];
            $_SESSION['userid'] =  $user['id'];
            $_SESSION['name'] =  $user['name'];
            $_SESSION['userid'] =  $user['id'];
            $_SESSION['logged'] = true;
            (new ProductController())->defaultProduct();
        }
        else{
            $message = 'Datos incorrectos';
            include_once("view/login.php");
        }
    }
   
    public function logout(){
        session_destroy();
        header("Location: $BASE_URL");
    }
}

?>