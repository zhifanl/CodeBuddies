<?php
class SoftwareCoursesController extends BaseController
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
                $softwarecourseModel = new SoftwareCoursesModel();

                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrSoftwareCourses = $softwarecourseModel->getSoftwareCourses($intLimit);
                $responseData = json_encode($arrSoftwareCourses);
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
        else if (strtoupper($requestMethod) == 'PUT') {
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
                $softwarecourseModel=new SoftwareCoursesModel();
                $course_name=$array['course_name'];
                $description=$array['description'];
                
                $result=$softwarecourseModel->updateSoftwareCourses($course_name,$description);
                
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
                $softwarecourseModel=new SoftwareCoursesModel();

                $course_name = '';
                if (isset($arrQueryStringParams['course_name']) && $arrQueryStringParams['course_name']) 
                {
                    $course_name = $arrQueryStringParams['course_name'];
                    // echo $username;
                }
                $result=$softwarecourseModel->deleteSoftwareCourses($course_name);
                
                
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
                $softwarecourseModel=new SoftwareCoursesModel();


                
                $result=$softwarecourseModel->postSoftwareCourses();
                
                
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