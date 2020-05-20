<?php
session_start();

require_once("connect.php");

$conn = NULL;

# check for a user session
if (isset($_SESSION["user"])) {
    $conn = db_conn();
    include("action.php");
} else {
    # redired to login page if the user is not set
    header("location: login.php");
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hospital</title>
    </head>
    <body>
    <p>
        <b>User:</b> <i><?= $_SESSION["user"] ?></i> | <a href="logout.php">Logout</a>
    </p>
    <?php
    $pos = "";
    $sql = "select position from hospital_stuff
    where employee_username = '{$_SESSION["user"]}' AND employee_password = '{$_SESSION["pass"]}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $pos = $row["position"];
        } else{
            $sql="select patient_username from patient
            where patient_username = '{$_SESSION["user"]}' AND patient_password = '{$_SESSION["pass"]}'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                $pos = "patient";
            }
        }
    # display content depending on the user type
    if ($pos == "professor" || $pos == "docent" || $pos == "head physician" || $pos == "alternate head physician" || $pos == "head of the department" || $pos == "specialist" || $pos == "intern") {
        include("doctor.php");

    } else if($pos == "accountant"){
        include("accountant.php");

    } else if($pos == "patient"){
        include("patient.php");
    }
    else{

        echo "Username or password is incorrect. Press 'Logout to try again'";
    }
    ?>
    </body>
    </html>
<?php
mysqli_close($conn);
?>