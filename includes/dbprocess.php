<?php


   
    session_start();
    include_once 'dbconnect.php';

    
    if(isset($_POST['login'])){
        $EmployeeID = $_POST['employeeid'];
        $Password = $_POST['password'];
        $UserType = $_POST['myradio'];

        $sqlforNoAccount = "SELECT Password FROM tblaccounts WHERE Employee_ID ='$EmployeeID'";
        $stmt = $conn->prepare($sqlforNoAccount);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
                $PasswordinDB = $row['Password'];
        }

        if(password_verify($Password,$PasswordinDB) || ($Password == $PasswordinDB) ){

            $sqlforNoAccount = "SELECT * FROM tblaccounts WHERE Employee_ID ='$EmployeeID' AND User_Type = '$UserType' ";
            $sqlrun = mysqli_query($conn, $sqlforNoAccount);

            if(mysqli_num_rows($sqlrun)>0){
                
                $sqlforNoAccount = "SELECT Fullname FROM tblaccounts WHERE Employee_ID ='$EmployeeID'";
                $stmt = $conn->prepare($sqlforNoAccount);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                $Fullname = $row['Fullname'];
                }

                $_SESSION ['nameHolder'] = $Fullname;
                $_SESSION ['usertypeHolder'] = $UserType;

                if($UserType == 'Dean'){
                    
                    $_SESSION ['response'] = "Successfully Login!";
                    $_SESSION ['res_type']= "success";
                  
                    header("Location: ../dean/dashboard.php");
                }
                elseif($UserType == 'Professor'){

                    $_SESSION ['response'] = "Successfully Login!";
                    $_SESSION ['res_type']= "success";
                    header("Location: ../professor/dashboard.php");

                }
                    elseif($UserType == 'Admin'){
                    $_SESSION ['response'] = "Successfully Login!";
                    $_SESSION ['res_type']= "success";
                    header("Location: ../admin/dashboard.php");
                }else{
                    $_SESSION ['response'] = "Please select your user type!";
                    $_SESSION ['res_type']= "warning";
                    header("Location: ../index.php");
                }
                
                
            }else{
                header("Location: ../index.php");
                $_SESSION ['response'] = "Please select your correct user type!";
                $_SESSION ['res_type']= "error";
            }

        }else{
            header("Location: ../index.php");
            $_SESSION ['response'] = "Please input your correct Employee ID and Password!";
            $_SESSION ['res_type']= "error";
        }

       
}
  
    if(isset($_POST['add_user'])){

    $EmpID = mysqli_real_escape_string($conn, $_POST['EmpID']);
    $Fullname = mysqli_real_escape_string($conn, $_POST['Fname'] . " " . $_POST['Lname']);
    $UserType = mysqli_real_escape_string($conn, $_POST['UserType']);
    $PassW = mysqli_real_escape_string($conn, password_hash ($_POST['PassW'],PASSWORD_DEFAULT));
    $DateC = mysqli_real_escape_string($conn, date("Y/m/d"));
    $Status = mysqli_real_escape_string($conn, "ACTIVE");

    $sqlforNoAccount = "SELECT * FROM tblaccounts WHERE Employee_ID ='$EmpID'";
    $sqlrun = mysqli_query($conn, $sqlforNoAccount);

    if(mysqli_num_rows($sqlrun)>0){
        header("Location: ../admin/database.php");
        $_SESSION ['response'] = "Employee ID Already Exists!";
        $_SESSION ['res_type']= "error";
    }else{

    $sqlforAccounts = "INSERT INTO tblaccounts (Employee_ID, Fullname, User_Type, Password, Status) VALUES (?,?,?,?,?);";
    $sqlforProfiles = "INSERT INTO tblprofiles (Employee_ID, Fullname, Position, Sex, Birthdate, ContactNo, Email, Date_Created, Last_Updated) VALUES (?,?,?,'','','','',?,?);";
    
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforAccounts)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"sssss",$EmpID,$Fullname,$UserType,$PassW,$Status);
        mysqli_stmt_execute($stmt);
    }

    if(!mysqli_stmt_prepare($stmt, $sqlforProfiles)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"sssss",$EmpID,$Fullname,$UserType,$DateC,$DateC);
        mysqli_stmt_execute($stmt);
    }
    

    header("Location: ../admin/database.php");
    $_SESSION ['response'] = "Successfully Added the Account!";
    $_SESSION ['res_type']= "success";
        
    }
    }


    if(isset($_POST['delete_btn_confirm'])){
		$EmpID=$_POST['delete_id_confirm'];

        $sqlforAccounts="DELETE FROM tblaccounts WHERE Employee_ID=?";
        $sqlforProfiles="DELETE FROM tblprofiles WHERE Employee_ID=?";

        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sqlforProfiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpID);
            mysqli_stmt_execute($stmt);
        }



        if(!mysqli_stmt_prepare($stmt, $sqlforAccounts)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpID);
            mysqli_stmt_execute($stmt);
        }

    }

    
    if(isset($_POST['deletefiles_btn_confirm'])){
		$ID=$_POST['deletefiles_id_confirm'];

        $sqlfordeletfiletask="DELETE FROM tblfiles WHERE File_ID=?";

        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sqlfordeletfiletask)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$ID);
            mysqli_stmt_execute($stmt);
        }

    }

    
    if(isset($_POST['deactivate_btn_confirm'])){
        $EmpID=$_POST['deactivate_id_confirm'];
        
        $sqlforAccounts="UPDATE tblaccounts SET Status = 'INACTIVE' WHERE Employee_ID=?";
        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sqlforAccounts)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpID);
            mysqli_stmt_execute($stmt);
        }
    }

    if(isset($_POST['activate_btn_confirm'])){
        $EmpID=$_POST['activate_id_confirm'];
        
        $sqlforAccounts="UPDATE tblaccounts SET Status = 'ACTIVE' WHERE Employee_ID=?";
        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sqlforAccounts)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpID);
            mysqli_stmt_execute($stmt);
        }

    }


    if(isset($_POST['reset_btn_confirm'])){
        $EmpID=$_POST['reset_id_confirm'];
        $ResetPW = mysqli_real_escape_string($conn,'resetpassword');
        $sqlforAccounts="UPDATE tblaccounts SET Password = '$ResetPW' WHERE Employee_ID=?";
        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sqlforAccounts)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpID);
            mysqli_stmt_execute($stmt);
        }

    }
    

    if(isset($_GET['download-file'])){
        $Path = $_GET['download-file'];

        $filepath = "../uploads/" . $Path;

        if(file_exists($filepath)){
            header('Content-Type: application/octet-stream');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename='.basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma:public');
            header('Content-Length:'. filesize('../uploads/'.$Path));

            readfile('../uploads/'.$Path);
           exit;
       
          
        }else{
            header("Location: ../admin/imported-files.php");
            $_SESSION['response']="File does not Exist!";
            $_SESSION['res_type']="error";
        }
       
    }

    if(isset($_GET['download-file-fordean'])){
        $Path = $_GET['download-file-fordean'];

        $filepath = "../uploads/" . $Path;

        if(file_exists($filepath)){
            header('Content-Type: application/octet-stream');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename='.basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma:public');
            header('Content-Length:'. filesize('../uploads/'.$Path));

            readfile('../uploads/'.$Path);
           exit;
       
          
        }else{
            header("Location: ../dean/imported-files.php");
            $_SESSION['response']="File does not Exist!";
            $_SESSION['res_type']="error";
        }
       
    }

    if(isset($_POST['deletefiles_btn_confirm'])){

        $FileID = $_POST['deletefiles_id_confirm'];

        $querydeletefile = "SELECT Path FROM tblfiles WHERE File_ID = '$FileID'";    
        $stmtd = $conn->prepare($querydeletefile);
        $stmtd->execute();
        $resultd = $stmtd->get_result();
        $rowd = $resultd->fetch_assoc();


        $Path = $rowd['Path'];
        $filepath = "../uploads/" . $Path;

        if(!unlink($filepath)){
           
            
        $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FileID);
            mysqli_stmt_execute($stmt);
         }
          
        }else{

        $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FileID);
            mysqli_stmt_execute($stmt);
         }
        }
    }


    if(isset($_POST['editadmin'])){

        $EmpID = mysqli_real_escape_string($conn, $_POST['Emp_ID']);
        $EmpIDOld = mysqli_real_escape_string($conn, $_POST['Emp_IDOld']);
        $Fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
        $FullnameOld = mysqli_real_escape_string($conn, $_POST['FullnameOld']);
        $Sex = mysqli_real_escape_string($conn, $_POST['Sex']);
        $ContactNo = mysqli_real_escape_string($conn, $_POST['ContactNo']);
        $Email = mysqli_real_escape_string($conn, $_POST['Email']);
        $PassW = $_POST['Password'];
        
    
        if(strlen($PassW) >=60){
    
        }else{
            $PassW = mysqli_real_escape_string($conn, password_hash ($_POST['Password'],PASSWORD_DEFAULT));
        }
    
        $DateU = mysqli_real_escape_string($conn, date("Y/m/d"));
    
        $sqlforNoAccount = "SELECT * FROM tblaccounts WHERE Employee_ID ='$EmpID' AND NOT Fullname = '$FullnameOld'";
        $sqlrun = mysqli_query($conn, $sqlforNoAccount);
    
        if(mysqli_num_rows($sqlrun)>0){
            header("Location: ../dean/account.php");
            $_SESSION ['response'] = "Employee ID Already Exists!";
            $_SESSION ['res_type']= "error";
        }else{
    
            $sqlforupdateaccount="UPDATE tblaccounts SET Employee_ID ='$EmpID', Fullname='$Fullname', Password='$PassW' WHERE Employee_ID = ?";
            $sqlforupdateprofile="UPDATE tblprofiles SET Employee_ID ='$EmpID', Fullname='$Fullname', Sex='$Sex', ContactNo='$ContactNo', Email='$Email', Last_Updated='$DateU' WHERE Employee_ID = ?";
            
            $stmt = mysqli_stmt_init($conn);
    
            
    
            if(!mysqli_stmt_prepare($stmt, $sqlforupdateaccount)){
                echo "SQL Error";
            }else{
                mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
                mysqli_stmt_execute($stmt);
            }
    
            if(!mysqli_stmt_prepare($stmt, $sqlforupdateprofile)){
                echo "SQL Error";
            }else{
                mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
                mysqli_stmt_execute($stmt);
            }
    
            
                header("Location: ../admin/account.php");
                $_SESSION ['response'] = "Successfully Updated the Account!";
                $_SESSION ['res_type']= "success";
                $_SESSION ['nameHolder'] = $Fullname;
        }    
    }





    if(isset($_POST['deletefiles_btn_confirmfordean'])){

        $FileID = $_POST['deletefiles_id_confirmfordean'];

        $querydeletefile = "SELECT Path FROM tblfiles WHERE File_ID = '$FileID'";    
        $stmtd = $conn->prepare($querydeletefile);
        $stmtd->execute();
        $resultd = $stmtd->get_result();
        $rowd = $resultd->fetch_assoc();


        $Path = $rowd['Path'];
        $filepath = "../uploads/" . $Path;

        if(!unlink($filepath)){
           
            
        $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FileID);
            mysqli_stmt_execute($stmt);
         }
          
        }else{

        $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FileID);
            mysqli_stmt_execute($stmt);
         }
        }
    }

    if(isset($_POST['deletefiles_btn_confirmfordeanfaculty'])){

        $FacultyID = $_POST['deletefiles_id_confirmfordeanfaculty'];

           
        $sqlforDeleteFaculty="DELETE FROM tblfaculty WHERE Faculty_ID=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFaculty)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FacultyID);
            mysqli_stmt_execute($stmt);
         }
          
    }


    if(isset($_POST['editprofile'])){

    $EmpID = mysqli_real_escape_string($conn, $_POST['Emp_ID']);
    $EmpIDOld = mysqli_real_escape_string($conn, $_POST['Emp_IDOld']);
    $Fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
    $FullnameOld = mysqli_real_escape_string($conn, $_POST['FullnameOld']);
    $Sex = mysqli_real_escape_string($conn, $_POST['Sex']);
    $Birthdate = mysqli_real_escape_string($conn, $_POST['Birthdate']);
    $UserType = mysqli_real_escape_string($conn, $_POST['AccountType']);
    $ContactNo = mysqli_real_escape_string($conn, $_POST['ContactNo']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $PassW = $_POST['Password'];

    if(strlen($PassW) >=60){

    }else{
        $PassW = mysqli_real_escape_string($conn, password_hash ($_POST['Password'],PASSWORD_DEFAULT));
    }

    $DateU = mysqli_real_escape_string($conn, date("Y/m/d"));

    $sqlforNoAccount = "SELECT * FROM tblaccounts WHERE Employee_ID ='$EmpID' AND NOT Fullname = '$FullnameOld'";
    $sqlrun = mysqli_query($conn, $sqlforNoAccount);

    if(mysqli_num_rows($sqlrun)>0){
        header("Location: ../dean/account.php");
        $_SESSION ['response'] = "Employee ID Already Exists!";
        $_SESSION ['res_type']= "error";
    }else{

        $sqlforupdateaccount="UPDATE tblaccounts SET Employee_ID ='$EmpID', Fullname='$Fullname', User_Type='$UserType', Password='$PassW' WHERE Employee_ID = ?";
        $sqlforupdateprofile="UPDATE tblprofiles SET Employee_ID ='$EmpID', Fullname='$Fullname', Position='$UserType', Sex='$Sex', Birthdate='$Birthdate', ContactNo='$ContactNo', Email='$Email', Last_Updated='$DateU' WHERE Employee_ID = ?";
        $sqlforupdatefiles="UPDATE tblfiles SET Dean='$Fullname' WHERE Dean = ?";
        $sqlforupdatefilesauthor="UPDATE tblfiles SET Author='$Fullname' WHERE Author = ?";
        $sqlforupdatefaculty="UPDATE tblfaculty SET Dean='$Fullname' WHERE Dean = ?";
        $stmt = mysqli_stmt_init($conn);

        

        if(!mysqli_stmt_prepare($stmt, $sqlforupdateaccount)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdateprofile)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdatefiles)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FullnameOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdatefilesauthor)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FullnameOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdatefaculty)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FullnameOld);
            mysqli_stmt_execute($stmt);
        }


        if($UserType == 'Dean'){
            header("Location: ../dean/account.php");
            $_SESSION ['response'] = "Successfully Updated the Account!";
            $_SESSION ['res_type']= "success";
            $_SESSION ['nameHolder'] = $Fullname;
        }else{
            header("Location: ../index.php");
            $_SESSION ['response'] = "Successfully Updated the Account User Type, Please login!";
            $_SESSION ['res_type']= "success";
        }

    }    
}


