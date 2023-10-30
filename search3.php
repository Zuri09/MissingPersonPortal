<?php
require('fpdf/fpdf.php'); // Include the FPDF library

// Database connection settings
$servername = "127.0.0.1:3307";
$username = "admin";
$password = "Test@12345";
$database = "missing_person";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['get_data'])) {
    $search = $_POST['get_data'];
    $sql = "SELECT * FROM `missing_person_report` WHERE name LIKE '%$search%' OR id LIKE '%$search%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Database</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">M I S S I N G  P E R S O N</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="get_data" class="form-control" placeholder="Enter Search Query" required>
                                    </div>
                                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                                </form>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['get_data'])) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody> <!-- Changed the position of <tbody> element -->
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><b>#ID:</b> <?php echo $row['id'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Name:</b> <?php echo $row['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone:</b> <?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b> <?php echo $row['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Age:</b> <?php echo $row['age'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number:</b> <?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b> <?php echo $row['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Family Member:</b> <?php echo $row['family_member_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Seen:</b> <?php echo $row['last_seen'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Social Media Accounts:</b> <?php echo $row['social_media_accounts'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Photo:</b> <?php echo $row['photo'] ?></td>
                                    </tr>
                                    <?php
                                    }
                                    $result->data_seek(0); // Reset the internal pointer of the result set
                                } else {
                                    ?>
                                    <tr>
                                        <td>No records found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        }
                        
                            // Create a PDF object
                            $pdf = new FPDF();
                            $pdf->AddPage();

                            // Define the table structure
                            $pdf->SetFont('Arial', 'B', 12);

                            while ($row = $result->fetch_assoc()) {
                                $pdf = new FPDF();
                                $pdf->AddPage();
                                $pdf->Image('C:\xampp\htdocs\missingperson\Images\f2.png', 10, 10, 30);
                                $pdf->SetFont('Arial', 'B', 16);
                                $pdf->Cell(0, 10, 'Ensure Secure', 0, 1, 'C');
                                $pdf->Cell(0, 10, '', 0, 1, 'C');
                                $pdf->Cell(0, 10, '', 0, 1, 'C');
                                $pdf->Cell(0, 10, '', 0, 1, 'C');
                                $pdf->Cell(0, 10, '', 0, 1, 'C');
                                $pdf->Cell(0, 10, '#ID: ' . $row['id'], 0, 1); // 0 means no border, 1 means move to the next line
                                $pdf->Cell(0, 10, 'Name: ' . $row['name'], 0, 1);
                                $pdf->Cell(0, 10, 'Phone: ' . $row['phone'], 0, 1);
                                $pdf->Cell(0, 10, 'Address: ' . $row['address'], 0, 1);
                                $pdf->Cell(0, 10, 'Age: ' . $row['age'], 0, 1);
                                $pdf->Cell(0, 10, 'Phone Number: ' . $row['phone'], 0, 1);
                                $pdf->Cell(0, 10, 'Email: ' . $row['email'], 0, 1);
                                $pdf->Cell(0, 10, 'Family Member: ' . $row['family_member_name'], 0, 1);
                                $pdf->Cell(0, 10, 'Last Seen: ' . $row['last_seen'], 0, 1);
                                $pdf->Cell(0, 10, 'Social Media Accounts: ' . $row['social_media_accounts'], 0, 1);
                                $pdf->Cell(0, 10, 'Photo: ' . $row['photo'], 0, 1);
                            }

                           // Generate a unique PDF filename
                            $pdfFilename = 'search_results_' . time() . '.pdf';

                            // Save the PDF to a directory on your server
                            $pdf->Output($pdfFilename, 'F');
                        
                        ?>
                        <?php
                        if (isset($pdfFilename)) {
                        ?>
                        <a href="<?php echo $pdfFilename; ?>" class="btn btn-primary" target="_blank">Download PDF</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
