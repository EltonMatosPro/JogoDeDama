<?php
session_start();
include('php/db_connection.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Buscar jogadores online
$online_players = $conn->query("SELECT id, username FROM users WHERE id != $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkers - Players Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="game-container">
        <h2>Players Online</h2>
        <ul id="players-list">
            <?php while ($player = $online_players->fetch_assoc()): ?>
                <li>
                    <?= $player['username'] ?>
                    <button onclick="challengePlayer(<?= $player['id'] ?>)">Challenge</button>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    
    <script src="js/ajax.js"></script>
    <script>
        function challengePlayer(playerId) {
            // AJAX para desafiar um jogador
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/challenge.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.send("player_id=" + playerId);
        }
    </script>
</body>
</html>