if(isset($_POST['add_faculty'])){

    $Dean = $_SESSION ['nameHolder'];
    $Professor = mysqli_real_escape_string($conn, $_POST['professor']);
    $sy = mysqli_real_escape_string($conn, $_POST['sy']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);

    if(strlen($sy)>=9){

        $sqlforNoAccount = "SELECT * FROM tblfaculty WHERE Fullname = '$Professor' AND Dean ='$Dean' AND School_Year ='$sy' AND Semester='$semester'";
        $sqlrun = mysqli_query($conn, $sqlforNoAccount);
    
        if(mysqli_num_rows($sqlrun)>0){

            header("Location: ../dean/faculties.php");
            $_SESSION ['response'] = "Professor Already Exists!";
            $_SESSION ['res_type']= "error";
        }else{
            $sqlforFaculty = "INSERT INTO tblfaculty (Fullname, Dean, School_Year, Semester) VALUES (?,?,?,?);";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sqlforFaculty)){
                echo "SQL Error";
            }else{
                mysqli_stmt_bind_param($stmt,"ssss",$Professor,$Dean, $sy,$semester);
                mysqli_stmt_execute($stmt);

                
                header("Location: ../dean/faculties.php");
                $_SESSION ['response'] = "Successfully Added to the Faculty!";
                $_SESSION ['res_type']= "success";
            }
        }
    }else{
        header("Location: ../dean/faculties.php");
        $_SESSION ['response'] = "Input School Year in this format (2020-2021)!";
        $_SESSION ['res_type']= "warning";
    }
}


