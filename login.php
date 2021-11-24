<!DOCTYPE html>
<html>
<head>
<title>MRA</title>
    <link rel = "icon" href = "resources/icon/mra_icon.jpg" type = "image/x-icon">
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/css/bootstrap.min.css">
</head>
<body>

    <div class= "d-flex justify-content-center align-items-center" style="min-height: 100vh">
    
        <form action="auth.php" method="post" class ="p-5 rounded shadow" style="width: 26.3rem">
        <div class="card">
        <img src="resources/icon/mra_logo.png" alt="mra logo">
        </div>
            <?php if (isset($_GET['status'])) { ?>
                   <div class="alert alert-info">
                        <p class="error">
                        <label  class="form-label">STATUS:</label>
                            <?php echo $_GET['status']; ?>
                        </p>
            </div>
            <?php } ?>
            <div class="col-md-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" id="email" style="width: 20rem" value="" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="password" style="width: 20rem" value="" required>
            </div>
            <div class="col-12">
                Enter your login credentials
            </div>
            <br>
            <div class="col-12">
                <input type='text' name='login' value='login' hidden/>
                <button class="btn btn-primary" type="submit">login</button>
            </div>

        </form>
    </div>
</body>
</html>