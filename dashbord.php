<?php
    require_once 'classUsers.php';
    if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}
$user_id=$_SESSION['user_id'];

$afficahgeExObj=new expenses ($pdo);
$rowEx=$afficahgeExObj->affichageEx($user_id);

$afficahgeExObj=new incomes ($pdo);
$rowIn=$afficahgeExObj->affichageIn($user_id);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
    <title>dashbord</title>
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
            <li class="hover:bg-gray-100 p-2"><a href="deconnexion.php">Déconnexion</a></li>
            <li class="relative">
          </ul>
        </div>

        <main class="flex-1 space-y-8">
        <section class="flex gap-4">
          <div class="flex-1 p-4 bg-blue-400 rounded-xl shadow-sm">
            <p class="font-semibold text-white">Revenu totales </p>
            <p class="text-2xl font-bold mt-2 text-white"> <?php  $totalIn=new incomes($pdo);
                                                                  $montantTotalIn=$totalIn->getTotalIncomes($_SESSION['user_id']);
                                                                  echo $montantTotalIn ;  ?> DH</p>
          </div>
          <div class="flex-1 p-4 bg-green-400 rounded-xl shadow-sm">
            <p class="font-semibold text-white">Dépenses totales</p>
            <p class="text-2xl font-bold mt-2 text-white"> <?php  $totalEx=new expenses($pdo);
                                                                  $montantTotalEx=$totalEx->getTotalExpenses($_SESSION['user_id']);
                                                                  echo $montantTotalEx ;  ?> DH</p>
            </div>
          <div class="flex-1 p-4 bg-purple-400 rounded-xl shadow-sm">
            <p class="font-semibold text-gray-700">Solde</p>
            <p class="text-2xl font-bold mt-2 text-gray-700">  <?php $solde = $montantTotalIn - $montantTotalEx;
                                                                      echo $solde;  ?> DH</p>
          </div>
        </section>
      </main>

          <section class="border border-gray-300 rounded-xl shadow-sm bg-blue-100 p-4">
            <div class="flex flex-row gap-[83rem]">
          <h2 class="text-xl font-bold text-gray-700 mb-4">revenu</h2>
           <select name="type" class=" font-bold text-gray-700  border-gray-300 rounded-xl shadow-sm bg-blue-100 p-4">
            <option value="revenu">revenu</option>

          </select></div>

          <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 border-b border-gray-300">
              <tr>
                <th class="p-2 border-r border-gray-300">Montant</th>
                <th class="p-2 border-r border-gray-300">Description</th>
                <th class="p-2 border-r border-gray-300">Date</th>
                <th class="p-2">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
        
                  foreach($rowIn as $aff){
                             echo"<tr> <td class=\"p-2 border-r border-gray-300\">{$aff['montantIn']}</td>
                              <td class=\"p-2 border-r border-gray-300\">{$aff['descriptionIn']}</td>
                              <td class=\"p-2 border-r border-gray-300\">{$aff['dateIn']}</td>
                              <td class=\"p-2\"> 
                              <div class=\" flex flex-row gap-2\">
                              <form action=\"modifierIn.php\" method=\"POST\">
                              <input name=\"idIn\" type=\"text\" class=\"hidden\" value=\"{$aff['id']}\"/>
                              <button type=\"submit\" name=\"modifier_incomes\" class=\"bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 mr-2\">Modifier</button>
                              </form>

                              <form action=\"supprime.php\" method=\"POST\">
                              <input name=\"idIn\" type=\"text\" class=\"hidden\" value=\"{$aff['id']}\"/>
                              <button name=\"delete_incomes\" class=\"bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600\">Supprimer</button>
                              </form>
                              </div>
                              </td>
                              </tr>";
                  }

                ?>              
            </tbody>
          </table>
        </section>


        <section class="border border-gray-300 rounded-xl shadow-sm bg-blue-100 p-4">
            <div class="flex flex-row gap-[80rem]">
          <h2 class="text-xl font-bold text-gray-700 mb-4">Expenses</h2>
           <select name="type" class=" font-bold text-gray-700  border-gray-300 rounded-xl shadow-sm bg-blue-100 p-4">
            <option value="Expenses">Expenses</option>

          </select></div>

          <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 border-b border-gray-300">
              <tr>
                <th class="p-2 border-r border-gray-300">Montant</th>
                <th class="p-2 border-r border-gray-300">Description</th>
                <th class="p-2 border-r border-gray-300">Date</th>
                <th class="p-2">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
        
                  foreach($rowEx as $aff){
                             echo"<tr> <td class=\"p-2 border-r border-gray-300\">{$aff['montantEx']}</td>
                              <td class=\"p-2 border-r border-gray-300\">{$aff['descriptionEx']}</td>
                              <td class=\"p-2 border-r border-gray-300\">{$aff['dateEx']}</td>
                              <td class=\"p-2\"> 
                              <div class=\" flex flex-row gap-2\">
                              <form action=\"modifierEx.php\" method=\"POST\">
                              <input name=\"              \" type=\"text\" class=\"hidden\" value=\"{$aff['id']}\"/>
                              <button type=\"submit\" name=\"modifier_incomes\" class=\"bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 mr-2\">Modifier</button>
                              </form>

                              <form action=\"supprime.php\" method=\"POST\"> 
                              <input name=\"idEx\" type=\"text\" class=\"hidden\" value=\"{$aff['id']}\"/>
                              <button name=\"delete_expenses\" class=\"bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600\">Supprimer</button>
                              </form>
                              </div>
                              </td>
                              </tr>";
                  }

                ?>              
            </tbody>
          </table>
        </section>

    <div class=" bg-white p-6 rounded-xl shadow ">

    <h2 class="text-xl font-bold text-center">Incomes vs Expenses</h2>
<?php $incomePercent=$solde > 0 ? ($montantTotalIn / $solde) * 100 : 0; ?>
    <!-- Incomes -->
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="font-semibold text-green-600">Incomes</span>
            <span> <?php echo $montantTotalIn ?>  DH</span>
        </div>
        <div class="w-full bg-gray-200 rounded h-4">
            <div class="bg-green-500 h-4 rounded"
                 style="width: <?php echo $incomePercent ?>%"></div>
        </div>
    </div>
<?php $expensePercent=$solde > 0 ? ($montantTotalEx / $solde) * 100 : 0; ?>
    <!-- Expenses -->
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="font-semibold text-red-600">Expenses</span>
            <span> <?php echo $montantTotalEx ?> DH</span>
        </div>
        <div class="w-full bg-gray-200 rounded h-4">
            <div class="bg-red-500 h-4 rounded"
                 style="width: <?php echo $expensePercent ?>%"></div>
        </div>
    </div>

</div>


       

</body>
</html>