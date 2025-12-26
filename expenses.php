<?php
require_once 'classUsers.php';
$user_id=$_SESSION['user_id'];

$categoriesObj = new categoriesEx($pdo);
$categories = $categoriesObj->select($user_id);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="js.js"></script>
    <title>despenses</title>
</head>
<body class=" flex flex-col gap-5 font-sans text-gray-800 bg-purple-100">
       <nav class="w-full shadow-md p-4 mb-6 bg-purple-200">
        <h1 class="text-center text-2xl font-bold text-gray-800">Gestion Financière</h1>
        <p>Bonjour <?php echo $_SESSION['user_nom'];?> </p>
      </nav>
        <div class="w-[100%] bg-green-100 border border-gray-200 rounded-xl p-4 shadow-sm flex flex-row justify-between ">
          <h2 class="text-lg font-bold text-gray-700 ">Menu</h2>
          <ul class=" flex flex-row  gap-10">
            <li class="hover:bg-pink-100 transition p-2 rounded cursor-pointer"><a href="dashbord.php">Tableau de bord</a></li>
            <li class="hover:bg-pink-100 transition p-2 rounded cursor-pointer"><a href="categories.php">Ajouter categories</a></li>
            <li class="hover:bg-pink-100 transition p-2 rounded cursor-pointer"><a href="incomes.php">Revenu</a></li>
            <li class="hover:bg-pink-100 transition p-2 rounded cursor-pointer"><a href="expenses.php">Dépenses</a></li>
            <li class="relative">
            <li class="hover:bg-gray-100 p-2"><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
        </div>
    <section class="border border-gray-200 p-4 rounded-xl shadow-sm bg-blue-100">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Dépenses</h2>
        
          <form method="POST" class="flex flex-col gap-3">
                <div class="flex gap-3">
                  <input type="number" step="0.01" name="MontantEx" placeholder="Montant" class="border border-gray-300 p-2 rounded w-1/4">
                  <input type="text" name="descreptionEx" placeholder="Description" class="border border-gray-300 p-2 rounded flex-1">
                  <input type="date" name="dateEx" class="border border-gray-300 p-2 rounded w-1/4">
                </div> 
                <div class="flex gap-3">
                       <select name="categories" class="border border-gray-300 p-2 rounded w-1/2" required>
                            <option value="">Ajouter une categorie</option>
                            <?php 
                               foreach($categories as $c){
                                echo '<option value="'.$c['id'].'">'.$c['nom'].'</option>';
                               }
                            ?>
                        </select>
                </div>
            <button name="ajouter_depenses" class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded shadow">Ajouter</button>
         
          </form>
         
    </section>
</body>
</html>

<?php 

 if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $MontantEx=$_POST['MontantEx'];
        $descreptionEx=$_POST['descreptionEx'];
        $dateEx=$_POST['dateEx'];
        $category_id = $_POST['categories'];

        $expenses=new expenses($pdo);
        $expenses->createEx($MontantEx,$descreptionEx,$dateEx,$category_id,$user_id);

      }

?>

     