if(isset($_POST['forprofselect'])) {

    $nameHolder = $_SESSION ['nameHolder'];
    $sy = $_POST['forprofselectsy'];
    $semester = $_POST['forprofselectsemester'];

    $query = "SELECT DISTINCT a.Fullname FROM tblfaculty a, tblaccounts b WHERE (Dean='$nameHolder' AND School_Year='$sy' AND Semester='$semester') AND (Status = 'ACTIVE' AND a.Fullname = b.Fullname) ORDER BY School_Year ASC";    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $fullname = $row['Fullname'];
        echo "<option value = '$fullname'> $fullname </option>";
    }
}

if(isset($_POST['setup'])){

    $nameHolder = mysqli_real_escape_string($conn, $_SESSION ['nameHolder']);
    $sy = mysqli_real_escape_string($conn, $_POST['syforthem']);
    $pof = mysqli_real_escape_string($conn, $_POST['profforthem']);
    $semester = mysqli_real_escape_string($conn, $_POST['semesterforthem']);
    $course = mysqli_real_escape_string($conn, $_POST ['courseforthem']);
    $file = mysqli_real_escape_string($conn, $_POST ['fileforthem']);
    $duedate = mysqli_real_escape_string($conn, $_POST ['scheduleforthem']);
    $Status = mysqli_real_escape_string($conn, "IN PROGRESS");

    $sqlforSettingFiles = "INSERT INTO tblfiles (File_ID, File, Author, Course, School_Year, Semester, Dean, Date_Scheduled, Date_Submitted, Status, Path) VALUES ('',?,?,?,?,?,?,?,'',?,'');";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforSettingFiles)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"ssssssss",$file,$pof,$course,$sy,$semester,$nameHolder,$duedate,$Status);
        mysqli_stmt_execute($stmt);

        header("Location: ../dean/task.php");
        $_SESSION ['response'] = "Successfully Added the Task!";
        $_SESSION ['res_type']= "success";
    }


}

