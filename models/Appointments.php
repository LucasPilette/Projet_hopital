<?php

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

class Appointments {

    //ATTRIBUTS

    private int $_id;
    private string $_dateHour;
    private int $_idPatients;
    private object $_pdo;

    public function __construct(string $dateHour = '', int $idPatients = 0){
        $this->_dateHour = $dateHour;
        $this->_idPatients = $idPatients;
        $this->_pdo = DataBase::dbConnect();
    }

    /**
     * GETTER ID
     * @return int
     */

    public function getId():int{
        return $this->_id;
    }

    /**
     * GETTER dateHour
     * @return string
     */

    public function getdateHour():string{
        return $this->_dateHour;
    }


    /**
     * GETTER id user
     * @return int
     */

    public function getidPatients():int{
        return $this->_idPatients;
    }

    /**
     * SETTER pour l'attribut privé _id
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id):void{
        $this->_id = $id;
    }

    /**
     * SETTER pour l'attribut privé _dateHour
     * @param string $dateHour
     * 
     * @return void
     */
    public function setdateHour(string $dateHour):void{
        $this->_dateHour = $dateHour;
    }

    /**
     * SETTER pour l'attribut privé _idPatients
     * @param int $idPatients
     * 
     * @return void
     */
    public function setidPatients(int $idPatients):void{
        $this->_idPatients = $idPatients;
    }

        /**
     * Création de la méthode add visant à ajouter un patient à la base de donnée
     * @return bool
     */
    
    public function add():bool{
        try{
            $sth = $this->_pdo->prepare('INSERT INTO appointments (dateHour,idPatients) VALUES (:dateHour,:idPatients)');
            $sth->bindValue(':dateHour', $this->getdateHour(), PDO::PARAM_STR);
            $sth->bindValue(':idPatients', $this->getidPatients(), PDO::PARAM_STR);
            return $sth->execute();
        } catch (PDOException $e){
            return false;
        }
    }

    /**
     * Création de la méthode getAll visant à sélectionner tous les patients de la table patients
     * @param mixed $pdo
     * 
     */
    public function getAll(){
        $sql = 
        'SELECT appointments.id AS appointmentsId, appointments.dateHour AS hour, patients.id AS patientsId, patients.lastname AS lastname, patients.firstname AS firstname,
        patients.mail AS mail
        FROM appointments
        JOIN patients
        ON appointments.idPatients = patients.id
        ORDER BY appointments.id
        ';
        $sth = $this->_pdo->prepare($sql);
        $sth ->execute();
        $appointments = $sth->fetchAll(); 
        return $appointments;
    }


    /**
     * @param mixed $pdo
     * @param int $id
     * 
     * @return [type]
     */
    public function getOne($id){
        $sql = 
        'SELECT appointments.id AS appointmentsId, appointments.dateHour AS hour, patients.id AS patientsId, patients.lastname AS lastname, patients.firstname AS firstname,
        patients.mail AS mail
        FROM appointments
        JOIN patients
        ON appointments.idPatients = patients.id
        WHERE appointments.id = :id
        ';
        $sth = $this->_pdo->prepare($sql);
        $sth->bindValue(':id',$id, PDO::PARAM_INT);
        $sth ->execute();
        $patients = $sth->fetch(); 
        return $patients;
    }

    public function modifyOne($id){
        $sth = $this->_pdo->prepare(
            'UPDATE appointments  
            SET dateHour = :dateHour, idPatients = :idPatients
            WHERE id = :id');
        $sth->bindValue(':dateHour', $this->getdateHour(), PDO::PARAM_STR);
        $sth->bindValue(':idPatients', $this->getidPatients(), PDO::PARAM_STR);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth ->execute();
        $patients = $sth->fetch(); 
        return $patients;
    }
}