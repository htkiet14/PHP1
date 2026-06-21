<?php
class User {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

public function getAllUsers(){

    $stmt = $this->pdo->prepare(
        "SELECT * FROM users"
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO users (username, email, password, fullname, phone, address, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['username'],
            $data['email'],
            $data['password'],
            $data['fullname'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['role'] ?? 'user'
        ]);
    }

    public function update($id, $data) {
        // Cập nhật thông tin (tuỳ chỉnh)
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}