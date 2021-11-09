<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
require_once PROJECT_ROOT_PATH . "/Controller/api/SoftwareCoursesController.php";

// session_start();
// instantiate database and product object
$softwareCoursesController=new SoftwareCoursesController();
// $user = $_SESSION['user'];

$stmt1 = $patient->mr_number($user);
$num1 = $stmt1->rowCount();

if ($num1 == 1) {
    $p = $stmt1-> fetch();
    $SIN = $p['SIN'];

    $stmt2 = $dependent->returnAllDependents($SIN);
    $num2 = $stmt2 ->rowCount();

    if($num2 > 0) {

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {

            $dsin = $row['D_SIN'];
            $relation = $row['Relationship'];
            $stmt3 = $person->sin($dsin);
            $num3 = $stmt3->rowCount();
            $arr = array();
            $arr['records'] = array();
            
            if($num3 == 1) {
                $row1 = $stmt3->fetch();
                extract($row1);
                    
                $item = array(
                    "DFName"      => $FName,
                    "DMInit"      => $MInit,
                    "DLName"      => $LName,
                    "Relation"    => $relation,
                );
                    
                array_push($arr['records'], $item);           
            }
        }
        echo json_encode($arr);
        
    }
        // show products data in json format
    else {
        echo json_encode([]);
    }
}


?>