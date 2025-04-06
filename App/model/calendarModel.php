<?php

class calendarModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Fetch reminders and holidays for a given month and year
    public function getMonthlyCalendarData($month = null, $year = null) {
        // Use the current month and year if not provided
        if ($month === null || $year === null) {
            $month = date('m'); // Current month
            $year = date('Y');  // Current year
        }

        // Query to fetch reminders and predefined holidays
        $query = "
            SELECT
                date,
                description,
                'reminder' AS type
            FROM reminders
            WHERE MONTH(date) = :month AND YEAR(date) = :year
            UNION ALL
            SELECT
                date,
                name AS description,
                'holiday' AS type
            FROM holidays
            WHERE MONTH(date) = :month AND YEAR(date) = :year
        ";

        $this->db->query($query);
        $this->db->bind(':month', $month, PDO::PARAM_INT);
        $this->db->bind(':year', $year, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->resultSet(); // Fetch all rows as an array
    }

    // Add a new reminder to the database
    public function addReminder($date, $description) {
        $query = "INSERT INTO reminders (date, description) VALUES (:date, :description)";
        $this->db->query($query);
        $this->db->bind(':date', $date);
        $this->db->bind(':description', $description);
        $this->db->execute();
    }

    // Fetch all holidays for a given year
    public function getHolidaysForYear($year = null) {
        if ($year === null) {
            $year = date('Y'); // Default to the current year
        }

        $query = "SELECT date, name FROM holidays WHERE YEAR(date) = :year";
        $this->db->query($query);
        $this->db->bind(':year', $year, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->resultSet(); // Fetch all rows as an array
    }
}
