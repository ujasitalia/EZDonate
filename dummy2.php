<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <?php
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    $link = mysqli_connect("localhost", "root", "123", "ezdonate");
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    $sql = "SELECT Email FROM ngo";
    $result = $link->query($sql);

    $mail = $_REQUEST['email'];
    $from = $_REQUEST['city'];
    $cat = $_REQUEST['category'];
    $name = $_REQUEST['name'];

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $to = $row["Email"];
            $subject = "event";
            $message =  "Donation by: ".$name." from ".$from. " would like to mae a donation of category: ".$cat."<br>  BRIEF:".$_REQUEST["donatn-field1"].$_REQUEST["donatn-field2"].$_REQUEST["donatn-field3"]."<br> Contact: ".$mail;
            $retval = mail($row["Email"],"Warm greetings to NGO's ",$message);
        if( $retval == true ) {
            echo "Message sent successfully...<br>";
         }else {
            echo "Message could not be sent...";
         }
        }header("Location: index.html");
    } else {
        echo "0 results";
    }
    
    // Close connection
    mysqli_close($link);
    ?>
</body>
</html>
