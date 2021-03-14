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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/dean.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <link rel="shortcut icon" type="image/png " href="../img/fmsURST.png">
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
                    <a href="#" class="active"><span class="bx bx-bookmark"></span><span>Tasks</span></a>
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
                    
                    <p>Create task for your collegues</p>
                 
                </div>
            </div>
                   
            <div class="files">
                <form >
                    <div class="task" id="fls">

            
                            <div class="search " id="search">
                                <button class="open-faculty" type="button"><i class='bx bxs-detail'></i>ASSIGN TASK</button>
                            </div>

                            <div class="search " id="search">
                                <button class="open-mytask" type="button"><i class='bx bx-task'></i>MY TASK</button>
                            </div>
                    </div>
                </form>
            </div>

            <table class="table users"  >
            <?php
            $query = "SELECT * FROM tblfiles WHERE Status = 'IN PROGRESS' AND Dean = '$nameHolder' ";    
            $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
            ?> 
                <thead>
                    <th>ID</th>
                    <th>FILE</th>
                    <th>AUTHOR</th>
                    <th>COURSE</th>
                    <th>DEADLINE</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td data-label="ID"> <?= $row['File_ID']; ?> </td>
                        <td data-label="FILE"> <?= $row['File']; ?> </td>
                        <td data-label="AUTHOR">  <?= $row['Author']; ?>  </td>
                        <td data-label="COURSE">  <?= $row['Course']; ?> </td>
                        <td data-label="DEADLINE">  <?= $row['Date_Scheduled']; ?> </td>
                        <td data-label="STATUS"><small class='inprog'> <?= $row['Status']; ?> </small></td>
                        <td data-label="ACTIONS">
                        <a href="javascripit:void(0)" class="delete-confirm"><i id="trash" class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php } ?>    
                 
            </tbody>
    </table>
    <div class="yourtask-modal">
        <div class="your-bg">
    
            <div class="heading">
                <h3>Upload your File</h3>
                <button  class="btn-exit">&times;</button>
            </div>
            <div class="small">
             <h5>Complete the form to add an recipients</h5> 
            </div>
    
                <form action="../includes/dbprocess.php" method="POST" enctype="multipart/form-data">
                <div class="wrapper">
                                       

                    <div class="wrapper">
                        <div class="input-data">
                            <input type="text" name="courseforyou" >
                           
                  
                    <label for="schedule">Course</label>
                        </div>
                    </div>
    
        <div class="wrapper">
            <div class="input-data">
                <input type="date" id="scheduleforyou" name="scheduleforyou" >
               
      
        <label for="schedule">Dute date</label>
            </div>
        </div>

        <div class="input-data">
               <select name="file" id="file" required>
            <option value="" disabled selected>SELECT FILE</option>
                 </select> 
                            </div>
                                </div>
        <div class="wrapper">
            <div class="input-data">
                                <?php
                                $query = "SELECT DISTINCT School_Year FROM tblfaculty WHERE Dean='$nameHolder' ORDER BY School_Year ASC";    
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                ?>  
                                <select name="syforyou" id="schoolyearyou">
                                    <option value="">SELECT SCHOOL YEAR</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['School_Year']; ?>"><?= $row['School_Year']; ?></option>
                                <?php } ?>  
                                </select>
                <div class="underline">
                
        </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="input-data">
                <select name="semesterforyou" id = "semesterforyou" required>
                    <option value="" disabled selected>SELECT SEMESTER</option>
                    <option value="First">First</option>
                    <option value="Second">Second</option> 
                   </select>
                <div class="underline">
                
        </div>
            </div>
        </div>
        <div class="wrapper wrap">
            <div class="input-data button">
               <input type="file" name="fileuploadforyou" class="upload-bx">
        </div> 
        
        </div>
        <div class="wrapper">
            <div class="input-data button">
            <button class="upload-btn" type="submit" name="uploadyourfile"><i class='bx bxs-cloud-upload'></i>UPLOAD</button>
        </div>
    </form>
    </div>
    </div>
           
                    <div class="faculty-modal">
                        <div class="faculty-bg">

                            <div class="heading">
                                <h3>Assign your collegues</h3>
                                <button  class="exit">&times;</button>
                            </div>
                            <div class="small">
                             <h5>Complete the form to add an recipients</h5> 
                            </div>
        
                                <form action="../includes/dbprocess.php" method="POST">
                
                                    <div class="wrapper">
                                        <div class="input-data">
                                        <?php
                                        $query = "SELECT DISTINCT School_Year FROM tblfaculty WHERE Dean='$nameHolder' ORDER BY School_Year ASC";    
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        ?>  
                                            <select name="syforthem" id="syforthem">
                                            <option value="" disabled selected>SELECT SCHOOL YEAR</option>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                            <option value="<?= $row['School_Year']; ?>"><?= $row['School_Year']; ?></option>
                                            <?php } ?>  
                                            </select>
                                            <div class="underline">
                                            
                                    </div>
                                        </div>
                                    </div>
                    
                        <div class="wrapper">
                            <div class="input-data">
                                <select name="semesterforthem" id = "semesterforthem" required>
                                    <option value="" disabled selected>SELECT SEMESTER</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option> </select>
                                <div class="underline">
                        </div>
                            </div>
                        </div>

                        <div class="wrapper">
                                        <div class="input-data">
                                            <select name="profforthem" id="profforthem" required>
                                            <option value="" disabled selected>SELECT PROFESSOR</option>
                                                
                                            </select> 
                                        <div class="underline">
                                            
                                    </div>
                                        </div>
                                    </div>

                                    <div class="wrapper">
                                        <div class="input-data">
                                            <select name="file" id="file" required>
                                            <option value="" disabled selected>SELECT FILE</option>
                                                
                                            </select> 
                                        <div class="underline">
                                            
                                    </div>
                                        </div>
                                    </div>

                        <div class="wrapper">
                            <div class="input-data button">
                                <input type="text" name="courseforthem">
                                <div class="underline">
                                </div>
                        </div> 
                        <label for="">COURSE</label>
                        </div>
                      
                        <div class="wrapper">
                            <div class="input-data button">
                                <input type="date" id="scheduleforthem" name="scheduleforthem" >
                                <div class="underline">
                                </div>
                        </div> 
                        <label for="schedule">Dute date</label>
                        </div>
                        <div class="wrapper">
                            <div class="input-data button">
                            <button class="recruit" type="submit" name="setup"> <i class='bx bxs-user-detail'></i>SET UP</button>
                        </div> 
                    </form>
                    </div>
                </div>
                        <script>

                            var modalBtn = document.querySelector('.open-faculty');
                            var modals = document.querySelector('.faculty-modal');
                            var modalClose = document.querySelector('.exit')
                            
                            modalBtn.addEventListener('click' , function(){
                                modals.classList.add('faculty-active');
                            });
                            
                            modalClose.addEventListener('click', function (){
                                modals.classList.remove('faculty-active');
                            })

                            window.onclick = function(event) {
                            if (event.target == modals) {
                                modals.classList.remove('faculty-active');
                            }
                            }
                            
                        
                        </script>
                        <script>

                            var modalBtns = document.querySelector('.open-mytask');
                            var modal = document.querySelector('.yourtask-modal');
                            var modalClosed = document.querySelector('.btn-exit')
                            
                            modalBtns.addEventListener('click' , function(){
                                modal.classList.add('task-active');
                            });
                            
                            modalClosed.addEventListener('click', function (){
                                modal.classList.remove('task-active');
                            })

                            window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.classList.remove('task-active');
                            }
                            }
                            
                        
                        </script>


        <script>
		$(document).ready(function(){
			$("#semesterforthem").change(function(){
				var sy = $("#syforthem").val();
                var semester = $("#semesterforthem").val();
				$.ajax({
					type: "POST",
                    url: "../includes/dbprocess.php", 
                    data: {
                    "forprofselect":1,
                    "forprofselectsy": sy,
                    "forprofselectsemester": semester,
                },
                    dataType: "html",
                    success: function(data){
                    $('#books').empty();
                    $("#profforthem").html(data);
                }
				});
			});

            $("#syforthem").change(function(){
				var sy = $("#syforthem").val();
                var semester = $("#semesterforthem").val();
				$.ajax({
					type: "POST",
                    url: "../includes/dbprocess.php", 
                    data: {
                    "forprofselect":1,
                    "forprofselectsy": sy,
                    "forprofselectsemester": semester,
                },
                    dataType: "html",
                    success: function(data){
                    $('#books').empty();
                    $("#profforthem").html(data);
                }
				});
			});

		});
	</script>


<script>

$(document).ready(function () {

    $('.delete-confirm').on('click', function(e){

        e.preventDefault();

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        var id = data[0];
        

        swal({
         title: "Are you sure to delete this task?",
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
                "deletefiles_id_confirm": id,
            },
         success: function(result){
            swal({
                title: "Successfully Deleted the Task!",
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