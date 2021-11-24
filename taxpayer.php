<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }

if (isset($_SESSION['Token']) && isset($_SESSION['email'])) {

    function validate($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    function api_caller($url,$data,$action){

        $data_string = json_encode($data);
        $ch = curl_init($url);
        if($action==='get_all_taxpayers'){
            $url_method='GET';
        }else{
            $url_method='POST';   
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $url_method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'candidateid: ychitungu@gmail.com',
            'apikey: 3fdb48c5-336b-47f9-87e4-ae73b8036a1c',      
            'Content-Length: ' . strlen($data_string))
        );                                         

        $result = curl_exec($ch);
        if ($action==="add_taxpayer" || $action==="delete_taxpayer"||$action==="edit_taxpayer"){
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            return $httpcode;
        }else{
            $decoded_result=json_decode($result,True);
        
            return $decoded_result;
            //return $result;
        }
        
        

    }
    //$te="1";
    //echo $te;

    if (isset($_POST['confirm_add_taxpayer']) || isset( $_POST['confirm_edit_taxpayer']) ){
        
        //echo "2";
        if (isset($_POST['email']) && isset($_POST['trading_name']) && isset($_POST['phone_number']) && isset($_POST['location']) && isset($_POST['certificate_number']) && isset($_POST['date_of_registration']) && isset($_POST['tpin'])) {
            
            //echo "3";

            $email=validate($_POST['email']);
            $trading_name=validate($_POST['trading_name']);
            $phone_number=validate($_POST['phone_number']);
            if (is_numeric($phone_number)!=1){
                header("Location:add_taxpayer.php?status=input valid phone number please");
                exit();
            }
            $location=validate($_POST['location']);
            $certificate_number=validate($_POST['certificate_number']);
            $date_of_registration=validate($_POST['date_of_registration']);
            $date_of_registration = str_replace('-', '/', $date_of_registration); 
            $tpin=validate($_POST['tpin']);
            if (is_numeric($tpin)!=1){
                header("Location:add_taxpayer.php?status=input valid TPIN please(must be digits only)");
                exit();
            }
            //$username=strstr($email, '@', true);
            $username=validate($_POST['username']);
            //$username="we";
            $data = array("TPIN" => $tpin, "BusinessCertificateNumber" => $certificate_number, "TradingName" => $trading_name, "BusinessRegistrationDate" => $date_of_registration, "MobileNumber" => $phone_number, "Email" => $email, "PhysicalLocation" => $location,"Username"=>$username);
            
            if( isset($_POST['confirm_add_taxpayer']) ){

                $url="https://www.mra.mw/sandbox/programming/challenge/webservice/Taxpayers/add";
                $action = "add_taxpayer";
                $result=api_caller($url,$data,$action);
                //echo $result;
                if($result===200){
                header("Location:add_taxpayer.php?status=taxpayer successfully created");
                exit();
                }elseif($result===300){
                    header("Location:add_taxpayer.php?status=taxpayer already exists");
                exit();
                                            
                }elseif($result===400){
                    header("Location:add_taxpayer.php?status=username does not exist");
                exit();
                                            
                }elseif($result===500){
                    header("Location:add_taxpayer.php?status=internal server error");
                    exit();                     
                }else{
                    header("Location:add_taxpayer.php?status=unable to add new taxpayer");
                exit();
                                            
                }

            }elseif (isset( $_POST['confirm_edit_taxpayer'])) {
                
                
                $url="https://www.mra.mw/sandbox/programming/challenge/webservice/Taxpayers/edit";
                $action = "edit_taxpayer";
                $result=api_caller($url,$data,$action);
                //echo $result;
                if($result===200){
                header("Location:index.php?status=taxpayer updated successfully");
                exit();
                }elseif($result===400){
                    header("Location:index.php?status=username does not exist or invalid request");
                exit();
                                            
                }else{
                    header("Location:index.php?status=unable to update taxpayer");
                exit();
                                            
                }

            }
           

           // $status = $_SESSION['status'];
            //
            

        }
    }


    if (isset($_POST['delete_confirm']) && isset($_POST['delete_confirm_tpin'])){
  
            $tpin=validate($_POST['delete_confirm_tpin']);
            $data = array("TPIN" => $tpin);
            $url="https://www.mra.mw/sandbox/programming/challenge/webservice/Taxpayers/delete";
            $action = "delete_taxpayer";
            $result=api_caller($url,$data,$action);
    
            if ($result===200){
                header("Location:index.php?status= taxpayer deleted sucessfully");
                exit();
            }else{
                header("Location:index.php?status= error deleting taxpayer");
                exit();

            }
            
    }

    function get_all_taxpayers(){
        $url="https://www.mra.mw/sandbox/programming/challenge/webservice/Taxpayers/getAll";
        $action = "get_all_taxpayers";
        $data=array();
        $result=api_caller($url,$data,$action);
        return $result;
        
    }


} else{
    echo "error please login again";
}
?>