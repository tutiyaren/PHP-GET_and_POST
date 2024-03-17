<?php
namespace App;
use PDO;

interface ElementInterface
{
    public function getElements(): array; 
    public function addElements(string $name): void;
    public function searchElements(string $keyword): array;
}

abstract class AbstractElements implements ElementInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Elements extends AbstractElements
{
    public function getElements(): array
    {
        $smt = $this->pdo->query("SELECT * FROM elements");
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addElements(string $name): void 
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");

        $stmt = $this->pdo->prepare("INSERT INTO elements(name, created_at) VALUES (:name, :created_at)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":created_at", $created_at);
        $stmt->execute();
    }

    public function searchElements(string $keyword): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM elements WHERE name LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}