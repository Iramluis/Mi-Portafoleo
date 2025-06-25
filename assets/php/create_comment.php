<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreyapellido = $_POST['nombreyapellido'];
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    $fechanota = date('Y-m-d H:i:s'); 
    
    $sql = "INSERT INTO comentarios (nombreyapellido, usuario, email, nota, fechanota)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombreyapellido, $usuario, $email, $nota, $fechanota);
    
    if ($stmt->execute()) {
        header("Location: ../../index.html#comentarios");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>