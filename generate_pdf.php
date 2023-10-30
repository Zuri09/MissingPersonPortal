<?php
require('fpdf/fpdf.php');
include("connection.php");
$id = $_GET['id'];
$query = "SELECT * FROM missingpersondetails WHERE case_id='$id'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) != 0) {
    $pdf = new FPDF();
    $pdf->AddPage();

    // Define the table structure
    $pdf->SetFont('Arial', 'B', 12);
    
    // Add a border around the entire content
    $pdf->Rect(5, 5, 200, 287); // Adjust the coordinates and size as needed

    $pdf->Image('C:\xampp\htdocs\missingperson\Images\f2.png', 10, 10, 30);
    $pdf->SetFont('Arial', 'B', 40);
    $pdf->Cell(0, 40, 'Ensure Secure', 0, 1, 'C');
    $pdf->Cell(0, 10, '', 0, 1, 'C');
    $pdf->Cell(0, 10, '', 0, 1, 'C');
    $pdf->Image($result['photo'], 120, 50, 50, 50);
    $pdf->Cell(0, 10, '', 0, 1, 'C');
    $pdf->Cell(0, 10, '', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'CASE_ID: ' . $result['case_id'], 0, 1);
    $pdf->Cell(0, 10, 'First Name: ' . $result['fname'], 0, 1);
    $pdf->Cell(0, 10, 'Middle Name: ' . $result['mname'], 0, 1);
    $pdf->Cell(0, 10, 'Last Name: ' . $result['lname'], 0, 1);
    $pdf->Cell(0, 10, 'DOB: ' . $result['dob'], 0, 1);
    $pdf->Cell(0, 10, 'Family Member: ' . $result['family_member_name'], 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $result['address'], 0, 1);
    $pdf->Cell(0, 10, 'Phone Number: ' . $result['phone'], 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $result['email'], 0, 1);
    $pdf->Cell(0, 10, 'Last Seen: ' . $result['lastseen'], 0, 1);
    $pdf->Cell(0, 10, 'Social Media Accounts: ' . $result['socials'], 0, 1);

    // Generate a unique PDF filename
    $pdfFilename = 'search_results_' . time() . '.pdf';

    // Save the PDF to a directory on your server
    $pdf->Output($pdfFilename, 'F');
    if (isset($pdfFilename)) {
        ?>
        <a href="<?php echo $pdfFilename; ?>" class="btn btn-primary" target="_blank">Download PDF</a>
<?php
    }
}
?>
