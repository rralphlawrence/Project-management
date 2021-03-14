<?php
    include_once './includes/dbprocess.php';

    if(isset($_SESSION['nameHolder'])){
        if($_SESSION['usertypeHolder'] == 'Dean'){
            //wala na header dito kasi nasa dean side na naman tayo
            header("Location: ../dean/dashboard.php");
        }
        else if($_SESSION['usertypeHolder'] == 'Professor'){
            header("Location: ../professor/dashboard.php");
        }else{
            header("Location: ../admin/dashboard.php");
        }
    }else{
       // header("Location: ../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="shortcut icon" type="image/png " href="./img/fmsURST.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="./boxicons/css/boxicons.css">

    <title>URS | File Management System</title>
</head>

<style>
    .swal-title{
        font-family: 'montserrat' ;
        font-weight: 600;
    }
</style>
<body>


    <nav class="navbar">
        <div class="logo">
            <a href="">
                 Dudith
            </a>
        </div>
        <a href="#" class="toggle-button"> 
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="# ">Contact</a></li>
            </ul>
        </div>
    </nav>
<!-- End of the Navigation bar laging ugaliing magcomment para sa ibang programmer-->

    <main>
        <section class="container">
            <div class="inner">
                <img  class="img1" src="./img/Ellipse 1.png" alt="eclipse">
                <img  class="img2" src="./img/Ellipse 1.png" alt="eclipse">
                <img  class="img3" src="./img/Ellipse 1.png" alt="eclipse">
                <img  class="img4" src="./img/Ellipse 1.png" alt="eclipse">
            </div>
            <div class="content">
                <div class="text">
                    <h2>Useful for teams to work 
                        collaborative <br>and productive</h2>
                        <p><i class="bx bx-check-circle" aria-hidden="true"></i>Write, plan and organized.</p>
                        <p><i class="bx bx-check-circle" aria-hidden="true"></i>Simple to use</p>
                        <p><i class="bx bx-check-circle" aria-hidden="true"></i>User friendly </p>
                        
                </div>
                <div class="cta">
                    <button data-modal-target="#modal" class="Signin"> <span>SIGN IN</span> </button>
                    
                </div>
                  
            </div>
            <div class="cover">
                <img src="./img/illu.png" alt="task">
            </div>
        </section>        
    </main>
        <!-- End of the Main section -->


         <!--Dito naman ung pop up modal para sa sign in at login page -->

         <div id="overlay" class="Modal-bg"> 
            <form class="modal" action="./includes/dbprocess.php" method="POST">
              
                <div class="header">
                    <div class="content">
                        
                        <button  class="close-button">&times;</button>
                    <h2> Sign in </h2>
                    <div class="radio">
                        <input type="radio" class="radio__input" value="Dean" name="myradio" id="myradio1">
                        <label class="radio__label" for="myradio1"> Dean </label>
                        <input type="radio" class="radio__input" value="Professor" name="myradio" id="myradio2">
                        <label class="radio__label" for="myradio2"> Faculty </label>
                        <input type="radio" class="radio__input" value="Admin" name="myradio" id="myradio3">
                        <label class="radio__label" for="myradio3"> M.I.S </label>
                    </div>
                    
                    
                </div>
                        </div>
                      
                        <div class="wrapper">
                            <div class="input-data username">
                              <input class="user" type="text" name="employeeid" id="em" required>
                              <div class="underline">
                      </div>
                      <label>Employee ID</label>
                            </div>
                            <div class="input-data password">
                                <input id="myInput" class="pass" type="password"  name ="password" id="pw" required>
                                <div class="underline">
                                    <div class="eye">
                                        <i onclick="myFunction()" class="bx bx-show"></i>
                                    </div>
                        </div>
                        <label>Password</label>
                              </div>
                             

                              <div class="submit">
                                <button type="submit" name="login"> LOGIN</button>
                             </div>
                             
                 
                </form>
         </div>

	
<script>


var modalButton = document.querySelector('.Signin');
var modalBG = document.querySelector('.Modal-bg');
var modalClose = document.querySelector('.close-button')

modalButton.addEventListener('click' , function(){
    modalBG.classList.add('bg-active');
});

modalClose.addEventListener('click', function (){
    modalBG.classList.remove('bg-active');
})
window.onclick = function(event) {
  if (event.target == modalBG) {
    modalBG.classList.remove('bg-active');
  }
}	


</script>
        
         
<?php 
            if (isset($_SESSION['response']) && $_SESSION['response'] !='') { ?>

            <script>
            swal({
                title: "<?php echo $_SESSION['response']?>",
                icon: "<?php echo $_SESSION['res_type']?>",
                button: "Done",
            });
            </script>
        
            <?php
                unset($_SESSION['response']); }
            ?>

    </body>
</html>