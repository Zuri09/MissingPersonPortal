<?php

include("connection.php");

$id=$_GET['id'];
 //get the value from url parameter

$query = "SELECT * FROM `missingpersondetails` WHERE case_id='$id'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Missing Person Report Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            padding: 20px;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        form {
            max-width: 1000px; /* Increased width for landscape mode */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 0px rgba(0, 0, 0, 0.2);
        }
        .form-row {
            display: flex;
            justify-content: space-between;
        }
        .form-col {
            width: 20%; /* Three equal columns in landscape mode */
        }
        .form-col:first-child {
            margin-right: 2%; /* Add margin to separate the columns */
        }
        label {
            display: block;
            font-weight: bold;
            margin: 15px 0;
        }
        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Update Details</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-col">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value = "<?php echo $result['fname'];?>">
            </div>
            <div class="form-col">
                <label for="mname">Middle Name:</label>
                <input type="text" id="mname" name="mname" value = "<?php echo $result['mname'];?>">
            </div>
            <div class="form-col">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value = "<?php echo $result['lname'];?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-col">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value = "<?php echo $result['dob'];?>">
            </div>
            <div class="form-col">
                <label for="family_name">Family Member Name:</label>
                <input type="text" id="family_name" name="fmname" value = "<?php echo $result['family_member_name'];?>">
            </div>
            <div class="form-col">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4"><?php echo $result['address']?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-col">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value = "<?php echo $result['phone'];?>">
            </div>
            <div class="form-col">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value = "<?php echo $result['email'];?>">
            </div>
            <div class="form-col">
                <label for="last_seen">Last Seen:</label>
                <input type="text" id="last_seen" name="last_seen" value = "<?php echo $result['lastseen'];?>">
            </div>
        </div>
        <label for="social_media_accounts">Social Media Accounts:</label>
        <input type="text" id="social_media_accounts" name="socials" value = "<?php echo $result['socials'];?>">

        <label for="photo">Photo:</label>
        <img src="<?php echo $result['photo'];?>" width="100px" height="100px" ></img>
        <input type="file" id="photo" name="photo">

        <label for="photo">Status</label>
        <input type="text"  id="status" name="status" value = "<?php echo $result['status'];?>">

        <input type="submit" value="Update" name="update">
    </form>
    <?php echo $result['photo'];?>
</body>
</html>


<?php
    if($_POST['update'])
    {
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        //$dob = date('Y-m-d', strtotime($data));
        $fmname = $_POST["fmname"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $last_seen = $_POST["last_seen"];
        $social_media_accounts = $_POST["socials"]; 
        $status = $_POST["status"];  
        $img_folder = $_POST["photo"];
    
        //$filename = $_FILES["photo"]["name"];
        //$tempname = $_FILES["photo"]["tmp_name"];
        //$img_folder = "images/".$filename;
        //move_uploaded_file($tempname,$img_folder);
        $stmt = $conn->prepare("UPDATE `missingpersondetails` set fname='$fname',mname='$mname', lname='$lname', dob='$dob', family_member_name='$fmname', address='$address', phone='$phone', email='$email', lastseen='$last_seen', socials='$social_media_accounts', photo='$img_folder', status='$status' WHERE case_id='$id'" );
            if ($stmt->execute()) {
                echo "<script>alert('Records are updated')</script>";
                ?>
                <meta http-equiv = "refresh" content = "0; url = http://localhost/missingperson/display.php" />
                <?php
         
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            $stmt->close();
            $conn->close();
    }
?>

