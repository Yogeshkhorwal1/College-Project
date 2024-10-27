<?php
session_start();
?>

<?php 

$db_name = 'mysql:host=localhost;dbname=contact_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name,$user_name,$user_password);

if(isset($_POST['send'])){

    $Username = $_POST['Username'];
    $Username = filter_var($Username, FILTER_SANITIZE_STRING);
    $Pass = $_POST['Pass'];
    $Pass = filter_var($Pass, FILTER_SANITIZE_STRING);

    $select_contact = $conn->prepare("SELECT * FROM `tb_student` WHERE Username = ? AND Pass = ? ");
    $select_contact->execute([$Username, $Pass]);

    if($select_contact->rowCount()> 0){
        $message[] = 'User already added!';
    }
    else{
        $insert_message = $conn->prepare("INSERT INTO `tb_student`(Username, Pass) VALUES(?,?)");
        $insert_message->execute([$Username, $Pass]);
        $message[] = 'User Added successfully!';
   
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
     <!-- swiper css  -->
     <link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- style fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- css link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        th{
            color: var(--green);
            font-size: 2rem;
        }
        td{
            color: var(--white);
            font-size: 2rem;
        }
        .col .fa{
            color: lightgreen;
            font-size: 2rem;
            padding: 0 1rem 0 1rem;
        }

        a{
            text-decoration: none;
        }
    


    </style>


    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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

        <a href="#home" class="logo">iGurukul</a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#students">students</a>
            <a href="#contact">contact</a>
            <a href="adminlogout.php">Logout!</a>

        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

</header>

<!-- header section ends -->

<!-- home section starts -->

<section class="home" id="home">

<div class="row">

    <div class="content">
        <h3>admin <span>portal</span></h3>
        <a href="#contact" class="btn">contact</a>
    </div>
    
    <div class="image">
        <img src="images/home-img.svg" alt="home_image">
    </div>
</div>

</section>
<!-- home section end -->
<section class="crud">

    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="heading" id="students" >STUDENT <span>ids</span></h2>
                        
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tb_student";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id="tab" class="table table-bordered table-striped">';
                            echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Id</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Password</th>";
                                    echo "<th>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        echo "<td>" . $row['Pass'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    // mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</section>

<!-- students section starts -->

<section class="students">
    <h1 class="heading">create <span>new id <span></h1>
        <div class="row">
        

             <div class="image">
              <img src="images/contact-img.svg" alt="">
            </div>

            <form action="admin.php" method="post">
                <span>Username</span>
                <input type="email"required placeholder="Username" maxlength="50" name="Username" class="box">
                <span>Password</span>
                <input type="text"required placeholder="Password" id="students" maxlength="50" name="Pass" class="box">
                
                <input type="submit" value="add user" class="btn" id="btn" name="send">
            </form>
        </div>

    
</section>


<section class="crud">

    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="heading" id="contact" >Contact <span>info</span></h2>
                        
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM contact_form";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id="tab" class="table table-bordered table-striped">';
                            echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Id</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Number</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Courses</th>";
                                    echo "<th>Gender</th>";
                                    echo "<th>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['number'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['courses'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="Contactdel.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</section>


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
</html>