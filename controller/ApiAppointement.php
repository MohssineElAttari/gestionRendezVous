<?php

class ApiAppointement
{
    public $user_reference;
    public $user_id;

    public function checkUser()
    {

        // headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods:POST,GET');
        header('Access-Control-Allow-Headers: content-type');
        header('Content-Type: application/json');


        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate User object
        $users = new Users($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));
    }

    public function createAnAppointement()
    {

        // headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods:POST,GET');
        header('Access-Control-Allow-Headers: content-type');
        header('Content-Type: application/json');

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate Appointment object
        $Appointement = new Appointements($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $Appointement->userId_fk = $data->userId_fk;
        $Appointement->timeslot_id_fk = $data->timeslot_id_fk;
        $Appointement->user_subject = $data->user_subject;
        $Appointement->c_date = $data->c_date;

        if ($Appointement->createAnAppointement()) {

            echo json_encode(
                array('message' => 'Appointment iserted')
            );
        } else {
            echo json_encode(
                array('message' => 'Appointment is not inserted')
            );
        }
    }

    public function deleteAnAppointment($id)
    {

        // headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods:POST,GET');
        header('Access-Control-Allow-Headers: content-type');
        header('Content-Type: application/json');


        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate User object
        $Appointement = new Appointements($db);

        //get raw posted data 
        $data = json_decode(file_get_contents("php://input"));

        $Appointement->appointement_id = $id;

        if ($Appointement->deleteAnAppointement()) {

            echo json_encode(
                array('message' => 'Appointment deleted')
            );
        } else {
            echo json_encode(
                array('message' => 'Appointment is not deleted')
            );
        }
    }

    public function updateAnAppointement($id)
    {

        // headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods:PUT');
        header('Access-Control-Allow-Headers: content-type');
        header('Content-Type: application/json');

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate Appointment object
        $Appointement = new Appointements($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        // get The Appointement ID
        $Appointement->appointement_id = $id;

        // get the other data
        $Appointement->timeslot_id_fk = $data->timeslot_id_fk;
        $Appointement->user_subject = $data->user_subject;
        $Appointement->c_date = $data->c_date;

        if ($Appointement->updateAnAppointement()) {

            echo json_encode(
                array('message' => 'Appointment Updated')
            );
        } else {
            echo json_encode(
                array('message' => 'Appointment is not Updated')
            );
        }
    }

    public function showMyAppointments($id)
    {
        // headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate User object
        $user = new Users($db);

        $user->userId = $id;

        $result = $user->read_single();

        $userInfo = array();
        $myInfo = array();

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);

            $myInfo = array(
                'userId' => $userId,
                'userFirstName' => $userFirstName,
                'userLastName' => $userLastName,
                'userCIN' => $userCIN,
                'userEmail' => $userEmail,
                'Reference' => $Reference
            );
        }

        // push myInfo to the global array userInfo 
        array_push($userInfo, $myInfo);
        // instantiate appointement object
        $Appointement = new Appointements($db);
        //get the user_id_fk
        $Appointement->userId_fk = $id;

        $appointement_result = $Appointement->getAppointements();

        $num = $appointement_result->rowCount();

        if ($num > 0) {
            // Appointement array
            $myAppointments = array();
            // $posts_arr['data'] = array();

            while ($row = $appointement_result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $myAppointments = array(
                    'userId_fk' => $userId_fk,
                    'timeslot_id_fk' => $timeslot_id_fk,
                    'user_subject' => html_entity_decode($user_subject),
                    'c_date' => $c_date
                );

                // Push to "userInfo"
                array_push($userInfo, $myAppointments);
                // array_push($posts_arr['data'], $post_item);
            }

            // Turn to JSON & output
            echo json_encode($userInfo);
        } else {
            // No Appointements
            $message = array("message" => "you dan't have any appointements");
            array_push($userInfo, $message);
            echo json_encode($userInfo);
        }
    }

    public function checkAvailableTimes()
    {
        // headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods:POST,GET');
        header('Access-Control-Allow-Headers: content-type');
        header('Content-Type: application/json');

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate Appointment object
        $Appointement = new Appointements($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $date = $data->c_date;

        // sending inserted date as paramater
        $result = $Appointement->checkAvailableTimes($date);

        $num = $result->rowCount();
        
        $All_available_reservations = array();
        
        if ($num > 0) {

            while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
                $available_reservations = array(
                    'start_at' => $rows["start_at"],
                    'end_at' => $rows["end_at"]
                );            
                // Push to "data"
                array_push($All_available_reservations, $available_reservations);
        }
        echo json_encode($All_available_reservations);
        
        }else{
            // there is no available dates 
            $message = array("message" => "you dan't have any appointements");
            echo json_encode($message);
        }
    }
}
