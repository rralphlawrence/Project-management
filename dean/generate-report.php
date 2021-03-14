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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../styles/dean.css">
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
                    <a href="account.php" ><span class="bx bx-user-pin"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="imported-files.php" ><span class="bx bx-file"></span><span>Imported Files</span></a>
                </li>
                <li>
                    <a href="faculties.php"  ><span class="bx bxs-face"></span><span>Faculties</span></a>
                </li>
                <li>
                    <a href="task.php"><span class="bx bx-bookmark"></span><span>Tasks</span></a>
                </li>
                <li>
                    <a href="#"  class="active"><span class="bx bxs-report"></span><span>Reports</span></a>
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
                Reports
            </h2>
            
            
            
            <div class="user-wrapper" onclick="myFunction();">
                <i class='bx bx-user-circle nav__icon' ></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
               
            <div class="cover-task generate">
                <div class="background">
               <img class="pic" src="../img/generate.png" alt="">
                </div>
                <div class="task-word">
                    
                    <p>Generate your tabular data</p>
                 
                </div>
            </div>

           <form action="reports.php" method = "POST" target="_blank">
           <div class="flex-container">
                <div class="card">
                    <div class="circle">
                            <h4>School year</h4>
                    </div>
                    <div class="contents">
                        <p>Choose school year for your desire output</p>

                        <?php

                                $query = "SELECT DISTINCT School_Year FROM tblfiles WHERE Dean='$nameHolder' ORDER BY School_Year ASC";    
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                        ?>  
                            <select name="sy" id="sy">
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['School_Year']; ?>"><?= $row['School_Year']; ?></option>
                                <?php } ?>  
                            </select>
                    </div>
                </div>
                <div class="card">
                    <div class="circle">
                            <h4>Semester</h4>
                    </div>
                    <div class="contents">
                        <p>Choose semester for your desire output</p>
                        <select name="semester" id="semester">
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="circle">
                            <h4>Print</h4>
                    </div>
                    <div class="contents">
                        <p>Print data from your records select semester and year first</p>
                        <button type="submit" name="print" >PRINT</button>
                    </div>
                </div>

           </div>
        </form>

        </main>
    </div>
    </body>
</html>