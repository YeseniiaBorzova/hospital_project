<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
    <h2><b>List of patients</b></h2>
    <p>
        <style>
            Body {
                font-family: Calibri, Helvetica, sans-serif;
                background-color: #ecf5ff;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }
            th:hover {
                background: dodgerblue;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2
            }

            th {
                background-color: lightskyblue;
                color: white;
            }
        </style>
        <?php
        # if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
        if (isset($_GET["action"]) && ($_GET["action"] == "create" || $_GET["action"] == "update"
                || $_GET["action"] == "delete")) {
            ?>
            <a href="index.php">Back</a>
            <?php
        } else {
            ?>
            <a href="index.php?action=today_patients&user=<?= $_SESSION["user"] ?>">View Patients on today</a>
            <a href="patient_creation.html">Create new patient</a>
            <?php
        }
        ?>

<?php
if (isset($_GET["action"]) && $_GET["action"] == "today_patients") {
        $doctor_username = $_GET["user"];
        ?>

        <h3>Today patients</h3>
        <p>
            <a href="index.php">Hide</a>
        </p>
        <?php
        $sql = "select patient.patient_first_name, patient.patient_last_name, TIME(appointment_with_doctor.date_of_appointment) as 'time'

from patient, appointment_with_doctor 

where DATE(date_of_appointment) = CURDATE() AND employee_username = '{$doctor_username}'

AND patient.patient_username = appointment_with_doctor.patient_username";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            ?>
            <table border="1">

            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Time</th>
            </tr>
            <?php
            # display products if the contract is not empty
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><b><?= $row["patient_first_name"] ?></b></td>
                    <td><b><?= $row["patient_last_name"] ?></b></td>
                    <td><b><?= $row["time"] ?></b></td>

                </tr>
                <?php
            }

        } else{
            echo "No appointments";
        }
        ?>
    </table>
    <?php
}
?>
    <p/>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Date</th>
            <th>Time</th>
            <th>Medical card</th>
        </tr>
        <?php
        # retrieve and display data about contracts
        $sql = "SELECT *  FROM doctor_info
ORDER BY date";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><b><?= $row["patient_first_name"] ?></b></td>
                <td><b><?= $row["patient_last_name"] ?></b></td>
                <td><b><?= $row["date"] ?></b></td>
                <td><b><?= $row["time"] ?></b></td>
                <td>
                    <a href="index.php?action=view_card&id=<?= $row["patient_username"] ?>">View card</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    </p>
<?php
# if the action mode is info
# display data about supplied products for a selected contract
if (isset($_GET["action"]) && $_GET["action"] == "view_card") {
    $patient_username = $_GET["id"];
    ?>
    <h3>Patient information</h3>
    <p>
        <a href="index.php">Hide</a>
    </p>
    <?php
    $sql = "select patient_first_name, patient_middle_name, patient_last_name, gender, 
DATE(birthday) as 'birthday', address from patient
where patient_username =  '{$patient_username}' ";
    $result = mysqli_query($conn, $sql);

    # check the size of a result set
    if (mysqli_num_rows($result) > 0) {
        ?>
        <table border="1">
        <tr>
            <th>Name</th>
            <th>Middle name</th>
            <th>Surname</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Home address</th>
        </tr>
        <?php
        # display products if the contract is not empty
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><b><?= $row["patient_first_name"] ?></b></td>
                <td><b><?= $row["patient_middle_name"] ?></b></td>
                <td><b><?= $row["patient_last_name"] ?></b></td>
                <td><b><?= $row["gender"] ?></b></td>
                <td><b><?= $row["birthday"] ?></b></td>
                <td><b><?= $row["address"] ?></b></td>
            </tr>
            <?php
        }
    } else {
        # if the result set is empty print the following message
        echo "Contract is empty";
    }
    ?>
    </table>
    <?php
}
?>