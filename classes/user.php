<?php
require_once __DIR__ . "/../config/Database.php";

class User {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByEmail(string $email) {
        $stm = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email AND etat = 'active'"
        );
        $stm->execute(['email' => $email]);
        return $stm->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getAll(){
        $stm = $this->db->query("select * from users");
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id){
        $stm = $this->db->prepare("select * from users where id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function delete(int $id){
        $stm = $this->db->prepare("delete from users where id = ?");
        return $stm->execute([$id]);
    }

    public function create(string $nom,string $prenom,string $email,string $password,string $role) {
        $stm = $this->db->prepare("
            INSERT INTO users (nom, prenom, email, mdpss, roleUser)
            VALUES (?, ?, ?, ?, ?)");

        return $stm->execute([$nom,$prenom,$email,password_hash($password, PASSWORD_BCRYPT),$role]);
    }

    public function update(int $id,string $nom,string $prenom,string $email,string $role){
        $stm = $this->db->prepare("update users set nom = ? , prenom = ? , email = ? , roleUser = ? where id = ?");
        return $stm->execute([$nom , $prenom , $email , $role , $id]);
    }

    public function updateEtat(int $id, string $etat){
        $stm = $this->db->prepare("Update users set etat = ? where id = ?");
        return $stm->execute([$etat , $id]);
    }
}
