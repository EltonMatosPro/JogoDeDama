<?php
session_start();
include('php/db_connection.php');

// Verificar se o jogador está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Verificar se o jogo está ativo
$user_id = $_SESSION['user_id'];
$gameQuery = $conn->prepare("SELECT * FROM games WHERE (player1_id = ? OR player2_id = ?) AND status = 'ongoing'");
$gameQuery->bind_param("ii", $user_id, $user_id);
$gameQuery->execute();
$game = $gameQuery->get_result()->fetch_assoc();

if (!$game) {
    echo "No active game.";
    exit;
}

$player_color = ($game['player1_id'] == $user_id) ? 'black' : 'white';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkers Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="game-container">
        <h2>Checkers</h2>
        <div id="game-board"></div>
        <p>You are playing as: <strong><?= $player_color ?></strong></p>
    </div>

    <script src="js/game.js"></script>
    <script>
        var playerColor = "<?= $player_color ?>";
    </script>
</body>
</html>
