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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../app.js" defer></script>
    <link rel="shortcut icon" type="image/png " href="../img/fmsURST.png">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/background.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>FMS | ADMIN</title>
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
            <h2><span class ="fab fa-atlassian "></span><span>File Management</span></h2>
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
                    <a href="dashboard.php"><span class="fas fa-user-shield"></span><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="account.php"><span class="fas fa-user-cog"></span><span>Account</span></a>
                </li>
                <li>
                    <a href="#" class="active"><span class="fas fa-file-alt"></span><span>Imported Files</span></a>
                </li>
                <li>
                    <a href="database.php"  ><span class="fas fa-database"></span><span>Database</span></a>
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
                Imported files
            </h2>
            
            
            
            <div class="user-wrapper">
            <i class="far fa-user-circle" style="font-size:2rem;"></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>

            <form method="POST">
                <div class="tbl-files" id="fls">
                   <div class="inner-tbl">
                            <div class="labels">
                              <label for="file-type">FILE</label>
                            </div>
                            <div class="file-type">

                            <?php
                            $query = "SELECT DISTINCT File FROM tblfiles ORDER BY File ASC";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>   
                                <select name="file" id="file">
                                <option value="">Select</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['File']; ?>"><?= $row['File']; ?></option>
                                <?php } ?>   
                                </select>
                            </div>
                         </div>
                         <div class="inner-tbl">
                            <div class="labels">
                              <label for="AUTHOR">AUTHOR</label>
                            </div>
                            <div class="file-type">
                            <?php
                            $query = "SELECT DISTINCT Author FROM tblfiles ORDER BY File ASC";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>  
                                <select name="author" id="author">
                                <option value="">Select</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['Author']; ?>"><?= $row['Author']; ?></option>
                                <?php } ?>  
                                </select>
                            </div>
                        </div>
                        <div class="inner-tbl">
                            <div class="labels">
                              <label for="COURSE">COURSE</label>
                            </div>
                            
                            <div class="COURSE">

                            <?php
                            $query = "SELECT DISTINCT Course FROM tblfiles ORDER BY File ASC";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>  

                                <select name="course" id="course">
                                <option value="">Select</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['Course']; ?>"><?= $row['Course']; ?></option>
                                <?php } ?>  
                                </select>
                            </div>
                        </div>
                        <div class="inner-tbl">
                            <div class="labels">
                              <label for="SY">SY</label>
                            </div>
                            <div class="file-type">
                            <?php
                            $query = "SELECT DISTINCT School_Year FROM tblfiles ORDER BY File ASC";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>  
                                <select name="sy" id="sy">
                                <option value="">Select</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['School_Year']; ?>"><?= $row['School_Year']; ?></option>
                                <?php } ?>  
                                </select>
                            </div>
                        </div>
                        <div class="inner-tbl">
                            <div class="labels">
                              <label for="SEMESTER">SEMESTER</label>
                            </div>
                            <div class="file-type">
                            <?php
                            $query = "SELECT DISTINCT Semester FROM tblfiles ORDER BY File ASC";    
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>  
                               <select name="semester" id="semester">
                               <option value="">Select</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['Semester']; ?>"><?= $row['Semester']; ?></option>
                                <?php } ?>  
                                </select>
                            </div>
                        </div>

                        <div class="search" id="search">
                            <button class="btn2" name="btnsearch" type="submit"><span class='fas fa-search'></span>SEARCH</button>
                        </div>
                </div>
            </form>
                
        <?php


        if(isset($_POST['btnsearch'])){

            $file = $_POST['file'];
            $author = $_POST['author'];
            $course = $_POST['course'];
            $sy = $_POST['sy'];
            $semester = $_POST['semester'];

            if($file !='' & $author =='' & $course =='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course =='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE Author = '$author' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course !='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE Course = '$course' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course =='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course =='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course =='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course !='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Course = '$course' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course =='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course =='' & $sy=='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course !='' & $sy=='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE Author = '$author' AND Course = '$course' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course =='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE Author = '$author' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course =='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE Author = '$author' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course !='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE Course = '$course' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course !='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE Course = '$course' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course =='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course !='' & $sy =='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND Course = '$course' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course =='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course =='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course !='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Course = '$course' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course !='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Course = '$course' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course =='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course !='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE  Author = '$author' AND Course = '$course' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course !='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE  Author = '$author' AND Course = '$course' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course =='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE  Author = '$author' AND School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author =='' & $course !='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE  Course = '$course' AND School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course !='' & $sy !='' & $semester ==''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND  Course = '$course' AND School_Year = '$sy' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course !='' & $sy =='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND  Course = '$course' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author =='' & $course !='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Course = '$course' AND  School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course =='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Author = '$author' AND  School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file =='' & $author !='' & $course !='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE Course = '$course' AND Author = '$author' AND  School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }
            else if($file !='' & $author !='' & $course !='' & $sy !='' & $semester !=''){
                $query = "SELECT * FROM tblfiles WHERE File = '$file' AND Course = '$course' AND Author = '$author' AND  School_Year = '$sy' AND Semester = '$semester' AND (Status = 'OVERDUE' OR Status = 'ON TIME') ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result();        
            }else{
                $query = "SELECT * FROM tblfiles WHERE Status = 'OVERDUE' OR Status = 'ON TIME' ORDER BY Date_Submitted DESC";    
                $stmt = $conn->prepare($query);
                $stmt-> execute();
                $result = $stmt->get_result(); 
            }

      
        ?> 
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>FILE</th>
                    <th>AUTHOR</th>
                    <th>COURSE</th>
                   <th>SCHOOL YEAR</th>
                   <th>SEMESTER</th>
                    <th>DEAN</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td data-label="ID"><?= $row['File_ID'] ?></td>
                        <td data-label="FILE"><?= $row['File']; ?></td>
                        <td data-label="AUTHOR"><?= $row['Author']; ?></td>
                        <td data-label="COURSE"><?= $row['Course']; ?></td>
                        <td data-label="YEAR-LEVEL"><?= $row['School_Year']; ?></td>
                        <td data-label="SEMESTER"><?= $row['Semester']; ?></td>
                        <td data-label="DEAN"><?= $row['Dean']; ?></td>
                        <td data-label="ACTIONS">
                        <a href="../includes/dbprocess.php?download-file=<?= $row['Path'];?>"><i id="download" class="fas fa-arrow-circle-down"></i></a><span></span>
                        <a href="javascripit:void(0)" class="deletefiles-confirm"><i id="trash" class="fas fa-trash-alt"></i></a>
                        </td> 
                    </tr>
                <?php } }?> 
                </tbody>
        </table>
        </main>



        <script>

    $(document).ready(function () {

        $('.deletefiles-confirm').on('click', function(e){

            e.preventDefault();

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            var deleteid = data[0];
            

            swal({
             title: "Are you sure to delete this file?",
             icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
                type: "POST",
                url: "../includes/dbprocess.php", 
                data: {
                    "deletefiles_btn_confirm":1,
                    "deletefiles_id_confirm": deleteid,
                },
             success: function(result){
                swal({
                    title: "Successfully File Deleted!",
                    icon: "success",
                }).then((result) => {
                    location.reload();
                });
            }
    });
       
    } 

    });
        });

    });

    </script>

        

      <!--  <div class="bg-modal" >
            <div class="modals">
                <div class="head">
                 
                    <h4>Administrator</h4>
                </div>
                <div class="options">
                    <ul>
                        <li><button> <span class="fas fa-cog"></span>Settings</button></li>
                        <li><button> <span class="fas fa-question-circle"></span>Help</button></li>
                        <li><button> <span class="fas fa-sign-out-alt"></span>Sign out</button></li>
                        <li><button class="close-button"> <span class="fas fa-times-circle"></span>Close</button></li>
                    </ul>
                </div>
               

            </div>
        </div> -->


       <div class="modal-back" id="myModal">
           <div class="modall">
               <div class="heading">
                   <h3>Are you sure you want to delete this file?</h3>
               </div>
               <div class="main-cont">
                   <h2>File ID: <span>25</span></h2>
               </div>
               <div class="yes">
                   <button type="submit"> YES</button>
                   <button class="cancel">CANCEL</button>
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
       
    
</body>
</html>