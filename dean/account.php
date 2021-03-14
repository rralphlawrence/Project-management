<?php
    include_once '../includes/dbprocess.php';

    if(isset($_SESSION['nameHolder'])){
        if($_SESSION['usertypeHolder'] == 'Dean'){
            //wala na header dito kasi nasa dean side na naman tayo
        }
        else if($_SESSION['usertypeHolder'] == 'Professor'){
            header("Location: ../professor/dashboard.php");
        }else{
            header("Location: ../admin/dashboard.php");
        }
    }else{
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../app.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../styles/dean.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="shortcut icon" type="image/png " href="../img/fmsURST.png">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <title>FMS | DEAN</title>
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="side-logo">
            <h2><span id="logo" class ="fab fa-atlassian "></span><span>File Management</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <div class="user-naming" id="naming">
                <i id="icon" class='bx bx-user-circle nav__icon' ></i>
                <?php $nameHolder = $_SESSION['nameHolder']; ?>
                <h5><?php echo $nameHolder ?></h5>
                <h4>DEAN</h4>
               
            </div>
            <ul>
                <li>
                    <a href="dashboard.php"><span class="bx bxs-dashboard"></span><span>Dashboard</span></a>
                </li>
            
                <li>
                    <a href="#"  class="active"><span class="bx bx-user-pin"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="imported-files.php"><span class="bx bx-file"></span><span>Imported Files</span></a>
                </li>
                <li>
                    <a href="faculties.php"><span class="bx bxs-face"></span><span>Faculties</span></a>
                </li>
                <li>
                    <a href="task.php"><span class="bx bx-bookmark"></span><span>Tasks</span></a>
                </li>
                <li>
                    <a href="generate-report.php"><span class="bx bxs-report"></span><span>Reports</span></a>
                </li>
                <li>
                    <a href="logout.php"><span class="bx bx-log-out"></span><span>Logout</span></a>
                </li>
               
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
        
                <label for="nav-toggle" id="bars">
                    <span class="fas fa-bars"></span>
                </label>
                Account
            </h2>
            
            
          
            <div class="user-wrapper">
                <i class='bx bx-user-circle nav__icon' ></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
                <div class="illustration">
                    <div class="background">
                   <img class="pic" src="../img/hellodean.png" alt="">
                    </div>
                    <div class="create">
                        
                        <p>Hello Dean ! <br> you can customize your account</p>
                     
                    </div>
                </div>
                    <div class="update-profile">

                    <?php
                            $query = "SELECT p.Employee_ID, p.Fullname, p.Sex, p.Birthdate, p.ContactNo, p.Email, a.Password, a.User_Type FROM tblprofiles p, tblaccounts a  WHERE  a.Fullname = '$nameHolder' AND  p.Fullname = '$nameHolder'";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                    ?>  

                        <div class="heading-name">
                        <h2><?= $row['Fullname']; ?></h2>
                            <small>Dean</small>
                            <button class="btn-open" id="setmobe"><i class="far fa-edit">Edit account</i></button>
                        </div>
                        <div class="information">
                            <div class="profile-body">
                                  <small>EMPLOYEE ID</small>
                                    <h3><?= $row['Employee_ID']; ?></h3>
                            </div>
                            <div class="profile-body">
                                <small>CONTACT NUMBER</small>
                                  <h3><?= $row['ContactNo']; ?></h3>
                          </div>
                          <div class="profile-body">
                            <small>EMAIL</small>
                              <h3><a href= "https://accounts.google.com/ServiceLogin/signinchooser?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" target="_blank"><?= $row['Email']; ?></a> </h3>
                      </div>
                      <div class="profile-body">
                        <small>PASSWORD</small>
                          <h3>************</h3>
                  </div>
                        </div>
                    </div>
                    
                    <div class="profile-modal">
                        <div class="profile-bg">

                            <div class="heading">
                                <h3>Edit Account</h3>
                                <button  class="close_multi">&times;</button>
                            </div>
                            <div class="small">
                             <h5>Complete the form and save your data</h5> 
                            </div>
        
                        <form action="../includes/dbprocess.php" method="POST">
                            <div class="wrapper">
                            <div class="input-data">
                                <input type="hidden" name = "FullnameOld" value="<?= $row['Fullname']; ?>" required>
                                <input type="text" name = "Fullname" value="<?= $row['Fullname']; ?>" required>
                                <div class="underline">
                        </div>
                        <label>Full name</label>
                        </div>
                            
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input type="hidden" name = "Emp_IDOld" value="<?= $row['Employee_ID']; ?>" required>    
                                <input type="text" name = "Emp_ID" value="<?= $row['Employee_ID']; ?>" required>
                                <div class="underline">
                        </div>
                        <label>Employee ID</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input type="text" name = "Email" value="<?= $row['Email']; ?>" required>
                                <div class="underline">
                        </div>
                        <label>Email</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input type="text" name = "ContactNo" value="<?= $row['ContactNo']; ?>" required>
                                <div class="underline">
                        </div>
                        <label>Contact No.</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input type="date" name = "Birthdate" value="<?= $row['Birthdate']; ?>"required>
                                <div class="underline">
                        </div>
                       
                            </div>
                            <label>Birthdate</label>
                        </div>
                        
                        <div class="wrapper">
                            <div class="input-data">
                                <input type="text" name = "Password" value="<?= $row['Password']; ?>" required>
                                <div class="underline">
                              
                        </div>
                        <label>Password</label>
                            </div>
                            
                        </div>

                        <script type="text/javascript">

                        $(document).ready(function(){
                            $("#SEX").val("<?= $row['Sex']; ?>");
                            
                        });
                        </script>

                        <div class="wrapper gender">
                            <div class="input-data ">
                           <select name="Sex" id="SEX">
                               <option value="" disabled selected>Sex</option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                           </select>
                            </div>
                         </div>

                         <script type="text/javascript">

                            $(document).ready(function(){
                                $("#AccountType").val("<?= $row['User_Type']; ?>");
    
                            });
                        </script>

                         <div class="wrapper usertype">
                            <div class="input-data">
                           <select name="AccountType" id="AccountType">
                            <option value="" disabled selected>User Type</option>
                            <option value="Dean">Dean</option>
                            <option value="Professor">Professor</option> </select>
                           </select>
                            </div>
                         </div>
                            <div class="submite">
                                <div class="data">      
                                 <button type='submit' name="editprofile"><i class="fas fa-user-plus"></i> SAVE CHANGES</button>
                            </div>
                           
                                </div>
                        </div>
                        
                        </form>
                        </div>
                        
                    </div>

                    <script>

                    var modalBtn = document.querySelector('.btn-open');
                    var modals = document.querySelector('.profile-modal');
                    var modalCl = document.querySelector('.close_multi')

                    modalBtn.addEventListener('click' , function(){
                    modals.classList.add('profile-actives');
                    });

                    modalCl.addEventListener('click', function (){
                     modals.classList.remove('profile-actives');
                    });
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
        </main>
    </div>
    </body>
</html>