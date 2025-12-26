<?php
require_once 'connexion.php';

class Users {
    private $pdo;
    public string $nom;
    private string $email;
    private string $password;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function register($nom, $email, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (nom, email, password) VALUES (?, ?, ?)"
        );
        try{
            return $stmt->execute([$nom, $email, $hash]);

        }catch(PDOException $e){
            echo 'erreur'.$e->getMessage();
        }
    }

    public function login($email,$password){
        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (isset($user) && password_verify($password, $user['password'])) {
         
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];
            header('Location: dashbord.php');
            exit;

        }else{
            echo "email ou password est incorrect ! ";
        }
     }

     public function logout(){
        session_destroy();
        session_unset();
        header('Location: index.php');
        exit;
     }
}

class categoriesEx{
    private $pdo;
    private $nom;
    private $user_id;
    public function __construct($pdo){
        $this->pdo=$pdo;
    }
  
  public function create($nom,$user_id){
    $stmt = $this->pdo->prepare("INSERT INTO categoriesEx(nom,user_id)VALUES (?,?)");
    $stmt->execute([$nom,$user_id]);
  }

  public function select($user_id){
    try{
        $stmt=$this->pdo->prepare("SELECT * FROM categoriesEx WHERE user_id=?");
        $stmt->execute([$user_id]);
        $user=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }catch(PDOExepcetion $e){
        echo 'erreur'.$e->getMessage();
    }
  }
}