if(isset($_POST['uploadyourfile'])){

    $nameHolder = mysqli_real_escape_string($conn, $_SESSION ['nameHolder']);
    $sy = mysqli_real_escape_string($conn, $_POST['syforyou']);
    $pof = mysqli_real_escape_string($conn, $_SESSION ['nameHolder']);
    $semester = mysqli_real_escape_string($conn, $_POST['semesterforyou']);
    $course = mysqli_real_escape_string($conn, $_POST ['courseforyou']);
    $file = mysqli_real_escape_string($conn, $_POST ['fileforyou']);
    $duedate = mysqli_real_escape_string($conn, $_POST ['scheduleforyou']);
    $Status = mysqli_real_escape_string($conn, "ON TIME");

    $fileupname = $_FILES ['fileuploadforyou']['name'];
    $filetemploc = $_FILES ['fileuploadforyou']['tmp_name'];
    $fileExt = explode('.', $fileupname);
    $fileActualExt = strtolower(end($fileExt));

    $filenameNEW = $file."-".$pof."-".$course."-".$sy."-".$semester." Semester"."-".rand(100000,100000).".".$fileActualExt ;
    $filedestination = '../uploads/' . $filenameNEW;
    move_uploaded_file($filetemploc, $filedestination);

    $filename = mysqli_real_escape_string($conn, $filenameNEW);

    $sqlforSettingFiles = "INSERT INTO tblfiles (File_ID, File, Author, Course, School_Year, Semester, Dean, Date_Scheduled, Date_Submitted, Status, Path) VALUES ('',?,?,?,?,?,?,?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforSettingFiles)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"ssssssssss",$file,$pof,$course,$sy,$semester,$nameHolder,$duedate,$duedate,$Status, $filename);
        mysqli_stmt_execute($stmt);

        header("Location: ../dean/task.php");
        $_SESSION ['response'] = "Successfully Uploaded your File!";
        $_SESSION ['res_type']= "success";
    }


}

