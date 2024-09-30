<?php

namespace App\repositories;

use App\entities\Usuario;
use PDO;

class UsuarioRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): ?Usuario
    {
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }

    public function listAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM usuarios");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'mapToEntity'], $data);
    }

    private function mapToEntity(array $data): Usuario
    {
        $usuario = new Usuario($data['nome'], $data['email'], '');
        $usuario->setId($data['id']);

        var_dump(json_encode($usuario));

        return $usuario;
    }

    public funcion getList(): Usuario
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM usuarios order by deslogin") ;

    }

