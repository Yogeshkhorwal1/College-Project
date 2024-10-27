<?php

session_start();
$conn = mysqli_connect('localhost','root','','contact_db') or die ('Unable to connect');

?>


<?php
    if (isset($_POST['login'])){
        $Username = $_POST['Username'];
        $Pass = $_POST['Pass'];

    $select = mysqli_query($conn,"SELECT * FROM tb_admin WHERE Username = '$Username' AND Pass = '$Pass' ");
    $row = mysqli_fetch_array($select);

    if(is_array($row)){
        $_SESSION["Username"] = $row['Username'];
        $_SESSION["Pass"] = $row['Pass'];
    }
        else {
            echo '<script type = "text/javascript">';
            echo 'alert("Invalid Username or Password!");';
            echo 'window.location.href = "adminlogin.php" ';
            echo '</script>';
        }
    }

    if(isset($_SESSION["Username"])){
        header("Location:admin.php");
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iGurukul</title>

    <!-- swiper css  -->
    <link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- style fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- css link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    
    <?php 
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span> '.$message.' </span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    ';
}
        
}
?>


<!-- header section starts -->
<header class="header">

    <section class="flex">

        <a href="index.php" class="logo">iGurukul</a>

        <nav class="navbar">
            <a href="index.php">home</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

</header>

<!-- header section ends -->

<!-- home section starts -->

<section class="home" id="home">

<div class="row">

    <div class="content">
        <h3>admin <span>login</span></h3>
    </div>
    
</div>

</section>
<!-- home section end -->

<!-- login section starts -->
<section class="login" id="login">

    <!-- <h1 class="heading">Admin <span>login</span></h1> -->
    
    <div class="row">
        
        
        <div class="image">
            <img src="images/login-img.svg" alt="login">
        </div>
        
        <form action="adminlogin.php" method=post>
            
            <span>username</span>
            <input id="login" type="text" required placeholder="Enter Your Username" maxlength="50" name="Username" class="box" >
            <span>password</span>
            <input id="login" type="password" required placeholder="Enter Your Password" maxlength="20" name="Pass" class="box" >
            <input type="submit" value="Login" class="btn" id="btn" name="login">
            
        </form>
    </div>
        
</section>
    <!-- login section ends -->

    <!-- footer section starts -->

    <footer class="footer">

    <section>

        <div class="share">

            <a href="https://www.facebook.com/people/Prajyot-Khopte/pfbid0BaApTLGGAwhwnsom9TLcVh7RsvwGvEnrNtpMVddh8osGenTaHxwNo2LPDdUqbZQUl/?mibextid=ZbWKwL" id="" class="fab fa-facebook-f"></a>
            <a href="#" id="" class="fab fa-twitter"></a>
            <a href="#" id="" class="fab fa-linkedin"></a>
            <a href="https://www.instagram.com/iamyogeshkhorwal/" id="" class="fab fa-instagram"></a>
            <a href="#" id="" class="fab fa-youtube"></a>
        </div>

        <div class="credit">developed by <span>mr. yogesh khorwal </span>& <span>mr. prajyot khopte</span> </div>
    
    </section>

</footer>

<!-- footer section ends -->

        <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
 
 
        <!-- js file link -->
    <script src="js/script.js"></script>

</body>