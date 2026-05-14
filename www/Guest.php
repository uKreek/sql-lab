<?php
class Guest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($username, $email, $age, $tariff, $personal_trainer, $time_of_visits) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO guests (username, email, age, tariff, personal_trainer, time_of_visits) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$username, $email, $age, $tariff, $personal_trainer, $time_of_visits]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM guests");
        return $stmt->fetchAll();
    }

    public function update($id, $username) {
        $stmt = $this->pdo->prepare("UPDATE guests SET username=? WHERE id=?");
        $stmt->execute([$username, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM guests WHERE id=?");
        $stmt->execute([$id]);
    }
}
