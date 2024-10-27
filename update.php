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
        $message[] = 'already sent message!';
    }
    else{
        $insert_message = $conn->prepare("INSERT INTO `tb_student`(Username, Pass) VALUES(?,?)");
        $insert_message->execute([$Username, $Pass]);
        $message[] = 'message sent successfully!';
   
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    
      <!-- swiper css  -->
    <link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- style fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- css link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="students" id="students">
    <h1 class="heading">students <span>panel</span></h1>
    <div class="newuser">
        <div class="row">
            <h4 class="heading">add <span>user</span></h4>

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
    </div>

    <div class="Rusers"></div>




</section>
</body>
</html>