<?php
session_start();

$dbhost= "localhost";
$dbusername= "root";
$dbpassword= "";
$dbname="websysfinal";

$conn= mysqli_connect($dbhost, $dbusername, $dbpassowrd, $dbname);
if(!$conn){
    echo "Connection Failed";
}

if(isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data= trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validate($_POST['username']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header("Location: login.php?error=User Name is required");
    exit();
} else if(empty($pass)) {
    header("Location: login.php?error=Password is required");
    exit();
} else {
    $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $uname && $row['password'] === $pass) {
            echo "Logged in!";
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: posts.php");
            exit();
        } else {
            header("Location: login.php?error=Incorect credentials");
            exit();
        }
    } else {
        header("Location: login.php?error=Incorect credentials");
        exit();
}
}
else {
header("Location: index.php");
exit();
}

?>