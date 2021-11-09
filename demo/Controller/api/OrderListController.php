<?php
class OrderListController extends BaseController
{
    /**
     * REST API "/software_courses/list" Endpoint - Get list of software_courses with description*/
    public function listAction($uri)
    {
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();// param in the query string


        if (strtoupper($requestMethod) == 'GET') {
            $strErrorDesc = '';
            try {
                $orderListModel = new OrderListModel();

                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrOrderListModel = $orderListModel->getOrderList($intLimit);
                $responseData = json_encode($arrOrderListModel);
                // send output
                if (!$strErrorDesc) {
                    $this->sendOutput(
                        $responseData,
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                        array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                // $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error'));
            }
        } 
        else if (strtoupper($requestMethod) == 'PATCH') {
            $strErrorDesc = '';
            try {
             

                //Make sure that the content type of the POST request has been set to application/json
                $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                if(strcasecmp($contentType, 'application/json') != 0){
                    throw new Exception('Content type must be: application/json');
                }

                //Receive the RAW post data.
                $content = file_get_contents("php://input");

                //Attempt to decode the incoming RAW post data from JSON.
                $array = json_decode($content,true);
                
                //If json_decode failed, the JSON is invalid.
                if(!is_array($array)){
                    throw new Exception('Received content contained invalid JSON! it is not an array');
                }

                //Process the JSON.
                // email,client_name, teacher_name,course_name
                $orderListModel=new OrderListModel();
                $order_id=$array['order_id'];
                $student_name=$array['student_name'];
                $student_id=$array['student_id'];
                $start_date=$array['start_date'];
                $end_date=$array['end_date'];
                $salary=$array['salary'];
                $course_name=$array['course_name'];
                
                // $order_id, $student_name,$student_id,$course_name, $start_date, $end_date, $salary

                $result=$orderListModel->updateOrderList($order_id,$student_name, $student_id,$course_name, $start_date, $end_date, $salary);
                
                if (!$strErrorDesc) {
                    $this->sendOutput(
                        
                        $result, //"Record updated successfully"
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                        array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                // $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error'));
            }
        } 
        // user/list?username=xxx
        else if (strtoupper($requestMethod) == 'DELETE') {
            $strErrorDesc = '';
            try {
                $orderListModel=new OrderListModel();

                $order_id = '';
                
                if (isset($arrQueryStringParams['order_id']) && $arrQueryStringParams['order_id']) 
                {
                    $order_id = $arrQueryStringParams['order_id'];
                    // echo $order_id;
                }
                
                $result=$orderListModel->deleteOrderList($order_id);// in fact the delete method does not have to have parameters
                
                
                // send output
                if (!$strErrorDesc) {
                    $this->sendOutput(
                        
                        $result, //"Record deleted successfully"
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                        array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                // $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error'));
            }
        }
        else if (strtoupper($requestMethod) == 'POST') {
            $strErrorDesc = '';
            try {
                $orderListModel=new OrderListModel();

                $result=$orderListModel->postOrderList();
                
                // send output
                if (!$strErrorDesc) {
                    $this->sendOutput(
                        
                        $result, //"Record deleted successfully"
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                        array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                // $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error'));
            }
        }
        else {
            $strErrorDesc = 'Method not supported';
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
            array('Content-Type: application/json','HTTP/1.1 500 Internal Server Error'));
        }

        
    }
}