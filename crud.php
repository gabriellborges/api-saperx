<?php
include 'connection.php';

class CRUD
{
    public function create()
    {
        $connection = Connection::getConnection();
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $dataNascimento = $_POST['dataNascimento'];
        $cpf = $_POST['cpf'];
        $telefones = $_POST['telefones'];
        if (isset($connection)) {
            $sql = "SELECT * FROM contatos WHERE nome = :nome OR telefones = :telefones";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefones', $telefones);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "Contato: " . $row['nome'] . " já cadastrado!";
                return;
            } else {
                $sql = "INSERT INTO contatos (nome, email, dataNascimento, cpf, telefones) VALUES (:nome, :email, :dataNascimento, :cpf, :telefones)";

                $stmt = $connection->prepare($sql);

                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':dataNascimento', $dataNascimento);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':telefones', $telefones);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "Contato salvo com sucesso!";
                    return $nome;
                } else {
                    echo "Erro ao inserir contato: " . $stmt->errorInfo()[2];
                }
            }
        } else {
            echo "Problema no servidor!";
        }
    }
    public function getUsers()
    {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM contatos";

        if (isset($connection)) {
            $stmt = $connection->prepare($sql);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "Nenhum usuário cadastrado!";
            }
        } else {
            echo "Problemas no servidor!";
        }
        return $resultados;
    }
    public function update()
    {
        $connection = Connection::getConnection();
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $dataNascimento = $_POST['dataNascimento'];
        $cpf = $_POST['cpf'];
        $telefones = $_POST['telefones'];

        if (isset($connection)) {
            $sql = "SELECT * FROM contatos WHERE nome = :nome";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Esse nome já está sendo utilizado!";
                return;
            } else {
                $sql = "UPDATE contatos SET nome = :nome, email = :email, dataNascimento = :dataNascimento, cpf = :cpf, telefones = :telefones WHERE id = :id";

                $stmt = $connection->prepare($sql);

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':dataNascimento', $dataNascimento);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':telefones', $telefones);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "Registro atualizado com sucesso!";
                } else {
                    echo "Contato não encontrado! ";
                }
            }
        } else {
            echo "Problema no servidor!";
        }
    }

    public function delete()
    {
        $connection = Connection::getConnection();
        $id = $_GET['id'];

        if (isset($connection)) {
            $sql = "DELETE FROM contatos WHERE id = :id";

            $stmt = $connection->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Contato excluído com sucesso!";
            } else {
                echo "Contato não encontrado!";
            }
        } else {
            echo "Problema no servidor!";
        }
    }
}