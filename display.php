<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <style>
        body {
            background-color: #4B0082; /* Indigo background color */
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            background-image: url(http://localhost/missingperson/imagesforwebsite/background_for_report.jpg);
        }

        h2 {
            text-align: center;
            color: #8A2BE2; /* Blue-violet heading color */
            padding: 10px;
        }
        h3{
            text-align: center;
            color: #8A2BE2; /* Blue-violet heading color */
            padding: 10px;
            font size: 5px;
            
        }
        .button-container {
            display: flex;
            justify-content: center;
        }

        .center-button {
            text-align: center;
            
            background-color: transparent;
        }

        table {
            background-color: #fff;
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(15px);
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #8A2BE2; /* Blue-violet header background color */
            color: #fff;
        }

        .button {
            background-color: #4CAF50; /* Green button background color */
            color: #fff;
            border: 0;
            border-radius: 5px;
            height: 25px;
            width: 80px;
            font-weight: bold;
            cursor: pointer;
        }

        .delete {
            background-color: #FF5733; /* Red-orange delete button background color */
        }

        .pdf {
            background-color: #ADD8E6; /* Light blue PDF button background color */
        }
    </style>
</head>
<body>
<h2>Displaying all records</h2>


<div class="button-container">
    <div class="center-button">
        <button onclick="window.open('http://localhost/missingperson/osint.html', '_blank')" style="background: transparent; border: none; padding: 0;">
            <h3 style="color: #8A2BE2; font-size: 18px;">OSINT TOOLS</h3>
        </button>
    </div>
    <div class="center-button">
        <button onclick="window.open('http://localhost/missingperson/PolicePortal.html', '_blank')" style="background: transparent; border: none; padding: 0;">
            <h3 style="color: #8A2BE2; font-size: 18px;">Search by name</h3>
        </button>
    </div>
</div>
<table border="1">
    <tr>
        <th>Case ID</th>
        <th>Photo</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Date Of Birth</th>
        <th>Family Member Name</th>
        <th>Address</th>
        <th>Phone No.</th>
        <th>Email</th>
        <th>Last Seen</th>
        <th>Socials</th>
        <th>Status</th>
        <th>Operation</th>
        <th>PDF</th>
    </tr>

    <?php
    include("connection.php");

    $query = "SELECT * FROM missingpersondetails order by dob DESC";
    $data = mysqli_query($conn, $query);

    while ($result = mysqli_fetch_assoc($data)) {
        echo "
        <tr>
            <td>" . $result['case_id'] . "</td>
            <td><img src='" . $result["photo"] . "' height='100px' width='100px'></td>
            <td>" . $result["fname"] . "</td>
            <td>" . $result["mname"] . "</td>
            <td>" . $result["lname"] . "</td>
            <td>" . $result["dob"] . "</td>
            <td>" . $result["family_member_name"] . "</td>
            <td>" . $result["address"] . "</td>
            <td>" . $result["phone"] . "</td>
            <td>" . $result["email"] . "</td>
            <td>" . $result["lastseen"] . "</td>
            <td>" . $result["socials"] . "</td>
            <td>" . $result["status"] . "</td>
            <td>
                <a href='update_design.php?id=$result[case_id]'>
                    <input type='submit' value='Update' class='button'>
                </a>
                <br>
                <a href='delete.php?id=$result[case_id]' onclick='return check_delete()'>
                    <input type='submit' value='Delete' class='delete'>
                </a>
            </td>
            <td>
                <a href='generate_pdf.php?id=$result[case_id]'>
                    <input type='submit' value='PDF' class='pdf'>
                </a>
            </td>
        </tr>";
    }
    ?>
</table>

<script>
    function check_delete() {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
</body>
</html>
