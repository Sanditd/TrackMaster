<?php
require_once __DIR__ . '/../libraries/Database.php';

class zoneModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getZones() {
        $query = "SELECT provinceName, DisName, zoneName , active FROM zone ORDER BY provinceName, DisName, zoneName";
        $this->db->query($query);
        $this->db->execute();
        $zones = $this->db->resultset();
    
        // Group the zones by province and district
        $groupedZones = [];
        foreach ($zones as $zone) {
            $provinceName = $zone->provinceName;
            $districtName = $zone->DisName;
    
            if (!isset($groupedZones[$provinceName])) {
                $groupedZones[$provinceName] = [];
            }
    
            if (!isset($groupedZones[$provinceName][$districtName])) {
                $groupedZones[$provinceName][$districtName] = [];
            }
    
            $groupedZones[$provinceName][$districtName][] = [
                'zoneName' => $zone->zoneName,
                'active' => $zone->active // You can still store the active status if needed
            ];
        }
    
        return $groupedZones;
    }
    

    public function addZone($data) {
        $this->db->query('INSERT INTO zone (zoneName, provinceName, DisName, active) VALUES (:zone, :province, :district, :active)');
        $this->db->bind(':zone', $data['zone']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':active', $data['active']);
        return $this->db->execute();
    }
    

    public function isZoneExists($data) {
        $query = "SELECT COUNT(*) as count FROM zone WHERE provinceName = :province AND DisName = :district AND zoneName = :zone";
        $this->db->query($query);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':zone', $data['zone']);
        $result = $this->db->single();
    
        return $result->count > 0; // Returns true if the zone exists, false otherwise
    }

    public function updateZoneStatus($zoneName, $status) {
        // Prepare the SQL query to update the active status
        $query = "UPDATE zone SET active = :status WHERE zoneName = :zoneName";
        
        // Bind parameters to prevent SQL injection
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':zoneName', $zoneName);
        
        // Execute the query and return the result (true if successful, false if failed)
        return $this->db->execute();
    }
    
    
    public function deleteZoneByName($zoneName) {
        // Prepare the SQL query
        $query = "DELETE FROM zone WHERE zoneName = :zoneName";
    
        // Bind the parameters to prevent SQL injection
        $this->db->query($query);
        $this->db->bind(':zoneName', $zoneName);
    
        // Execute the query and return the result
        return $this->db->execute();
    }
    
    public function getDistrictsAndZones() {
        $query = "SELECT DisName AS district_name,zoneId AS zone_id, zoneName AS zone_name FROM zone ORDER BY DisName, zoneName;";
        $this->db->query($query);
        $results = $this->db->resultset(); // resultset() returns an array of objects
        $districts = [];
    
        foreach ($results as $row) {
            $districts[$row->district_name][] = [
                'id' => $row->zone_id,
                'name' => $row->zone_name
            ];
        }
    
        return $districts;
    }
    
    public function getZoneId($zoneName){
        $query="SELECT zoneId from zone where zoneName=:zoneName";
        $this->db->query($query);
        $this->db->bind(':zoneName', $zoneName);
        return $this->db->execute();
    }

    public function getZonals(){
        $query="SELECT * from zone";
        $this->db->query($query);
        return $this->db->resultset();
    }

    public function countZonals(){
        $query = "SELECT COUNT(*) as total FROM zone ";
        $this->db->query($query);
        $result = $this->db->resultset();
        return $result;
    }

    
}