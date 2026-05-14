<?php
class Guest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($name, $age, $faculty, $personal_trainer, $time_of_visits) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO guests (name, email, age, personal_trainer, time_of_visits) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $email, $age, $personal_trainer, $time_of_visits]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM guests");
        return $stmt->fetchAll();
    }

    public function update($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE guests SET name=? WHERE id=?");
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM guests WHERE id=?");
        $stmt->execute([$id]);
    }
}
