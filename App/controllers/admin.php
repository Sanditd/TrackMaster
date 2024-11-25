<?php
    class admin extends Controller{
        private $sportModel;
        public function __construct(){
          $this->sportModel=$this->model('sportModel');
        }

        public function index(){

        }

        //to load sportCrete.php
        public function sportCreate(){
            $this->view('/Admin/sportCreate');
        }

        public function teamSportForm(){
            $this->view('/Admin/teamSportForm');
        }

        public function indSportForm(){
            $idata=[];
            $this->view('/Admin/indSportForm',$idata);
        }

        //to load dashbaord.php
        public function dashboard(){
            $data=[];
            $this->view('Admin/adminpanelview');
        }

        //to load userManage.php
        public function userManage($name){
            $data=[
                'username'=>$name
            ];
            $this->view('/Admin/userManage');
        }

        //to load sportManege.php
        public function sportManage(){
            $data=$this->sportModel->getSports();
            $this->view('/Admin/sportManage',$data);
        }

        //handle sport adding to database
        public function addSportForm(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //form is submitting
                //validate data
                $filters=[
                    'sportName' => FILTER_SANITIZE_STRING,
                    'sportType' => FILTER_SANITIZE_STRING,
                    'numPlayers' => FILTER_SANITIZE_NUMBER_INT,
                    'playerPositions' => FILTER_SANITIZE_STRING,
                    'teamFormation' => FILTER_SANITIZE_NUMBER_INT,
                    'gameDuration' => FILTER_SANITIZE_NUMBER_FLOAT,
                    'halftimeDuration' => FILTER_SANITIZE_NUMBER_FLOAT,
                    'locationType' => FILTER_SANITIZE_STRING,
                    'equipment' => FILTER_SANITIZE_STRING,
                    'rulesURL'=> FILTER_SANITIZE_STRING,
                ];

                $_POST=filter_input_array(INPUT_POST,$filters);

                //input data
                $data=[
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'teamSport',
                    'numPlayers' => trim($_POST['numPlayers']),
                    'playerPositions' => json_encode(explode(',', trim($_POST['playerPositions']))),
                    'teamFormation' => trim($_POST['teamFormation']),
                    'gameDuration' => trim($_POST['gameDuration']),
                    'halftimeDuration' => trim($_POST['halftimeDuration']),
                    'locationType' => trim($_POST['locationType']),
                    'equipment' => trim($_POST['equipment']),
                    'rulesURL'=> trim($_POST['rulesURL']),

                    'errorMsg' => ''
                ];

                //validate data
                
                //validate name
                if(empty($data['sportName'])){
                    $data['errorMsg']='Please enter sport name';
                }else{
                    //check the sport already available in the db
                    if($this->sportModel->findSportByName($data['sportName'])){
                        $data['errorMsg']='Sport is already in the Database';                                   
                    }
                }

                //validate sportType
                if(empty($data['sportType'])){
                    $data['errorMsg']='Please select sport type';
                }

                //validate numPlayer
                if(empty($data['numPlayers'])){
                    $data['errorMsg']='Please enter number of players per team';
                }

                //validate playerPositions
                if(empty($data['playerPositions'])){
                    $data['errorMsg']='Please enter player positions';
                }

                //validate teamFormation
                if(empty($data['teamFormation'])){
                    $data['errorMsg']='Please enter team formation';
                }

                //validate gameDuration
                if(empty($data['gameDuration'])){
                    $data['errorMsg']='Please enter game duration';
                }

                //validate halftimeDuration
                if(empty($data['halftimeDuration'])){
                    $data['errorMsg']='Please enter half time duration';
                }
                
                //validate locationType
                if(empty($data['locationType'])){
                    $data['errorMsg']='Please enter location type';
                }

                //validate equipment
                if(empty($data['equipment'])){
                    $data['errorMsg']='Please name equipments';
                }

                //validate rulesURL
                if(empty($data['rulesURL'])){
                    $data['errorMsg']='Please provide URL for rules';
                }

                //validation is complete and no error

                if (!empty($data['errorMsg'])) {
                    $this->view('/Admin/teamSportForm', $data);
                    return;
                }
                
                // Add sport to the database
                if ($this->sportModel->addSport($data)) {
                    header('Location: ' . ROOT . '/admin/sportManage/asdad');
                    exit;
                } else {
                    $idata['errorMsg'] = 'Something went wrong while adding sport.';
                    $this->view('/Admin/teamSportForm', $data);
                }
    
    
            }else{
                //initial form
                $data=[
                    'sportName' => '',
                    'sportType' => '',
                    'numPlayers' => '',
                    'playerPositions' => '',
                    'teamFormation' => '',
                    'gameDuration' => '',
                    'halftimeDuration' => '',
                    'locationType' => '',
                    'equipment' => '',
                    'rulesURL'=> '',
                ];

                $this->view('/Admin/teamSportForm',$data);
            }
        }

        public function addindSportForm(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize inputs
                $filters = [
                    'sportName' => FILTER_SANITIZE_STRING,
                    'gameDuration' => FILTER_SANITIZE_NUMBER_FLOAT,
                    'locationType' => FILTER_SANITIZE_STRING,
                    'equipment' => FILTER_SANITIZE_STRING,
                    'category' => FILTER_SANITIZE_STRING,
                    'scoring' => FILTER_SANITIZE_STRING,
                    'rulesURL' => FILTER_SANITIZE_STRING,
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                // Prepare data
                $idata = [
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'indSport',
                    'gameDuration' => trim($_POST['gameDuration']),
                    'locationType' => trim($_POST['locationType']),
                    'equipment' => trim($_POST['equipment']),
                    'category' => json_encode(explode(',', trim($_POST['playerPositions']))),
                    'scoring' => trim($_POST['scoring']),
                    'rulesURL' => trim($_POST['rulesURL']),
                    'errorMsg' => ''
                ];
        
                // Validation
                if (empty($idata['sportName'])) {
                    $idata['errorMsg'] = 'Please enter sport name';
                } elseif ($this->sportModel->findSportByName($idata['sportName'])) {
                    $idata['errorMsg'] = 'Sport is already in the database';
                }
        
                if (empty($idata['gameDuration'])) {
                    $idata['errorMsg'] = 'Please enter game duration';
                }
        
                if (empty($idata['locationType'])) {
                    $idata['errorMsg'] = 'Please enter location type';
                }
        
                if (empty($idata['equipment'])) {
                    $idata['errorMsg'] = 'Please name equipment';
                }
        
                if (empty($idata['category'])) {
                    $idata['errorMsg'] = 'Please enter category';
                }
        
                if (empty($idata['scoring'])) {
                    $idata['errorMsg'] = 'Please describe scoring system';
                }
        
                if (empty($idata['rulesURL'])) {
                    $idata['errorMsg'] = 'Please provide URL for rules';
                }
        
                // If errors exist, reload the form
                if (!empty($idata['errorMsg'])) {
                    $this->view('/Admin/addindSportForm', $idata);
                    return;
                }
        
                // Add sport to the database
                if ($this->sportModel->addindSportForm($idata)) {
                    header('Location: ' . ROOT . '/admin/sportManage/sasd');
                    exit;
                } else {
                    $idata['errorMsg'] = 'Something went wrong while adding sport.';
                    $this->view('/Admin/addindSportForm', $idata);
                }
            } else {
                // Initial form load
                $idata = [
                    'sportName' => '',
                    'sportType' => '',
                    'gameDuration' => '',
                    'locationType' => '',
                    'equipment' => '',
                    'category' => '',
                    'scoring' => '',
                    'rulesURL' => '',
                    'errorMsg' => 'nothing'
                ];
        
                $this->view('/Admin/indSportForm', $idata);
            }
        }
        

        //load sport view
        public function sportView($sportId) {
            try {
                // Get the sport data by ID (associative array)
                $sport = $this->sportModel->getSportById($sportId);
                
                if (!$sport) {
                    throw new Exception("Sport not found!");
                }
        
                // Check if it's a team or individual sport
                if ($sport['sportType'] === 'teamSport') {
                    // Call the appropriate method for team sports
                    $details = $this->sportModel->getTeamSportDetails($sportId);
                } else {
                    // Call the appropriate method for individual sports
                    $details = $this->sportModel->getIndSportDetails($sportId);
                }
        
                // Combine data into a single array
                $data = [
                    'sport' => $sport,
                    'details' => $details
                ];
        
                // Load the view with the data
                $this->view('/Admin/sportView', $data);
        
            } catch (Exception $e) {
                // Log the error message (optional, depending on your logging mechanism)
                error_log($e->getMessage());
                
                // Show an error message to the user
                echo "<p>Error: " . $e->getMessage() . "</p>";
                exit;
            }
        }
        
        
        

    }
?>