<?php 
include 'classUsers.php';
$user_id=$_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $idEx=$_POST['idEx'];
    $expenses = new expenses($pdo);
    $row = $expenses->affichageExMD($idEx);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier despenses</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen bg-purple-100 p-4">

    <div class="w-full max-w-lg p-6 rounded-xl shadow-lg border bg-blue-100">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
            Modifier despenses
        </h2>

        <form action="modifierEx.php" method="POST" class="space-y-4">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Montant</label>
                <input type="text" name="MontantEx" value="<?php echo $row['montantEx']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Description</label>
                <input type="text" name="descriptionEx" value="<?php echo $row['descriptionEx']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Date</label>
                <input type="date" name="dateEx" value="<?php echo $row['dateEx']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" name="update_Expenses"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Enregistrer
            </button>

        </form>

    </div>

</body>
</html>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_Expenses'])) {
    $id = $_POST['id'] ?? '';
    $MontantEx = $_POST['MontantEx'] ?? '';
    $descriptionEx = $_POST['descriptionEx'] ?? '';
    $dateEx = $_POST['dateEx'] ?? '';

    $expenses->updateEx($id,$MontantEx, $descriptionEx, $dateEx);
    header('Location: dashbord.php');
    exit;
}


?>