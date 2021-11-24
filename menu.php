<nav class="navbar navbar-expand-sm bg-light navbar-light"  style="width:100%;">
  <div class="container-fluid">
  <img src="resources/icon/mra_icon.jpg" alt="mra logo" style="width:5%;height:5%;">
    <ul class="nav navbar-nav  navbar-left ">
  
     <li class="nav-item">
      <li class="nav-item">
        <a class="nav-link active"  style="color:green;" href="index.php"><i class="bi-house-fill"></i>Home&nbsp;&nbsp;&nbsp;&nbsp;</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" style="color:green;" href="add_taxpayer.php"><i class="bi-person-plus-fill"></i>Create TaxPayer   &nbsp;&nbsp;&nbsp;&nbsp;</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:green;" href="#"><i class="bi-envelope-fill"></i>Contact us   &nbsp;&nbsp;&nbsp;&nbsp;</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:green;" href="#"><i class="bi-info-circle-fill"></i>About us   </a>
      </li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="#" style="font-size:60%;" ><i class="bi-person-fill"></i> <?php  echo $_SESSION['FirstName']." ".$_SESSION['LastName']."( ".$_SESSION['email']." )"; ?>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#">
              <form action='auth.php' method='post'>
               <input type='text' name='email' value='<?php echo $_SESSION['email'] ?>' hidden/>
               <input type='text' name='logout' value='logout' hidden/>
               

               <button type='submit' class='nav-link' style=" border: none;outline: none;"  name='logout_button'><i class="bi-door-open-fill"></i>Logout</button>
               
               </form></a>
      </li>
      
    </ul>
  </div>
</nav>