<?php

// Chargement des utilisateurs depuis un fichier ou une base de données
include('../users_data.php'); // Correction ici

// Vérification du rôle de l'utilisateur
session_start();
if(isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    header("Location: https://online-corps.com/mon-panel/");
    exit();
} elseif (!isset($_SESSION['role'])) {
    header("Location: https://online-corps.com/connexion/");
    exit();
}

// Fonction pour trier les utilisateurs par rôle et par ordre alphabétique
function sortUsersByRoleAndName($users) {
    $rolesOrder = ['admin2', 'admin', 'user'];
    $sortedUsers = [];

    foreach ($rolesOrder as $role) {
        $filteredUsers = array_filter($users, function($user) use ($role) {
            return $user['role'] === $role;
        });

        uasort($filteredUsers, function($a, $b) {
            return strcmp($a['lastName'], $b['lastName']);
        });

        $sortedUsers = array_merge($sortedUsers, $filteredUsers);
    }

    return $sortedUsers;
}

// Fonction pour afficher la liste des utilisateurs en fonction du rôle et de la recherche
function displayUsers($users, $searchTerm = "") {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nom d'utilisateur</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Nom de company</th>";
    echo "<th>Mail</th>";
    echo "<th>Role utilisateurs</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    // Récupérer le rôle de l'utilisateur connecté
    $connectedUserRole = $_SESSION['role'];

    // Trier les utilisateurs
    $sortedUsers = sortUsersByRoleAndName($users);

    // Parcourir les utilisateurs et afficher uniquement ceux qui correspondent aux règles spécifiées
    foreach ($sortedUsers as $username => $user) {
        // Vérifier les règles pour afficher les utilisateurs
        if (($connectedUserRole == 'admin2' || ($connectedUserRole == 'admin' && !in_array($user['role'], ['admin', 'admin2'])))
            && (empty($searchTerm) || stripos($username, $searchTerm) !== false || stripos($user['firstName'], $searchTerm) !== false || stripos($user['lastName'], $searchTerm) !== false || stripos($user['companyName'], $searchTerm) !== false || stripos($user['email'], $searchTerm) !== false || stripos($user['role'], $searchTerm) !== false)) {
            echo "<tr>";
            echo "<td>".$username."</td>";
            echo "<td>".$user['firstName']."</td>";
            echo "<td>".$user['lastName']."</td>";
            echo "<td>".$user['companyName']."</td>";
            echo "<td>".$user['email']."</td>";
            echo "<td>".$user['role']."</td>";
            echo "<td><a href='/admin/edit_user.php?username=".$username."'>Modifier</a> | <a href='/admin/delete_user.php?username=".$username."'>Supprimer</a></td>";
            echo "</tr>";
        }
    }

    echo "</table>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        // Fonction pour effectuer la recherche automatique
        function searchUsers() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementsByTagName("table")[0];
            var tr = table.getElementsByTagName("tr");

            for (var i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td");
                var found = false;
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        var txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
</head>
<body>

<h1>Liste des utilisateurs</h1>

<form method="get" action="">
    <label>Rechercher un utilisateur:</label>
    <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="Nom d'utilisateur, Nom, Prénom, Nom de company, Mail, Rôle">
</form>

<?php
// Afficher la liste des utilisateurs en fonction du rôle et de la recherche
if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    displayUsers($users, $searchTerm);
} else {
    displayUsers($users);
}
?>

<a href="/admin/add_user.php">Ajouter un nouvel utilisateur</a>

</body>
</html>
