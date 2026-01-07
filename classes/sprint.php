<?php
require_once  "../config/Database.php";

class Sprint {
    private PDO $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getByProjet(int $idProjet){
        $stm = $this->db->prepare(
            "SELECT * FROM sprint WHERE idProjet = ?"
        );
        $stm->execute([$idProjet]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nom,$dd,$df,$idProjet){
        $stm = $this->db->prepare("
            INSERT INTO sprint (nom, date_debut, date_fin, idProjet)
            VALUES (?, ?, ?, ?)
        ");
        return $stm->execute([$nom,$dd,$df,$idProjet]);
    }

    public function delete(int $id){
        $stm = $this->db->prepare("DELETE FROM sprint WHERE id = ?");
        return $stm->execute([$id]);
    }

    public function updateEtat(int $id, string $etat){
        $stm = $this->db->prepare(
            "UPDATE sprint SET etat = ? WHERE id = ?"
        );
        return $stm->execute([$etat,$id]);
    }
}
