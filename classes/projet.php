<?php
require_once __DIR__ . "/../config/Database.php";

class Projet {
    private PDO $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getAll(){
        $stm = $this->db->query("
            SELECT p.*, u.nom, u.prenom 
            FROM projet p
            JOIN users u ON p.idUser = u.id
        ");
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(
        string $titre,
        string $description,
        string $dateDebut,
        string $dateFin,
        int $idUser
    ){
        $stm = $this->db->prepare("
            INSERT INTO projet (titre, descriptionP, date_debut, date_fin, idUser)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stm->execute([
            $titre,
            $description,
            $dateDebut,
            $dateFin,
            $idUser
        ]);
    }

    public function findById(int $id){
        $stm = $this->db->prepare("SELECT * FROM projet WHERE id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateEtat(int $id, string $etat){
        $stm = $this->db->prepare("UPDATE projet SET etat = ? WHERE id = ?");
        return $stm->execute([$etat, $id]);
    }

    public function delete(int $id){
        $stm = $this->db->prepare("DELETE FROM projet WHERE id = ?");
        return $stm->execute([$id]);
    }
}
