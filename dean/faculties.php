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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/dean.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="shortcut icon" type="image/png " href="../img/fmsURST.png">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.css">
    <title>FMS | DEAN</title>

    <style>
    .activestat {
  background: green;
  padding: .6rem 1.2rem;
  border-radius: 6px;
  color: #fff;
  font-weight: 600;
}

.inactivestat {
  background: #6d1717;
  padding: .6rem .9rem;
  border-radius: 6px;
  color: #fff;
  font-weight: 600;
}
    
    </style>


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
                    <a href="#"  class="active"><span class="bx bxs-face"></span><span>Faculties</span></a>
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
                Faculties
            </h2>
            
           
            <div class="user-wrapper" onclick="myFunction();">
                <i class='bx bx-user-circle nav__icon' ></i>
            <div>
               
            </div>
            </div>
        </header>
        <main>
               
            <div class="cover">
                <div class="background">
               <img class="pic" src="../img/faculty.png" alt="">
                </div>
                <div class="create">
                    
                    <p>Find your collegues</p>
                 
                </div>
            </div>
                   
            <div class="files">
                <form method="POST" >
                    <div class="tbl" id="fls">

                    <div class="search" id="search">
                                <button class="open-faculty" type="button"><i class='bx bxs-user-plus'></i>RECRUIT</button>
                            </div>
                        <div class="search" id="search">
                            <button class="btn2" name="show" type="submit"><span class='fas fa-search'></span>SEARCH</button>
                        </div>
                       <div class="inner">
                                
                                <div class="file"> 
                                 
                                    <select name="semester" id="semester">
                                    <option value="">SEMESTER</option>
                                    <option value="First">FIRST</option>
                                    <option value="Second">SECOND</option>
                                   
                                    </select>
                                </div>
                             </div>
                             <div class="inner">
                                <div class="file">
                                <?php
                                $query = "SELECT DISTINCT School_Year FROM tblfaculty WHERE Dean='$nameHolder' ORDER BY School_Year ASC";    
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                ?>  
                                    <select name="sy" id="schoolyear">
                                    <option value="">SCHOOL YEAR</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['School_Year']; ?>"><?= $row['School_Year']; ?></option>
                                <?php } ?>  
                                </select>
                                </div>
                            </div>
                           
                          
                    </div>
                </form>
            </div>


            <?php       

                  

                    if(isset($_POST['show'])){
                    $sy = $_POST['sy'];
                    $semester = $_POST['semester'];

                    $query = "SELECT a.Faculty_ID, a.Fullname, p.Sex, p.ContactNo, p.Email , s.Status FROM tblprofiles p, tblfaculty a, tblaccounts s  WHERE  (a.Fullname = p.Fullname AND  s.Fullname = p.Fullname) AND  (a.Dean = '$nameHolder' AND a.School_Year = '$sy' AND a.Semester = '$semester') ORDER BY a.Faculty_ID ASC";    
                    $stmt = $conn->prepare($query);
                    $stmt-> execute();
                    $result = $stmt->get_result();  
                    
             ?>           
            <table class="table users" >
               
                <thead>
    
                    <th>ID</th>
                    <th>FULLNAME</th>
                    <th>SEX</th>
                    <th>CONTACT NO</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                  
                   
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td data-label="ID"><?= $row['Faculty_ID'] ?></td>
                        <td data-label="FULL NAME"><?= $row['Fullname'] ?></td>
                        <td data-label="SEX"><?= $row['Sex'] ?></td>
                        <td data-label="CONTACT NO"><?= $row['ContactNo'] ?></td>
                        <td data-label="EMAIL"><?= $row['Email'] ?></td>
                        <td data-label="STATUS">
                        
                        <small class="<?php
                        if($row['Status'] == 'ACTIVE'){
                            ?><?= 'activestat' ?> 
                        <?php    
                        }else{
                            ?><?= 'inactivestat' ?> <?php   }      
                        ?>"><?= $row['Status']; ?></small>
                        </td>
                        <td data-label="ACTIONS">
                        <a href="javascripit:void(0)" class="deletefiles-confirm"><i id="trash" class="fas fa-trash-alt"></i></a>
                        </td> 
                    </tr>
                   
                <?php } }?> 
            </tbody>
    </table>
    
           
                    <div class="faculty-modal">
                        <div class="faculty-bg">
                            <div class="heading">
                                <h3>Recruit your collegues</h3>
                                <button  class="exit">&times;</button>
                            </div>
                            <div class="small">
                             <h5>Complete the form to add an recipients</h5> 
                            </div>
        
                        <form action="../includes/dbprocess.php" method = "POST">
                            <div class="wrapper">
                            <div class="input-data">
                                <input type="text" name="sy" required>
                                <div class="underline">
                        </div>
                        <label>SCHOOL YEAR</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <select name="semester" required>
                                    <option value="" disabled selected>SELECT SEMESTER</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option> </select>
                                <div class="underline">
                                
                        </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">

                            <?php
                                    $query = "SELECT DISTINCT Fullname FROM tblaccounts WHERE Status='Active' AND User_Type = 'Professor' ORDER BY Fullname ASC";    
                                    $stmt = $conn->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                ?>  

                                <select name="professor" required>
                                    <option value="" disabled selected>SELECT PROFESSOR</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <option value="<?= $row['Fullname']; ?>"><?= $row['Fullname']; ?></option>
                                    <?php } ?>  
                                    </select>
                                <div class="underline">
                        </div>
                            </div>
                        </div>
                        
                        <div class="wrapper">
                            <div class="input-data button">
                            <button type="submit" class="recruit" name="add_faculty"> <i class='bx bxs-user-detail'></i>RECRUIT </button>
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

        </main>
    </div>
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
     title: "Are you sure to delete this faculty?",
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
            "deletefiles_btn_confirmfordeanfaculty":1,
            "deletefiles_id_confirmfordeanfaculty": deleteid,
        },
     success: function(result){
        swal({
            title: "Successfully Faculty Deleted!",
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