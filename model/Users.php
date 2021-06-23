<?php

class Users
{
    // db stuff
    private $conn;
    private $table = 'users';

    // users properties
    public $userId;
    public $userCIN;
    public $userEmail;
    public $userFirstName;
    public $userLastName;
    public $userPassword;
    public $Reference;

    // constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // get users informations 
    public function read()
    {
        // $query = 'SELECT * FROM' . $this->table;
        $query = ' SELECT * FROM ' . $this->table . ';';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // execute statement
        $stmt->execute();
        return $stmt;
    }

    // get one user informations
    public function read_single()
    {
        $query = 'SELECT * FROM users  where userId=:userId ';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // bind user id
        $stmt->bindParam(':userId', $this->userId);
        // execute statement
        $stmt->execute();
        return $stmt;
    }

    // create a user
    public function create()
    {
        $query = " INSERT INTO users (userFirstName, userLastName, userCIN, userEmail, Reference)
        VALUES (:userFirstName, :userLastName, :userCIN, :userEmail , :Reference) ";

        // Clean data
        $this->userFirstName = htmlspecialchars(strip_tags($this->userFirstName));
        $this->userLastName = htmlspecialchars(strip_tags($this->userLastName));
        $this->userCIN = htmlspecialchars(strip_tags($this->userCIN));
        $this->userEmail = htmlspecialchars(strip_tags($this->userEmail));

        /* $this->userPassword = $this->userPassword; */
        $this->Reference = $this->Reference;

        // Bind data
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userFirstName', $this->userFirstName);
        $stmt->bindParam(':userLastName', $this->userLastName);
        $stmt->bindParam(':userCIN', $this->userCIN);
        $stmt->bindParam(':userEmail', $this->userEmail);
        /* $stmt->bindParam(':userPassword', $this->userPassword); */
        $stmt->bindParam(':Reference', $this->Reference);


        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);
        return false;
    }



    public function checkUserExistence()
    {
        $query = "SELECT userId FROM users WHERE Reference = :Reference";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Reference', $this->Reference);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result;
    }
}
