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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/prof.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
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
                    <a href="dashboard.php"><span class="bx bxs-dashboard"></span><span>Dashboard</span></a>
                </li>
            
                <li>
                    <a href="account.php" ><span class="bx bx-user-pin"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="imported-files.php" ><span class="bx bx-file"></span><span>Imported files</span></a>
                </li>
               
                <li>
                    <a href="#" class="active"><span class="bx bx-bookmark"></span><span>Task</span></a>
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
                Tasks
            </h2>
            
            
           
            <div class="user-wrapper">
                <i class='bx bx-user-circle nav__icon' ></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
               
            <div class="cover-task">
                <div class="background">
               <img class="pic" src="../img/task.png" alt="">
                </div>
                <div class="task-word">
                    
                    <p>Monitor your task </p>
                 
                </div>
            </div>
          
            <table class="table users"  >
            <?php
            $query = "SELECT * FROM tblfiles WHERE Status = 'IN PROGRESS' AND Author = '$nameHolder' ";    
            $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
            ?> 
                <thead>
                    <th>ID</th>
                    <th>FILE</th>
                    <th>COURSE</th>
                    <th>DEAN</th>
                    <th>DEADLINE</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td data-label="ID"> <?= $row['File_ID']; ?> </td>
                        <td data-label="FILE"> <?= $row['File']; ?> </td>
                        <td data-label="COURSE">  <?= $row['Course']; ?> </td>
                        <td data-label="DEAN">  <?= $row['Dean']; ?>  </td>
                        <td data-label="DEADLINE">  <?= $row['Date_Scheduled']; ?> </td>
                        <td data-label="STATUS"><small class='inprog'> <?= $row['Status']; ?> </small></td>
                        <td data-label="ACTIONS">
                        <form action="../includes/dbprocess.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="fileuploadforprof" class="upload-bx"> 
                            <input type="hidden" name = "fileID" value="<?= $row['File_ID']; ?>" required>
                            <button type="submit" name="uploadprof"><i id="download" class="fas fa-upload"></i></button>
                        </form>  
                        </td>
                    </tr>
                    <?php } ?>    
                 
            </tbody>
    </table>
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