if(isset($_POST['editprofileprof'])){

    $EmpID = mysqli_real_escape_string($conn, $_POST['Emp_ID']);
    $EmpIDOld = mysqli_real_escape_string($conn, $_POST['Emp_IDOld']);
    $Fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
    $FullnameOld = mysqli_real_escape_string($conn, $_POST['FullnameOld']);
    $Sex = mysqli_real_escape_string($conn, $_POST['Sex']);
    $Birthdate = mysqli_real_escape_string($conn, $_POST['Birthdate']);
    $UserType = mysqli_real_escape_string($conn, $_POST['AccountType']);
    $ContactNo = mysqli_real_escape_string($conn, $_POST['ContactNo']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $PassW = $_POST['Password'];

    if(strlen($PassW) >=60){

    }else{
        $PassW = mysqli_real_escape_string($conn, password_hash ($_POST['Password'],PASSWORD_DEFAULT));
    }

    $DateU = mysqli_real_escape_string($conn, date("Y/m/d"));

    $sqlforNoAccount = "SELECT * FROM tblaccounts WHERE Employee_ID ='$EmpID' AND NOT Fullname = '$FullnameOld'";
    $sqlrun = mysqli_query($conn, $sqlforNoAccount);

    if(mysqli_num_rows($sqlrun)>0){
        header("Location: ../professor/account.php");
        $_SESSION ['response'] = "Employee ID Already Exists!";
        $_SESSION ['res_type']= "error";
    }else{

        $sqlforupdateaccount="UPDATE tblaccounts SET Employee_ID ='$EmpID', Fullname='$Fullname', User_Type='$UserType', Password='$PassW' WHERE Employee_ID = ?";
        $sqlforupdateprofile="UPDATE tblprofiles SET Employee_ID ='$EmpID', Fullname='$Fullname', Position='$UserType', Sex='$Sex', Birthdate='$Birthdate', ContactNo='$ContactNo', Email='$Email', Last_Updated='$DateU' WHERE Employee_ID = ?";
        $sqlforupdatefilesauthor="UPDATE tblfiles SET Author='$Fullname' WHERE Author = ?";
        $sqlforupdatefaculty="UPDATE tblfaculty SET Fullname='$Fullname' WHERE Fullname = ?";
        $stmt = mysqli_stmt_init($conn);

        

        if(!mysqli_stmt_prepare($stmt, $sqlforupdateaccount)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdateprofile)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$EmpIDOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdatefilesauthor)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FullnameOld);
            mysqli_stmt_execute($stmt);
        }

        if(!mysqli_stmt_prepare($stmt, $sqlforupdatefaculty)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt,"s",$FullnameOld);
            mysqli_stmt_execute($stmt);
        }


        if($UserType == 'Professor'){
            header("Location: ../professor/account.php");
            $_SESSION ['response'] = "Successfully Updated the Account!";
            $_SESSION ['res_type']= "success";
            $_SESSION ['nameHolder'] = $Fullname;
        }else{
            header("Location: ../index.php");
            $_SESSION ['response'] = "Successfully Updated the Account User Type, Please login!";
            $_SESSION ['res_type']= "success";
        }

    }    
}


