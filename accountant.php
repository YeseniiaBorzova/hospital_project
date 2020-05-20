<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Information about employees</h3>
<p>
    <style>
        Body {
            font-family: Calibri, Helvetica, sans-serif;
            background-color: #f1f1f1;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th:hover{
            background-color: mediumorchid;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: darkmagenta;
            color: white;
        }
    </style>
    <?php
    # if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
    if (isset($_GET["action"]) && ($_GET["action"] == "medical_stuff" || $_GET["action"] == "non_medical_stuff")) {
        ?>
        <a href="index.php">Back</a>
        <?php
        # otherwise - show 'new record' link
    } else {
        ?>
        <a href="index.php?action=medical_stuff">View medical stuff</a>
        <a href="index.php?action=non_medical_stuff">View non-medical stuff</a>
        <a href="create_new_employee.html">Create new employee</a>
        <?php
    }
    ?>

    <?php
    if (isset($_GET["action"]) && $_GET["action"] == "medical_stuff") {

    ?>
<h3>Medical stuff</h3>
<?php
$sql = "select first_name,middle_name, last_name, position, specialization, salary
   from hospital_stuff
   where specialization <> 'non-medic personal'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    ?>
    <table border="1">
    <tr>
        <th>Name</th>
        <th>Middle name</th>
        <th>Surname</th>
        <th>Position</th>
        <th>Specialization</th>
        <th>Salary</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><b><?= $row["first_name"] ?></b></td>
            <td><b><?= $row["middle_name"] ?></b></td>
            <td><b><?= $row["last_name"] ?></b></td>
            <td><b><?= $row["position"] ?></b></td>
            <td><b><?= $row["specialization"] ?></b></td>
            <td><b><?= $row["salary"] ?></b></td>
        </tr>
        <?php
    }
    ?>
    </table>
<?php
} else {
    echo "No stuff";
}
?>

<?php
} else if (isset($_GET["action"]) && $_GET["action"] == "non_medical_stuff") {

    ?>
    <h3>Non-Medical stuff</h3>
    <?php
    $sql = "select first_name,middle_name, last_name, position, specialization, salary
   from hospital_stuff
   where specialization = 'non-medic personal'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        ?>
        <table border="1">
        <tr>
            <th>Name</th>
            <th>Middle name</th>
            <th>Surname</th>
            <th>Position</th>
            <th>Specialization</th>
            <th>Salary</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><b><?= $row["first_name"] ?></b></td>
                <td><b><?= $row["middle_name"] ?></b></td>
                <td><b><?= $row["last_name"] ?></b></td>
                <td><b><?= $row["position"] ?></b></td>
                <td><b><?= $row["specialization"] ?></b></td>
                <td><b><?= $row["salary"] ?></b></td>
            </tr>
            <?php
        }
    } else {
        echo "No stuff";
    }
    ?>

    </table>
    <?php
} else if (isset($_GET["action"]) && $_GET["action"] == "edit_salary"){
        $emp_uname = $_GET["id"];
        $sql = "SELECT salary from hospital_stuff
WHERE employee_username = '{$emp_uname}'";
    $result = mysqli_query($conn, $sql);
        $sal = mysqli_fetch_assoc($result)["salary"];
        ?>
    <h3>New salary</h3>
    <form method="post" action="index.php">
        <input type = "hidden" name="emp_uname" value="<?= $emp_uname?>">
    <input type="number" name="salary" id="salary" value="<?php echo $sal ?>" required>
    </p>
    <p>
        <button type="submit" name ="change_salary" value="Submit" ><b>Change</b></button>
    </p>
    </form>
<?php

} else{
?>
<p></p>
<table border="1">
    <tr>
        <th>Departure id</th>
        <th>Employee username</th>
        <th>Position</th>
        <th>Specialization</th>
        <th>Salary</th>
        <th>Change salary</th>
    </tr>
    <?php
    $sql = "SELECT *  FROM accountant_info
ORDER BY departure_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><b><?= $row["departure_id"] ?></b></td>
            <td><b><?= $row["employee_username"] ?></b></td>
            <td><b><?= $row["position"] ?></b></td>
            <td><b><?= $row["specialization"] ?></b></td>
            <td><b><?= $row["salary"] ?></b></td>
            <td>

            <a href="index.php?action=edit_salary&id=<?= $row["employee_username"] ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</p>