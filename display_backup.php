<html>
<head>
    <title>Display</title>
    <style>
        body{
            background-color: purple;
        }
        table{
            background-color: #fff; 
        }
        .update,.delete,.pdf{
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            border-radius: 10px;
            height: 25px;
            width: 80px;
            font-weight: bold;
            cursor: pointer;
        }
        .delete{
            background-color: red;
        }
        .pdf{
            background-color: lightblue;
        }
    </style>
</head>
</html>
<?php

include("connection.php");

$query = "SELECT * FROM missingpersondetails order by dob DESC";
$data = mysqli_query($conn, $query);




if(mysqli_num_rows($data) != 0){ 
    ?>
    <h2 align="center"><mark>Displaying all records</mark></h2>
    <center>
    <table border="1" cellspacing = "7" width = "100%">
    <tr>
    <th>Caseid</th>
    <th>Photo</th>
    <th width=2%>First Name</th>
    <th width=8%>Middle Name</th>
    <th width=2%>Last Name</th>
    <th width=8%>Date Of birth</th>
    <th width=10%>Family Member Name</th>
    <th width=10%>Address</th>
    <th width=5%>Phone No.</th>
    <th width=8%>Email</th>
    <th width=8%>Last Seen</th>
    <th width=8%>Socials</th>
    <th width=5%>Status</th>
    <th width=8%>Operation</th>
    <th >PDF</th>
    </tr>
<?php
    while($result = mysqli_fetch_assoc($data)){
        echo "
        <tr>
            <td>".$result['case_id']."</td>
            <td><img src='".$result["photo"]."' height='100px' width='100px'></td>
            <td>".$result["fname"]."</td>
            <td>".$result["mname"]."</td>
            <td>".$result["lname"]."</td>
            <td>".$result["dob"]."</td>
            <td>".$result["family_member_name"]."</td>
            <td>".$result["address"]."</td>
            <td>".$result["phone"]."</td>
            <td>".$result["email"]."</td>
            <td>".$result["lastseen"]."</td>
            <td>".$result["socials"]."</td>
            <td>".$result["status"]."</td>



            <td><a href='update_design.php?id=$result[case_id]'><input type = 'submit' value= 'Update' class = 'update'></a>
            <a href='delete.php?id=$result[case_id]'><input type = 'submit' value= 'Delete' class = 'delete' onclick = 'return check_delete()'></a>
            
            </td>
            <td><a href='generate_pdf.php?id=$result[case_id]'><input type = 'submit' value= 'PDF' class = 'pdf'></a></td>
        </tr>";
    }
}
else{
    echo "No data found";
}


?>
</table>
</center>

<script>
    function check_delete()
    {
        return confirm('Are sure you want to delete this record?');
    }
</script>