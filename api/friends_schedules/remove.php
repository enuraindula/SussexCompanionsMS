<?php 
// required headers
header("Access-Control-Allow-Origin: http://localhost/friends_finder/");
header("Content-Type: application/json; charset=UTF-8");

// get database and friends_schedule file
require_once "../../config/database.php";
require_once "../../models/friends_schedule.php";

$database = Database::getInstance();
$schedule = new FriendsSchedule($database->getConnection());

// check if id exist
if(isset($_GET['id'])){
    $schedule->id = $_GET['id'];

    try{
        $schedule->remove();
        echo json_encode(array("succ" => true, "msg" => "Schedule removed successfully!"));
        
    }catch(Exception $e){
        echo json_encode(array("succ" => false, "msg" => "Unable to removed schedule. Something went wrong!", "error" => $e->getMessage()));
    }

}else{
    // tell the user incomplete data
    echo json_encode(array("succ" => false, "msg" => "Unable to removed schedule. Incomplete Data"));
}
?>