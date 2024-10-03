<?php
session_start();
include('db_connection.php');

$winner_id = $_POST['winner_id'];
$loser_id = $_POST['loser_id'];

// Atualizar pontos
$updateWinner = $conn->prepare("UPDATE users SET points = points + 10 WHERE id = ?");
$updateWinner->bind_param("i", $winner_id);
$updateWinner->execute();

$updateLoser = $conn->prepare("UPDATE users SET points = points - 10 WHERE id = ?");
$updateLoser->bind_param("i", $loser_id);
$updateLoser->execute();

// Marcar jogo como finalizado
$updateGame = $conn->prepare("UPDATE games SET status = 'finished', winner = ? WHERE (player1_id = ? OR player2_id = ?) AND status = 'ongoing'");
$updateGame->bind_param("iii", $winner_id, $winner_id, $loser_id);
$updateGame->execute();

echo "Game finished.";
?>
