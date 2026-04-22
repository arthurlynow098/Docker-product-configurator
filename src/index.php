<?php
$host = 'db'; // O nome do serviço no docker-compose
$user = 'devuser';
$pass = 'devpassword';
$db = 'configurador_db';

echo "<h1>Configurador de Produtos - Ambiente Docker</h1>";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("<p style='color:red;'>Erro de conexão com o banco de dados: " . $conn->connect_error . "</p>");
} else {
    echo "<p style='color:green;'>Conexão com o banco de dados MySQL estabelecida com sucesso!</p>";
}
?>
