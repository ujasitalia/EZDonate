<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "123", "ezdonate");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
 
// Attempt insert query execution
//$sql = "INSERT INTO donor (Name, Email, Password) VALUES ('$name', '$email', '$password')";
$sql = "SELECT Password FROM donor where Email='$email'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["Password"] == $password){
            header("Location:login_1.php");
        }
    
        else{
            echo "<script type='text/javascript'>
            if (confirm('Enter Valid Credentials')) {
                window.location = 'login.php';
            }
            else {
                window.location = 'login.php';
            }
            </script>";
            // header("Location:login.php");
        }
    }
}
 else {
    echo "0 results";
}


//if(mysqli_query($link, $sql)){
   // echo "Records added successfully.";
//} else{
    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//}
 
// Close connection
mysqli_close($link);
?>