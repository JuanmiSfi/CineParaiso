<?
$fila = mysqli_fetch_assoc($consult);
$movieId = $fila['id_pelicula'];
$usuarioId = $fila['id_usuario'];
$usuario = $fila['usuario'];
$fto = $fila['fto_perfil'];
$nota = $fila['nota'];
$review = $fila['review'];
$fecha = $fila['fecha'];
if (!empty($review)) {
    echo "<div class='opinion'>";
    echo "<div class=info>";
    echo "<a href='/usuario.php?id=" . $usuarioId . "'>";
    echo "<img src='$fto' alt='' />";
    echo "</a>";
    echo "<div class='user'>";
    echo "<h2>$usuario</h2>";
    echo "<div class='estrellas'>";
    for ($j = 1; $j <= 5; $j++) {
        if ($nota >= $j) {
            echo "<i class='fas fa-star' id='estrellas'></i>";
        }
    }
    echo "<div class='fecha'>";
    if (!empty($fecha)) {
        $fechaconformato = date("d-m-Y", strtotime($fecha));
        echo "Visto el $fechaconformato";
    }
    echo "</div>"; // cierra user
    echo "</div>"; // Cierra fecha
    echo "</div>"; // cierra info
    echo "</div>"; // Cierra estrllas
    echo "<p>$review</p>";
    echo "</div>"; // Cierra opinion
}
