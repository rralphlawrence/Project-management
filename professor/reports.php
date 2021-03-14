<?php

include_once '../includes/dbprocess.php';
require ('../includes/fpdf182/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=dbFMS','root','');


if(isset($_POST['print'])){
    $deanName = $_SESSION['nameHolder'];
    $semester = $_POST['semester'];
    $sy = $_POST['sy'];


    $sex='';
    $MrorMs='';

        $sqlforGender = "SELECT Sex FROM tblprofiles WHERE Fullname = '$deanName'";
        $stmt = $db->query( $sqlforGender);

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $sex=$row->Sex;   
        }

        if($sex=='Male'){
            $MrorMs="Mr.";
        }else{
            $MrorMs="Ms.";
        }


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../img/logoheaderrepor.png',100,6,170);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    
    $this->Ln(40);
    // Title
    $this->Cell(160);
    $this->Cell(30,10,'File Management System',0,0,'C');
    $this->Ln(7);
    $this->Cell(160);
    $this->Cell(30,10,'Semestral Report',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

// Page footer
function headerTable()
{
  
    // Arial italic 8
    $this->SetFont('Arial','B',10);
    // Page number
    $this->Cell(8);
    $this->Cell(30,10,'Course',1,0,'C');
    $this->Cell(70,10,'Dean',1,0,'C');
    $this->Cell(70,10,'File',1,0,'C');
    $this->Cell(30,10,'School Year',1,0,'C');
    $this->Cell(30,10,'Semester',1,0,'C');
    $this->Cell(30,10,'Date Scheduled',1,0,'C');
    $this->Cell(30,10,'Date Submitted',1,0,'C');
    $this->Cell(30,10,'Status',1,0,'C');
    $this->Ln();
}
function queryTable($db, $deanName, $semester, $sy){
        $this->SetFont('Arial','B',10);
       
      
        $sqlforNoAccount = "SELECT Course, Dean, File, School_Year, Semester, Date_Scheduled, Date_Submitted, Status FROM tblfiles WHERE Author = '$deanName' AND Semester='$semester' AND School_Year='$sy' ORDER BY Dean ASC, Course ASC, File ASC";
        $stmt = $db->query( $sqlforNoAccount);

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $this->Cell(8);
                $this->Cell(30,10,$row->Course,1,0,'L');
                $this->Cell(70,10,$row->Dean,1,0,'L');
                $this->Cell(70,10,$row->File,1,0,'L');
                $this->Cell(30,10,$row->School_Year,1,0,'C');
                $this->Cell(30,10,$row->Semester,1,0,'C');
                $this->Cell(30,10,$row->Date_Scheduled,1,0,'C');
                $this->Cell(30,10,$row->Date_Submitted,1,0,'C');
                $this->Cell(30,10,$row->Status,1,0,'L');
                $this->Ln();
        }
}

function Signatory($deanName,$MrorMs)
{
    $this->Ln(25);
    $this->SetFont('Arial','B',12);
    $this->Cell(15);
    $this->Cell(30,10,$MrorMs.' '.$deanName,0,0,'C');
    $this->Ln(6);
    $this->Cell(15);
    $this->SetFont('Arial','B',12);
    $this->Cell(30,10,'Professor',0,0,'C');
    // Line break
    $this->Ln(20);
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','Legal',0);
$pdf->headerTable();
$pdf->queryTable($db,$deanName,$semester,$sy);
$pdf->Signatory($deanName,$MrorMs);
$pdf->Output();

}

