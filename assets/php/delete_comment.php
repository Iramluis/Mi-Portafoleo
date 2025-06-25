<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM comentarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../../index.html#comentarios");
        exit();
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../index.html#comentarios");
    exit();
}
?>