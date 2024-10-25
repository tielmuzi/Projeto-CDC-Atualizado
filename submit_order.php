<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Realizar Pedidos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton:wght@400&display=swap" />
    <link rel="stylesheet" href="realizar_pedido.css" />
</head>
<body>
    <div class="container">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pedidos";

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name']; // Nome
    $telefone = $_POST['phone']; // Telefone
    $endereco = $_POST['address']; // Endereço
    $pagamento = $_POST['payment']; // Forma de Pagamento
    
    // Aqui, garante que $refeicao sempre seja um array, mesmo que tenha apenas uma opção
    $refeicao = isset($_POST['meal']) ? $_POST['meal'] : [];
    $refeicaoString = implode(", ", $refeicao); // Converte o array em uma string
    
    $bebida = $_POST['drink']; // Bebida
    $observacoes = $_POST['observations']; // Observações

    // Usando prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO pedidos (nome, telefone, endereco, pagamento, refeicao, bebida, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nome, $telefone, $endereco, $pagamento, $refeicaoString, $bebida, $observacoes);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Pedido realizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
} else {
    echo "Nenhum dado recebido.";
}

// Fecha a conexão
$conn->close();
?>
