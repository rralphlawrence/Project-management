<?php
    include_once '../includes/dbprocess.php';


    if(isset($_SESSION['nameHolder'])){
        if($_SESSION['usertypeHolder'] == 'Dean'){
            header("Location: ../dean/dashboard.php");
        }
        else if($_SESSION['usertypeHolder'] == 'Professor'){
            header("Location: ../professor/dashboard.php");
        }else{
            //wala ng header kasi nasa admin naman na tong page na to
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
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../app.js" defer></script>
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" type="image/png " href="../img/fmsURST.png">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <title>FMS | ADMIN</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
.user-naming {
  display: block;
  text-align: center;
  padding: 2rem;
  color: #fff;
}

.user-naming h5 {
  font-weight: normal;
  font-size: 1.4rem;
}

.user-naming i {
  font-size: 4rem;
  color: #fff;
}
</style>

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
                <h4>ADMINISTRATOR</h4>
               
            </div>
            <ul>
                <li>
                    <a href="#" class="active"><span class="fas fa-user-shield"></span><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="account.php"><span class="fas fa-user-cog"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="imported-files.php"><span class="fas fa-file-alt"></span><span>Imported Files</span></a>
                </li>
                <li>
                    <a href="database.php"><span class="fas fa-database"></span><span>Database</span></a>
                </li>
                <li>
                    <a href="logout.php"  ><span class="fas fa-sign-out-alt"></span><span>Logout</span></a>
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
                Dashboard
            </h2>
            
            <div class="user-wrapper" onclick="myFunction();">
            <i class="far fa-user-circle" style="font-size:2rem;"></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-single one">
                    <div>
                        <h2>Welcome back admin!</h2>
                        <Span id="SPAN">Monitor and optimize your users</Span>
                    </div>
                    <div>
                        <img id="welcome" src="../img/welcom.png" alt="">

                    </div>
                </div>
                <div class="card-single two">
                    <div>

                    <?php
                    $query = "SELECT COUNT(Employee_ID) AS Total_User FROM tblaccounts WHERE NOT User_Type = 'Admin'";    
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    ?>  
                        <h2><?= $row['Total_User']; ?></h2>
                        <Span>USERS</Span>
                    </div>
                    <div>
                        <span class="fas fa-users"></span>
                    </div>
                </div>
                <div class="card-single three">
                    <div>

                    <?php
                    $query = "SELECT COUNT(File) AS Total_Files FROM tblfiles WHERE Status = 'OVERDUE' OR Status = 'ON TIME'";    
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    ?>  

                    <h2><?= $row['Total_Files']; ?></h2>
                        <Span>FILES</Span>
                    </div>
                    <div>
                        <span class="fas fa-file-alt"></span>
                    </div>
                </div>
                <div class="card-single four">
                    <div>
                        <h2><?php echo date("d")?></h2>
                        <Span><?php echo  date('F', mktime(0, 0, 0, date("m"), 10)); 
                               echo  " "  . date("Y"); ?></Span>
                    </div>
                    <div>
                        <span class="fas fa-calendar-alt"></span>
                    </div>
                </div>
            </div>    
            </div>




            
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