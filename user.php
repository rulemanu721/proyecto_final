<?php 
include_once 'db2.php';


Class User extends DB{
    private $nombre;
    private $username;
    private $privilegios;

    public function userExists($user,$pass){
        $md5pass = md5($pass);
        $Administrador = 'Administrador';
        $Usuario ="Usuario";

        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND pass_user =:pass AND privilegios_user = :Administrador');
        
        $query->execute(['user'=>$user, 'pass'=>$md5pass,'Administrador'=>$Administrador]);
        if ($query->rowCount()){
            return 1;
        }else{
            $query2 = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND pass_user =:pass AND privilegios_user = :Usuario');
            $query2->execute(['user'=>$user, 'pass'=>$md5pass,'Usuario'=>$Usuario]);
            if ($query2->rowCount())
            return 2;
        }
    }



 
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user' );
        $query->execute(['user' => $user]);
        /*
        foreach ($query as $currentUser => $value){
            $this->nombre = $currentUser['nombre'];
            $this->nombre = $currentUser['username'];*/

        //}

    }/*
    public function getPrivilegios(){
        return $this->privilegios;

    }*/

}


?>