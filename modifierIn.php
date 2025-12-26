<?php 
include 'classUsers.php';
$user_id=$_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $idIn=$_POST['idIn'];
    $incomes = new Incomes($pdo);
    $row = $incomes->affichageInMd($idIn);
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

        <form action="modifierIn.php" method="POST" class="space-y-4">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Montant</label>
                <input type="text" name="MontantIn" value="<?php echo $row['montantIn']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Description</label>
                <input type="text" name="descriptionIn" value="<?php echo $row['descriptionIn']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Date</label>
                <input type="date" name="dateIn" value="<?php echo $row['dateIn']; ?>"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" name="update_incomes"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Enregistrer
            </button>

        </form>

    </div>

</body>
</html>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_incomes'])) {
    $id = $_POST['id'] ?? '';
    $MontantIn = $_POST['MontantIn'] ?? '';
    $descriptionIn = $_POST['descriptionIn'] ?? '';
    $dateIn = $_POST['dateIn'] ?? '';

    $incomes->updateIn( $MontantIn, $descriptionIn, $dateIn,$id);
    header('Location: dashbord.php');
    exit;
}


?>