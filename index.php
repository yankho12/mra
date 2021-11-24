<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }

if (isset($_SESSION['Token']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, ">
     
	<title>MRA</title>
    <link rel = "icon" href = "resources/icon/mra_icon.jpg" type = "image/x-icon">
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>

  
<div class="container" style="width:100%;">
<?php include 'menu.php';?>

<div class="card" >

                                <?php if (isset($_GET['status'])) { ?>
                                    <div class="alert alert-info">
                                        <p class="error">
                                        <label  class="form-label">STATUS:</label>
                                            <?php echo $_GET['status']; ?>
                                        </p>
                                    </div>
                                    <?php } ?>
                                    

                                                <?php
                                                include('taxpayer.php');
                                                $data=get_all_taxpayers();
                                                //var_dump($data);
                                                if(!empty($data)){
                                                    echo"
                                                    
                                                    <h5 class='card-header'>List of Taxpayers You Created In The System</h5>
                                                    <div class='card-body p-0'>
                                                        <div class='table-responsive'>
                                                            <table class='table' >
                                                                <thead class='bg-light'>
                                                                    <tr class='border-0'>
                                                        <th class='border-0'>#</th>
                                                        <th class='border-0'>TPIN</th>
                                                        <th class='border-0'>Business Certificate Number</th>
                                                        <th class='border-0'>Trading Name</th>
                                                        <th class='border-0'>Registration Date</th>
                                                        <th class='border-0'>Phone Number</th>
                                                        <th class='border-0'>Email</th>
                                                        <th class='border-0'>Location</th>
                                                        <th class='border-0'></th>
                                                        <th class='border-0'></th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    ";
                                                function display_data($data) {
                                                    $row_num=1;
                                                    $row=0;
                                                    foreach($data as $key => $var) {
                                                        
                                                        echo "<form action='edit_taxpayer.php' method='post'>
                                                        <tr><td>".$row_num.".</td>
                                                        <td><input type='hidden' name='tpin' value='".$data[$row]['TPIN']."'>".$data[$row]['TPIN']."</td>
                                                        <td><input type='hidden' name='certificate_number' value='".$data[$row]['BusinessCertificateNumber']."'>".$data[$row]["BusinessCertificateNumber"]."</td>
                                                        <td><input type='hidden'name='trading_name' value='".$data[$row]['TradingName']."'>".$data[$row]["TradingName"]."</td>
                                                        <td><input type='hidden' name='date_of_registration' value='".$data[$row]['BusinessRegistrationDate']."'>".$data[$row]["BusinessRegistrationDate"]."</td>
                                                        <td><input type='hidden' name='phone_number' value='".$data[$row]['MobileNumber']."'>".$data[$row]["MobileNumber"]."</td>
                                                        <td><input type='hidden' name='email' value='".$data[$row]['Email']."'>".$data[$row]["Email"]."</td>
                                                        <td><input type='hidden' name='location' value='".$data[$row]['PhysicalLocation']."'>".$data[$row]["PhysicalLocation"]."</td>
                                                        <td>
                                                        <button type='submit' name='edit_button' class='btn btn-primary'>Edit</button>
                                                        </form>
                                                        </td>
                                                        <td><button type='button' name='delete_button' id='delete_button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter".$data[$row]['TPIN']."'>
                                                        Delete
                                                      </button>
                                                      
                                                      <div class='modal fade' id='exampleModalCenter".$data[$row]['TPIN']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                                      <div class='modal-dialog modal-dialog-centered' role='document'>
                                                          <div class='modal-content'>
                                                          <div class='modal-header'>
                                                              <h5 class='modal-title' id='exampleModalLongTitle'>Confirm Delete</h5>
                                                              
                                                              
                                                          </div>
                                                          <div class='modal-body'>
                                                              Are you sure you want to delete taxpayer with Tpin: ".$data[$row]['TPIN']."
                                                          </div>
                                                          <div class='modal-footer'>
                                                              <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                                              
                                                              <form action='taxpayer.php' method='post'>
                                                                        <input type='text' name='delete_confirm_tpin' value='".$data[$row]['TPIN']."' hidden/>
                                                                          <input type='submit' class='btn btn-primary' confirm='delete_confirm' name='delete_confirm'
                                                                                  value='yes'/>
                                                                          </form>
                                                          </div>
                                                          </div>
                                                      </div>
                                                      </div>
                                                      </td></tr>
                                                      ";
                                                        $row_num=$row_num+1;
                                                        $row=$row+1;
                                                    }
                                                    
                                                  //echo $output;
                                                 
                                             }
                                                  display_data($data);

                                            }else {
                                                echo $_SESSION['FirstName']." ".$_SESSION['LastName']." you have not created any taxpayers in the system else contact the admin";
                                            }
                                                ?>
                                                 
                                            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            






</div>
                            
                                

</body>
</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

