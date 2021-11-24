<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 } 

 function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
 }

 function api_caller($url,$data){
	$data_string = json_encode($data);
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'candidateid: ychitungu@gmail.com',
		'apikey: 3fdb48c5-336b-47f9-87e4-ae73b8036a1c',      
		'Content-Length: ' . strlen($data_string))
	);                                         

	$result = curl_exec($ch);
	$d_result=json_decode($result,True);
	return $d_result;


 }
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login'])) {



	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);
# below is a redundant check step incase the one using bootstrap is bypassed
	if (empty($email)) {
		header("Location: login.php?error=email is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else {
			$data = array("Email" => $email, "Password" => $pass);
            $url='https://www.mra.mw/sandbox/programming/challenge/webservice/auth/login';
			
	
			$decoded_result=api_caller($url,$data);

			$token_Value=$decoded_result['Token']['Value'];
			$result_Email=$decoded_result['UserDetails']['email'];
			$result_Password=$decoded_result['UserDetails']['Password'];
			$result_FirstName=$decoded_result['UserDetails']['FirstName'];
			$result_LastName=$decoded_result['UserDetails']['LastName'];
			//echo $token_Value;
			//echo $result_Email;
			//echo $result_Password;
			//echo $result_FirstName;
			//echo $result_LastName;	
			
            if ($result_Email === $email && $result_Password === $pass) {
            	$_SESSION['FirstName'] = $result_FirstName;
            	$_SESSION['LastName'] = $result_LastName;
            	$_SESSION['email'] = $result_Email;
				$_SESSION['Token'] = $token_Value;
            	header("Location: index.php");
		        exit();
            }else{
				header("Location: login.php?status=Incorrect email or password");
		        exit();
			}
			
		  }
}elseif(isset($_POST['email']) && isset($_POST['logout']) ){

	        $email=validate($_POST['email']);

            $data = array("Email" => $email);
			$url='https://www.mra.mw/sandbox/programming/challenge/webservice/auth/logout';
			
            $decoded_result=api_caller($url,$data);

            $ResultCode=$decoded_result['ResultCode'];
           //echo $decoded_result;
            if($ResultCode===1){
                session_unset();
                session_destroy();

                header("Location: login.php?status= logged out successfully");
                exit();                     
            }else{
                header("Location:index.php?status=error while logging out");
            exit();
                                        
            }

}else{
	header("Location: login.php?status= input your valid credentials below");
	exit();
     }

 ?>