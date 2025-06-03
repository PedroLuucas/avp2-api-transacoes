<?php

namespace App\Models;

use PDO;
use PDOException;

class Transacao
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function criar(array $data): void
    {
        $sql = "INSERT INTO transacoes (id, valor, dataHora) VALUES (:id, :valor, :dataHora)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $data['id'],
            ':valor' => $data['valor'],
            ':dataHora' => $data['dataHora'],
        ]);
    }

    public function buscarPorId(string $id): ?array
    {
        $sql = "SELECT * FROM transacoes WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function apagarTudo(): void
    {
        $this->db->exec("DELETE FROM transacoes");
    }

    public function apagarPorId(string $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM transacoes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function transacoesUltimoMinuto(): array
    {
        $sql = "SELECT valor FROM transacoes WHERE dataHora >= NOW() - INTERVAL 60 SECOND";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
