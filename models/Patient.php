<?php

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

class Patient {

    // ATTRIBUTS DES PATIENTS

    private int $_id;
    private string $_lastname;
    private string $_firstname;
    private string $_birthDate;
    private string $_phone;
    private string $_mail;
    private object $_pdo;


        /**
     * Création de la méthode magique construct visant à créer un patient
     * @param int $id
     * @param string $lastname
     * @param string $firstname
     * @param string @birthdate
     * @param string @phone
     * @param string @mail
     */

    public function __construct(string $lastname = '', string $firstname = '', string $birthDate = '', string $phone = '', string $mail = ''){
        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthDate = $birthDate;
        $this->_phone = $phone;
        $this->_mail = $mail;
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
     * GETTER lastname
     * @return string
     */

    public function getLastname():string{
        return $this->_lastname;
    }


    /**
     * GETTER firstname
     * @return string
     */

    public function getFirstname():string{
        return $this->_firstname;
    }

    /**
     * GETTER birthdate
     * @return string
     */

    public function getBirthDate():string{
        return $this->_birthDate;
    }

    /**
     * GETTER phone
     * @return string
     */

    public function getPhone():string{
        return $this->_phone;
    }

    /**
     * GETTER mail
     * @return string
     */

    public function getMail():string{
        return $this->_mail;
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
     * SETTER pour l'attribut privé _lastname
     * @param string $lastname
     * 
     * @return void
     */
    public function setLastname(string $lastname):void{
        $this->_lastname = $lastname;
    }

    /**
     * SETTER pour l'attribut privé _firstname
     * @param string $firstname
     * 
     * @return void
     */
    public function setFirstname(string $firstname):void{
        $this->_firstname = $firstname;
    }

    /**
     * SETTER pour l'attribut privé _birthdate
     * @param string $birthDate
     * 
     * @return void
     */
    public function setBirthDate(string $birthDate):void{
        $this->_birthdate = $birthDate;
    }

    /**
     * SETTER pour l'attribut privé _phone
     * @param string $phone
     * 
     * @return void
     */
    public function setPhone(int $phone):void{
        $this->_phone = $phone;
    }

    /**
     * SETTER pour l'attribut privé _mail
     * @param string $mail
     * 
     * @return void
     */
    public function setMail(string $mail):void{
        $this->_mail = $mail;
    }




    
    /**
     * Création de la méthode add visant à ajouter un patient à la base de donnée
     * @return bool
     */
    
    public function add():int{
        try{
            $db = DataBase::dbConnect();
            $sth = $db->prepare('INSERT INTO `patients` (`lastname`,`firstname`,`birthdate`,`phone`,`mail`) VALUES (:lastname,:firstname,:birthDate,:phone,:mail)');
            $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(':birthDate', $this->getBirthDate(), PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
            if($sth->execute()){
                $lastId = $db->lastInsertId();
            } 
            return $lastId;
        } catch (PDOException $e){
            return false;
        }
    }


    public static function isExist(string $mail):bool{
        try{
            $sql = "SELECT `mail` FROM `patients` WHERE `mail` = :mail; ";
            $sth = DataBase::dbConnect()-> prepare($sql);
            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth->execute();

            if(empty($sth->fetchAll())){
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }


    /**
     * Création de la méthode getAll visant à sélectionner tous les patients de la table patients
     * @param mixed $pdo
     * 
     */
    public static function getAll($offset = 0,$perPage= 10,$search = ''){
        $sql = 
        'SELECT *
        FROM `patients`
        WHERE `firstname` LIKE :search OR `lastname` LIKE :search
        LIMIT :offset,:perPage;
        ';
        try{
            $sth = DataBase::dbConnect()->prepare($sql);
            $sth->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
            $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
            $sth->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $sth ->execute();
            
            if(!$sth){
                throw new PDOException();
            }
            $patients = $sth->fetchAll(); 
            return $patients;
        } catch(PDOException $e){
            return [];
        }
    }


    public static function total($search =''){
        $sql = 
        'SELECT *
        FROM `patients`
        WHERE `firstname` LIKE :search OR `lastname` LIKE :search;
        ';
        $sth = DataBase::dbConnect()->prepare($sql);
        $sth->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
        $sth ->execute();
        $total = $sth->rowCount();
        return $total;
    }


    


    /**
     * @param mixed $pdo
     * @param int $id
     * 
     * @return [type]
     */
    public function getOne(int $id):object{
        $sql = 'SELECT * FROM `patients` WHERE `patients`.`id` = :id;';
        try{
            $sth =  DataBase::dbConnect()->prepare($sql);
            $sth->bindValue(':id',$id, PDO::PARAM_INT);
            $verif = $sth ->execute();
            if(!$verif){
                throw new PDOException();
            } else {
                return $sth->fetch();
            }
        } catch(PDOException $e){
            return $e;
        }
    }
    

    public function modifyOne($id){
        $sql = 
        'UPDATE `patients`  
        SET `lastname` = :newLastname, `firstname` = :newFirstname, `birthdate` = :newBirthDate, `phone` = :newPhone, `mail` = :newMail
        WHERE `id` = :id';
        $sth =  DataBase::dbConnect()->prepare($sql);
        $sth->bindValue(':newLastname', $this->getLastname(), PDO::PARAM_STR);
        $sth->bindValue(':newFirstname', $this->getFirstname(), PDO::PARAM_STR);
        $sth->bindValue(':newBirthDate', $this->getBirthDate(), PDO::PARAM_STR);
        $sth->bindValue(':newPhone', $this->getPhone(), PDO::PARAM_STR);
        $sth->bindValue(':newMail', $this->getMail(), PDO::PARAM_STR);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth ->execute();
        $patients = $sth->fetch(); 
        return $patients;
    }

    public function getAppointments($id){
        $sql = 
        'SELECT `appointments`.`id` AS appointmentsId, `appointments`.`dateHour` AS hour, `patients`.`id` AS patientsId, `patients`.`lastname` AS lastname, `patients`.`firstname` AS firstname,
        `patients`.`mail` AS mail
        FROM `appointments`
        JOIN `patients`
        ON `appointments`.`idPatients` = `patients`.`id`
        WHERE `appointments`.`idPatients` = :id
        ORDER BY `appointments`.`dateHour`;';
        $sth =  DataBase::dbConnect()->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth ->execute();
        $patients = $sth->fetchAll(); 
        return $patients;
    }


    public function deletePatient($id){
        $sql = 'DELETE FROM `patients`
        WHERE `patients`.`id` = :id';
        $sth = DataBase::dbConnect()->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth ->execute();
        $patients = $sth->fetch(); 
        return $patients;
    }



}