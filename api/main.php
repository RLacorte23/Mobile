<?php
require_once("./config/Connection.php");
require_once("./modules/Get.php");
require_once("./modules/Post.php");

$db = new Connection();
$pdo = $db->connect();
$get = new Get($pdo);
$post = new Post($pdo);


if (isset($_REQUEST['request'])) {
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    $req = array("errorcatcher");
}

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        http_response_code(400);
        echo json_encode(array("status"=>array("remarks"=>"failed", "message"=>"No public endpoint available", "timestamp"=>date_create())));
    break;

    case 'POST':
        $d = json_decode(file_get_contents("php://input"));
        switch($req[0]) {
            case 'getLastSensorData': 
                echo json_encode($get->getLastSensorData()); 
            break;
            
            case 'getSensorData': 
                echo json_encode($get->getSensorData()); 
            break;

            case 'addstudent': 
                echo json_encode($post->addRecord($d->payload)); 
            break;

            case 'updatestudent': 
                echo json_encode($post->updateRecord($d->payload)); 
            break;

            case 'setarchive': 
                echo json_encode($post->setArchiveRecord($d->payload)); 
            break;

            case 'deletestudent': 
                echo json_encode($post->deleteRecord($d->payload)); 
            break;

            default: 
                http_response_code(403);
                echo json_encode(array("status"=>array("remarks"=>"failed", "message"=>"Invalid Access", "timestamp"=>date_create())));
            break;
        }   
    break;

    default: 
        http_response_code(400);
        echo json_encode(array("status"=>array("remarks"=>"failed", "message"=>"Invalid Access", "timestamp"=>date_create())));
    break;
}
