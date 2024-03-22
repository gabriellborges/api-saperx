<?php
include 'crud.php';

$crud = new CRUD();

$contatos = $crud->getUsers();

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])){
    $crud->create($_POST);
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $crud->getUsers();
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update'){
    $crud->update($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['dataNascimento'], $_POST['cpf'], $_POST['telefones']);
}
if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $crud->delete($_DELETE['id']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Telefônica</title>
</head>
<body>
    <h1>Agenda Telefônica</h1>

    <h2>Lista de Contatos</h2>
    <ul>
        <?php foreach ($contatos as $contato): ?>
            <li><?php echo $contato['nome']; ?> - <?php echo $contato['telefones']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Adicionar Novo Contato</h2>
    <form action="adicionar_contato.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <button type="submit">Adicionar Contato</button>
    </form>
</body>
</html>