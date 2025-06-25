<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM comentarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Comentario</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2 class="mb-4">Editar Comentario</h2>
                        <form action="update_comment_process.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="mb-3">
                                <label for="nombreyapellido" class="form-label">Nombre y Apellido</label>
                                <input type="text" class="form-control" id="nombreyapellido" name="nombreyapellido" 
                                       value="<?php echo htmlspecialchars($row['nombreyapellido']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" 
                                       value="<?php echo htmlspecialchars($row['usuario']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($row['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nota" class="form-label">Comentario</label>
                                <textarea class="form-control" id="nota" name="nota" rows="3" required><?php 
                                    echo htmlspecialchars($row['nota']); 
                                ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="../../index.html#comentarios" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        header("Location: ../../index.html#comentarios");
        exit();
    }
    
    $stmt->close();
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'db_connection.php';
    
    $id = $_POST['id'];
    $nombreyapellido = $_POST['nombreyapellido'];
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    
    $sql = "UPDATE comentarios SET nombreyapellido=?, usuario=?, email=?, nota=? WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombreyapellido, $usuario, $email, $nota, $id);
    
    if ($stmt->execute()) {
        header("Location: ../../index.html#comentarios");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../index.html#comentarios");
    exit();
}
?>