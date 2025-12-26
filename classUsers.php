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

class categoriesIn{
    private $pdo;
    private $nom;
    private $user_id;
    public function __construct($pdo){
        $this->pdo=$pdo;
    }
  
  public function create($nom,$user_id){
    $stmt = $this->pdo->prepare("INSERT INTO categoriesIn(nom,user_id)VALUES (?,?)");
    $stmt->execute([$nom,$user_id]);
  }

  public function select($user_id){
    try{
        $stmt=$this->pdo->prepare("SELECT * FROM categoriesIn WHERE user_id=?");
        $stmt->execute([$user_id]);
        $user=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }catch(PDOExepcetion $e){
        echo 'erreur'.$e->getMessage();
    }
  }
}
class expenses{
        private $pdo;
        private $id;
        private $MontantEx;
        private $descreptionEx;
        private $dateEx;
        private $categories_id;
        private $user_id;

        public function __construct($pdo){
           $this->pdo=$pdo;
        }

        public function createEx($MontantEx,$descreptionEx,$dateEx,$categories_id,$user_id){
          $stmt=$this->pdo->prepare("INSERT INTO expenses(montantEx,descriptionEx,dateEx,category_id,user_id)VALUES(?,?,?,?,?)");
          $stmt->execute([$MontantEx,$descreptionEx,$dateEx,$categories_id,$user_id]);
        } 
        public function updateEx($id, $MontantEx, $descriptionEx, $dateEx){
            $stmt = $this->pdo->prepare("UPDATE expenses SET montantEx = ?, descriptionEx = ?, dateEx = ? WHERE id = ?");
            $stmt->execute([$MontantEx, $descriptionEx, $dateEx, $id]);
        }
        public function deleteEx($id){
            $stmt=$this->pdo->prepare("DELETE FROM expenses WHERE id=?");
            $stmt->execute([$id]);
            header('Location: dashbord.php');
            exit;
        }
        public function getTotalExpenses($user_id){
        $stmt = $this->pdo->prepare("SELECT SUM(montantEx) as total FROM expenses WHERE user_id=?");
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
        }
        public function affichageEx($user_id){
            $stmt=$this->pdo->prepare("SELECT * FROM expenses  WHERE user_id=?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function affichageExMD($id){
            $stmt=$this->pdo->prepare("SELECT * FROM expenses  WHERE id=?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}


    class Incomes{
        private $pdo;
        private $id;
        private $MontantIn;
        private $descreptionIn;
        private $dateIn;
        private $categories_id;
        private $user_id;

        public function __construct($pdo){
           $this->pdo=$pdo;
        }

        public function createIn($MontantIn,$descreptionIn,$dateIn,$categories_id,$user_id){
            $stmt=$this->pdo->prepare('INSERT INTO incomes(montantIn,descriptionIn,dateIn,category_id,user_id)VALUES(?,?,?,?,?)');
            $stmt->execute([$MontantIn,$descreptionIn,$dateIn,$categories_id,$user_id]);
        
        }
            public function deletIn($id){
            $stmt=$this->pdo->prepare('DELETE FROM incomes WHERE id=?');
            $stmt->execute([$id]);
            header('Location: dashbord.php');
            exit;
        
        }
        
        public function updateIn($MontantIn,$descreptionIn,$dateIn,$id){
            $stmt=$this->pdo->prepare('UPDATE incomes SET montantIn = ?,  descriptionIn = ?,  dateIn = ? WHERE id = ?');
            $stmt->execute([$MontantIn,$descreptionIn,$dateIn,$id]);
        
        }
        public function  getTotalIncomes($user_id){
        $stmt = $this->pdo->prepare("SELECT SUM(montantIn) as total FROM incomes WHERE user_id=?");
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total']?? 0;
        }
        public function affichageIn($user_id){
            $stmt=$this->pdo->prepare("SELECT * FROM incomes  WHERE user_id=?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function affichageInMd($id){
            $stmt=$this->pdo->prepare("SELECT * FROM incomes  WHERE id=?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

}
?>
 