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
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<title>MRA</title>
    <link rel = "icon" href = "resources/icon/mra_icon.jpg" type = "image/x-icon">
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

 <div class="container" style="width:100%;">
<?php include 'menu.php';?>
        <form action="taxpayer.php" method="post" class ="p-5 rounded shadow" >
           
            
            
            <?php if (isset($_GET['status'])) { ?>
                <div class="alert alert-info">
                        <p class="error">
                        <label  class="form-label">STATUS:</label>
                            <?php echo $_GET['status']; ?>
                        </p>
                    </div>
            <?php } ?>
            
            
            <div class="card">

                <h5 class="text-center mb-4">Create New TaxPayer</h5>
                <form class="form-card" >
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"><label class="form-control-label px-3">Email:</label> <input type="email" name="email" class="form-control" placeholder="" required> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Trading Name:</label> <input type="text" name="trading_name" class="form-control" placeholder="" required> </div>
                    
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Location:</label> <input type="text" name="location" class="form-control" placeholder="" required> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number:(format 0994563211)</label> <input type="number" name="phone_number" pattern="[0-9]{10,14}" class="form-control" placeholder="" required> </div>
                    
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Business Certificate Number:</label> <input  type="text" name="certificate_number" class="form-control" placeholder="" required> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Date of Registration:</label> <input type="date" name="date_of_registration" class="form-control" placeholder="" required> </div>
                    
                    </div>
                    <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">TPIN:</label> <input type="number" name="tpin" class="form-control" placeholder="" required > </div>
                    <input type="text" name="username" class="form-control"style="width: 100%" value="<?php echo $_SESSION['email']; ?>" hidden>
           
                    </div>
                    <br>
                    <div class="row justify-content-between text-left">
                    <div class="col-md-12">
                    <input class="form-check-input" name="confirm_add_taxpayer" type="checkbox" value="" required ><label class="form-check-label" for="flexCheckDefault">
                        &nbsp;Click this checkbox to confirm that the details <br>&nbsp;provided are correct before submitting
                    </label>
                    </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> 
                        <div class="col-12">    
                        <button type="submit" class="btn-block btn-primary">Create Taxpayer</button> 
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            
            
            </div>
        </form>
    </div>
</body>
</html>
<?php 
}else{
  
     header("Location: login.php");
     exit();
}
 ?>

