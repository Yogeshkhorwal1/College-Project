<?php 

$db_name = 'mysql:host=localhost;dbname=contact_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name,$user_name,$user_password);

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $courses = $_POST['courses'];
    $courses = filter_var($courses, FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);

    $select_contact = $conn->prepare("SELECT * FROM `contact_form` WHERE name = ? AND number = ? AND email = ? AND courses = ? AND gender = ?");
    $select_contact->execute([$name, $number, $email, $courses, $gender]);

    if($select_contact->rowCount()> 0){
        $message[] = 'already sent message!';
    }
    else{
        $insert_message = $conn->prepare("INSERT INTO `contact_form`(name, number, email, courses, gender) VALUES(?,?,?,?,?)");
        $insert_message->execute([$name, $number, $email, $courses, $gender]);
        $message[] = 'message sent successfully!';
   
    }
}
?>
<?php

session_start();
$conn = mysqli_connect('localhost','root','','contact_db') or die ('Unable to connect');

?>


<?php
    if (isset($_POST['login'])){
        $Username = $_POST['Username'];
        $Pass = $_POST['Pass'];

    $select = mysqli_query($conn,"SELECT * FROM tb_student WHERE Username = '$Username' AND Pass = '$Pass' ");
    $row = mysqli_fetch_array($select);

    if(is_array($row)){
        $_SESSION["Username"] = $row['Username'];
        $_SESSION["Pass"] = $row['Pass'];
    }
        else {
            echo '<script type = "text/javascript">';
            echo 'alert("Invalid Username or Password!");';
            echo 'window.location.href = "index.php" ';
            echo '</script>';
        }
    }

    if(isset($_SESSION["Username"])){
        header("Location:login.php");
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

        <a href="#home" class="logo">iGurukul</a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#courses">courses</a>
            <a href="#teachers">teachers</a>
            <a href="#placements">placements</a>
            <a href="#reviews">reviews</a>
            <a href="#contact">contact</a>
            <a href="#login" onclick="alert('Dear Student Login First!');" >lectures</a>
            <a href="#login">login</a>
            <a href="adminlogin.php">Admin</a>

        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

</header>
 <!-- header end -->
 
  <!-- home section starts -->

  <section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3>online <span>education</span></h3>
            <a href="#contact" class="btn">contact</a>
        </div>
        
        <div class="image">
            <img src="images/home-img.svg" alt="home_image">
        </div>
    </div>
    
  </section>
  <!-- home section end -->

    <!-- counter section starts -->
   
    <section class="count">
        <div class="box-container">

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <div class="content">
                    <h3>150+</h3>
                    <p>courses</p>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-user-graduate"></i>
                <div class="content">
                    <h3>1300+</h3>
                    <p>students</p>
                </div>
            </div>
            
            <div class="box">
                <i class="fas fa-chalkboard-user"></i>
                <div class="content">
                    <h3>80+</h3>
                    <p>teachers</p>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-face-smile"></i>
                <div class="content">
                    <h3>100%</h3>
                    <p>satisfaction</p>
                </div>
            </div>

        </div>
    </section>

    <!-- counter section ends -->

<!-- about section starts -->

 <section class="about" id="about">
    <div class="row">

        <div class="image">
            <img src="images/about-img.svg" alt="about_img">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, fugiat culpa quam blanditiis ipsa quas eius sunt! Aliquam eos optio maxime esse? Nesciunt, placeat eligendi.</p>
            <a href="#contact" class="btn">contact us</a>
        </div>

    </div>

 </section>

 <!-- about section end -->

 <!-- course section starts -->
<section class="courses" id="courses">

<h1 class="heading">our <span>courses</span></h1>

<div class="swiper course-slider">

    <div class="swiper-wrapper">
        
        <div class="swiper-slide slide">
            <img src="images/course-1.svg" alt="course1">
            <h3>web development</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>
       
        <div class="swiper-slide slide">
            <img src="images/course-2.svg" alt="course2">
            <h3>science and biology</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>

        <div class="swiper-slide slide">
            <img src="images/course-3.svg" alt="course3">
            <h3>graphic design</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>

        <div class="swiper-slide slide">
            <img src="images/course-4.svg" alt="course4">
            <h3>teaching</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>
        
        <div class="swiper-slide slide">
            <img src="images/course-5.svg" alt="course5">
            <h3>engineering</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>

        <div class="swiper-slide slide">
            <img src="images/course-6.svg" alt="course6">
            <h3>digital marketing</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum doloremque</p>
        </div>

    </div>
    <div class="swiper-pagination"></div>
</div>

</section>
 <!-- course section end -->

 <!-- teachers section starts -->

<section class="teachers" id="teachers">

    <h1 class="heading">expert <span>tutors</span></h1>

        <div class="swiper teachers-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/tutor-1.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>prem sir</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/tutor-2.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>gulab sir</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/tutor-3.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>priya</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/tutor-4.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>atul sir</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/tutor-5.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>suresh sir</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/tutor-6.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>rahul sir</h3>
                </div>

            </div>
                
            <div class="swiper-pagination"></div>

        </div>

</section>

 <!-- teachers section ends -->

<!-- placement section starts -->

<section class="placements" id="placements">

    <h1 class="heading">place<span>ments</span></h1>

        <div class="swiper placements-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/student-1.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>jr frontend dev in wipro</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/student-2.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>php developer in tech mahindra</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/student-3.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>jr backend engineer</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/student-4.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>software engineer in tcs</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/student-5.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>data analytics in capgemini</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/student-6.jpg" alt="sir">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>system engineer in tcs</h3>
                </div>

            </div>
                
            <div class="swiper-pagination"></div>

        </div>

</section>

<!-- placement section ends -->

 <!-- reviews section starts -->

 <section class="reviews" id="reviews">

    <h1 class="heading">student's <span>reviews</span></h1>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-1.jpg" alt="">
                    <div class="user-info">
                        <h3>vikas</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>            
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-2.jpg" alt="">
                    <div class="user-info">
                        <h3>rekha</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-3.jpg" alt="">
                    <div class="user-info">
                        <h3>hitesh</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-4.jpg" alt="">
                    <div class="user-info">
                        <h3>riya</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-5.jpg" alt="">
                    <div class="user-info">
                        <h3>sumit</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis doloribus eveniet possimus quis iure nam voluptas temporibus sed perspiciatis, obcaecati, repellendus cumque, itaque assumenda.</p>
                <div class="user">
                    <img src="images/pic-6.jpg" alt="">
                    <div class="user-info">
                        <h3>arnav</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>

    </div>

 </section>

 <!-- reviews section ends -->

<!-- contact section starts -->

<section class="contact" id="contact">
    <h1 class="heading">Contact<span> us</span></h1>

    <div class="row">

        <div class="image">
            <img src="images/contact-img.svg" alt="">
        </div>

        <form action="" method="post">
            <span>your name</span>
            <input type="text"required placeholder="enter your full name" maxlength="50" name="name" class="box">
            <span>your email</span>
            <input type="email"required placeholder="enter your valid email" maxlength="50" name="email" class="box">
            <span>your number</span>
            <input type="number"required placeholder="enter your valid number" min="999999999" maxlength="9999999999" min="0" name="number" class="box" onkeypress="if(this.value.length == 10) return false;">
            <span>select course</span>
            <select name="courses" class="box" required>
                <option value="disabled selected">select the course --</option>
                <option value="wev development">web development</option>
                <option value="science and biology">science and biology</option>
                <option value="engineering">engineering</option>
                <option value="digital maketing">digital maketing</option>
                <option value="graphic design">graphic design</option>
                <option value="teaching">teaching</option>
                <option value="social studies">social studies</option>
                <option value="data analysis">data analysis</option>
                <option value="artificial intelligence">artificial intelligence</option>
            </select>
            <span>slect gender</span>
            <div class="radio">
                <input type="radio" name="gender" value="male" id="male">
                <label for="male">male</label>
                <input type="radio" name="gender" value="female" id="female">
                <label for="female">female</label>
            </div>
            <input type="submit" value="send message" class="btn" id="btn" name="send">
        </form>
    </div>
</section>

<!-- contact section ends -->

<!-- login section starts -->
<section class="login" id="login">

    <h1 class="heading">student <span>login</span></h1>

    <div class="row">

        
        <div class="image">
            <img src="images/login-img.svg" alt="login">
        </div>
        
        <form action="index.php" method=post>
            
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
</html>