if(isset($_GET['download-file-forprof'])){
    $Path = $_GET['download-file-forprof'];

    $filepath = "../uploads/" . $Path;

    if(file_exists($filepath)){
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma:public');
        header('Content-Length:'. filesize('../uploads/'.$Path));

        readfile('../uploads/'.$Path);
       exit;
   
      
    }else{
        header("Location: ../professor/imported-files.php");
        $_SESSION['response']="File does not Exist!";
        $_SESSION['res_type']="error";
    }
   
}


if(isset($_POST['deletefiles_btn_confirmforprof'])){

    $FileID = $_POST['deletefiles_id_confirmforprof'];

    $querydeletefile = "SELECT Path FROM tblfiles WHERE File_ID = '$FileID'";    
    $stmtd = $conn->prepare($querydeletefile);
    $stmtd->execute();
    $resultd = $stmtd->get_result();
    $rowd = $resultd->fetch_assoc();


    $Path = $rowd['Path'];
    $filepath = "../uploads/" . $Path;

    if(!unlink($filepath)){
       
        
    $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"s",$FileID);
        mysqli_stmt_execute($stmt);
     }
      
    }else{

    $sqlforDeleteFiles="DELETE FROM tblfiles WHERE File_ID=?";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforDeleteFiles)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"s",$FileID);
        mysqli_stmt_execute($stmt);
     }
    }
}



