<?php
require_once __DIR__ . '/../libraries/database.php';

class StudentModel{
    private $db;

    public function __construct() {
        $this->db = new database();
    }

}