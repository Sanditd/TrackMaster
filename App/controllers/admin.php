<?php
    class admin extends Controller{
        private $sportModel;
        public function __construct(){
          $this->sportModel=$this->model('sportModel');
        }

        public function index(){

        }

        //to load sportCrete.php
        public function sportCreate($name){
            $data=[
                'username'=>$name
            ];
            $this->view('sportCreate');
        }

        //to load dashbaord.php
        public function dashboard(){
            $data=[];
            $this->view('adminpanelview');
        }

        //to load userManage.php
        public function userManage($name){
            $data=[
                'username'=>$name
            ];
            $this->view('userManage');
        }

        //to load sportManege.php
        public function sportManage($name){
            $data=[
                'username'=>$name
            ];
            $this->view('sportManage');
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
                    'sportType' => trim($_POST['sportType']),
                    'numPlayers' => trim($_POST['numPlayers']),
                    'playerPositions' => trim($_POST['playerPositions']),
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
                if(!empty($data['errorMsg'])){
                    //add sport to the db
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

                $this->view('sportCreate',$data);
            }
        }



    }
?>