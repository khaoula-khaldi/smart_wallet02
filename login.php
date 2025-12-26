<?php
require_once 'classUsers.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen bg-purple-100">

    <form action="login.php" method="POST" class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">connexion</h2>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email :</label>
            <input type="email" name="email" required
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Mot de passe :</label>
            <input type="password" name="password" required
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-200">S'inscrire</button>

        <p class="text-center text-gray-500 text-sm mt-4">Vous avez pas un compte ? <a href="inscrire.php" class="text-blue-500 hover:underline">inscrire</a></p>
    </form>

</body>
</html>

<?php
$user=new Users($pdo);
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $email=$_POST['email'];
        $password=$_POST['password'];

        $user->login($email,$password);
    }
    
?>


