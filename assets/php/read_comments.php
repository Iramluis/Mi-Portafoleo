<?php
include 'db_connection.php';

$sql = "SELECT * FROM comentarios ORDER BY fechanota DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="card mb-3">';
        echo '  <div class="card-body">';
        echo '    <div class="d-flex justify-content-between align-items-center mb-2">';
        echo '      <h5 class="card-title mb-0">' . htmlspecialchars($row['nombreyapellido']) . '</h5>';
        echo '      <small class="text-muted">' . date('d/m/Y H:i', strtotime($row['fechanota'])) . '</small>';
        echo '    </div>';
        if (!empty($row['usuario'])) {
            echo '    <h6 class="card-subtitle mb-2 text-muted">@' . htmlspecialchars($row['usuario']) . '</h6>';
        }
        echo '    <p class="card-text">' . nl2br(htmlspecialchars($row['nota'])) . '</p>';
        echo '    <div class="d-flex justify-content-end gap-2">';
        echo '      <a href="assets/php/update_comment.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-primary">Editar</a>';
        echo '      <a href="assets/php/delete_comment.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-danger">Eliminar</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-muted">No hay comentarios aún. ¡Sé el primero en comentar!</p>';
}

$conn->close();
?>