<?php
    include_once '../includes/dbprocess.php';

    if(isset($_SESSION['nameHolder'])){
        if($_SESSION['usertypeHolder'] == 'Dean'){
            header("Location: ../dean/dashboard.php");
        }
        else if($_SESSION['usertypeHolder'] == 'Professor'){
          //wala na header kasi nasa professor side naman to
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
    <link rel="stylesheet" href="../styles/prof.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>FMS | PROFESSOR</title>
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
                <h4>PROFESSOR</h4>
               
            </div>
            <ul>
                <li>
                    <a href="#" class="active"><span class="bx bxs-dashboard"></span><span>Dashboard</span></a>
                </li>
            
                <li>
                    <a href="account.php"><span class="bx bx-user-pin"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="imported-files.php"><span class="bx bx-file"></span><span>Imported files</span></a>
                </li>
                <li>
                    <a href="task.php"><span class="bx bx-bookmark"></span><span>Task</span></a>
                </li>
                <li>
                    <a href="generate-report.php"><span class="bx bxs-report"></span><span>Report</span></a>
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
                Dashboard
            </h2>
            
            
            
            <div class="user-wrapper">
                <i class='bx bx-user-circle nav__icon' ></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
                <div class="cards">
                    <div class="card-1 card">
                        <div>
                            <h4>Welcome <br> Professor</h4>
                        </div>
                        <div>
                            <img src="../img/welc.png"   width="400px" height="300px" alt="">
                        </div>
                    </div>
                    
                    <div class="card-2 card">
                        <div class="count">
                        <?php
                            $query = "SELECT COUNT(File) AS Total_Files FROM tblfiles WHERE  Author = '$nameHolder' AND (Status = 'ON TIME' OR Status = 'OVERDUE')";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                        ?>  
                            <h2><?= $row['Total_Files']; ?><span><?php echo " "?> </span><span><i class='bx bx-file'></i></span></h2>
                        </div>
                        <div class="title">
                          <strong>Files</strong>
                        </div>
                    </div>
                    <div class="card-3 card">
                        <div class="count">
                        <?php
                            $query = "SELECT COUNT(Status) AS Files_Ontime FROM tblfiles WHERE  Author = '$nameHolder' AND Status = 'ON TIME'";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                        ?>  
                            <h2><?= $row['Files_Ontime']; ?><span><?php echo " "?> </span><span><i class="far fa-calendar-check"></i></span></h2>
                        </div>
                        <div class="title">
                            <strong> Submitted on time</strong>
                        </div>
                    </div>
                    <div class="card-4 card">
                        <div class="count">
                        <?php
                            $query = "SELECT COUNT(Status) AS Files_Overdue FROM tblfiles WHERE  Author = '$nameHolder' AND Status = 'OVERDUE'";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                        ?>  
                            <h2> <?= $row['Files_Overdue']; ?><span><?php echo " "?> </span><span><i class="fas fa-clock"></i></span></h2>
                        </div>
                        <div class="title">
                            <strong> Submitted late</strong>
                        </div>
                    </div>
                   
                    <div class="card-6 card">
                        <div class="count">
                            <h2><?php echo date("d")?><span><?php echo " "?> </span><span><i class='bx bxs-calendar'></i></span></h2>
                        </div>
                        <div class="title">
                            <strong><?php echo  date('F', mktime(0, 0, 0, date("m"), 10));?></strong>
                            <strong> <?php echo date("Y");?></strong>
                        </div>
                    </div>
                    <div class="card-7 card">
                        <div class="count">
                        <?php
                            $query = "SELECT COUNT(Status) AS Files_Inprogress FROM tblfiles WHERE  Author = '$nameHolder' AND Status = 'IN PROGRESS'";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                        ?>  

                            <h2> <?= $row['Files_Inprogress']; ?><span><?php echo " "?> </span><span><i class="fas fa-spinner"></i></span></h2>
                        </div>
                        <div class="title">
                            <strong> In progress</strong>
                        </div>
                    </div>
                </div>
          

        </main>
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

    </body>
</html>