if(isset($_POST['uploadprof'])){


    $fileID = $_POST['fileID'];

    $querydeletefile = "SELECT * FROM tblfiles WHERE File_ID = '$fileID'";    
    $stmtd = $conn->prepare($querydeletefile);
    $stmtd->execute();
    $resultd = $stmtd->get_result();
    $rowd = $resultd->fetch_assoc();

    $pof = $rowd['Author'];
    $course = $rowd['Course'];
    $file = $rowd['File'];
    $sy = $rowd['School_Year'];
    $semester = $rowd['Semester'];

    $dateschedule = $rowd['Date_Scheduled'];
    $uploadtime = mysqli_real_escape_string($conn, date("Y-m-d") );

    if($uploadtime <= $dateschedule){
        $Status = mysqli_real_escape_string($conn, "ON TIME");
    }else{
        $Status = mysqli_real_escape_string($conn, "OVERDUE");
    }

    $fileupname = $_FILES ['fileuploadforprof']['name'];
    $filetemploc = $_FILES ['fileuploadforprof']['tmp_name'];
    $fileExt = explode('.', $fileupname);
    $fileActualExt = strtolower(end($fileExt));

    $filenameNEW = $file."-".$pof."-".$course."-".$sy."-".$semester." Semester"."-".rand(100000,100000).".".$fileActualExt ;
    $filedestination = '../uploads/' . $filenameNEW;
    move_uploaded_file($filetemploc, $filedestination);

    $filename = mysqli_real_escape_string($conn, $filenameNEW);




    $sqlforUploadProf = "UPDATE tblfiles SET Date_Submitted = '$uploadtime', Status = '$Status', Path= '$filename' WHERE File_ID=?";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlforUploadProf)){
        echo "SQL Error";
    }else{
        mysqli_stmt_bind_param($stmt,"s",$fileID);
        mysqli_stmt_execute($stmt);

        header("Location: ../professor/task.php");
        $_SESSION ['response'] = "Successfully Uploaded your File!";
        $_SESSION ['res_type']= "success";
    }


}