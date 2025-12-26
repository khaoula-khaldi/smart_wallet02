<?php
require_once 'classUsers.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center text-gray-800 bg-purple-100">

    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">
        
        <!-- Title -->
        <h1 class="text-2xl font-bold text-center text-indigo-600 mb-6">
            Ajouter une catégorie
        </h1>

        <!-- Form -->
        <form method="POST" action="">
            
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">
                    Nom de la catégorie
                </label>
                <input 
                    type="text" 
                    name="nom"
                    placeholder="Ex : Alimentation"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">
                    type de catregories
                </label>
                <select name="type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="revenu">revenu</option>
                    <option value="despenses">despenses</option>
                </select>

            </div>

            <div class="ml-[8rem]">
                <button 
                    type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
            </div>
        </form>
        
    <a href="dashbord.php" class="block text-center text-sm text-gray-600 mt-3">
        ← Retour au tableau de bord
    </a>
    </div>

</body>
</html>


<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nom=$_POST['nom'];
    $user_id=$_SESSION['user_id'];
    $type_categories=$_POST['type'];
    if($type_categories==="revenu"){
        $categorise=new categoriesEx($pdo);
        $categorise->create($nom,$user_id);
    }else{
        $categorise=new categoriesIn($pdo);
        $categorise->create($nom,$user_id);
    }

}
?>