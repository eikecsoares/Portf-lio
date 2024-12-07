<?php
// Defina suas credenciais de banco de dados
$host = 'localhost';
$dbname = 'feedbacks';
$username = 'root';
$password = '';

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Inserir os dados no banco
    $stmt = $pdo->prepare("INSERT INTO feedbacks (email, feedback) VALUES (?, ?)");
    if ($stmt->execute([$email, $feedback])) {
        echo 'success';
    } else {
        echo 'Erro ao inserir no banco de dados';
    }
}
?>