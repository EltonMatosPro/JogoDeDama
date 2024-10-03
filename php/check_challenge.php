<?php
session_start();
include('db_connection.php');

$user_id = $_SESSION['user_id'];

// Verificar se o usuário foi desafiado
$stmt = $conn->prepare("SELECT * FROM games WHERE (player1_id = ? OR player2_id = ?) AND status = 'waiting'");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Alterar o status para "ongoing"
    $update = $conn->prepare("UPDATE games SET status = 'ongoing' WHERE (player1_id = ? OR player2_id = ?)");
    $update->bind_param("ii", $user_id, $user_id);
    $update->execute();
    
    echo "start_game";
} else {
    echo "no_game";
}
?>
