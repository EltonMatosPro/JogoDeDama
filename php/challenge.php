<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player1_id = $_SESSION['user_id'];
    $player2_id = $_POST['player_id'];

    // Verificar se o jogador já está em um jogo
    $checkGame = $conn->prepare("SELECT * FROM games WHERE (player1_id = ? OR player2_id = ?) AND status = 'ongoing'");
    $checkGame->bind_param("ii", $player1_id, $player1_id);
    $checkGame->execute();
    $result = $checkGame->get_result();

    if ($result->num_rows > 0) {
        echo "You are already in a game.";
        exit;
    }

    // Criar um novo jogo
    $stmt = $conn->prepare("INSERT INTO games (player1_id, player2_id, status) VALUES (?, ?, 'waiting')");
    $stmt->bind_param("ii", $player1_id, $player2_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Challenge sent!";
    } else {
        echo "Error creating the challenge.";
    }
}
?>
