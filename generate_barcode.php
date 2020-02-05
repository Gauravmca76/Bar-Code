<?php
session_start();
$bar=$_SESSION['filename'];
require('code128.php');
if(isset($_POST["submit"]))
{

$con=mysqli_connect("localhost","root","");
if(!$con)
{
    die('Could not connect: '.mysqli_error());
}
mysqli_select_db($con,"barcode");
$sql="SELECT * FROM tb_filecode WHERE file_name='$bar'";
$result=mysqli_query($con,$sql);
if($row=mysqli_fetch_array($result))
{
 $code=$row['file_name'];
}
$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->Code128(50,20,$code,145,20);
$pdf->output();

}
?>