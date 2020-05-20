<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Available doctors</h3>
<p>
    <style>
        Body {
            font-family: Calibri, Helvetica, sans-serif;
            background-color: #efcdcd;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th:hover{
            background-color: darkred;
        }
        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: indianred;
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
        # otherwise - show 'new record' link
    } else {
        ?>
        <a href="appointment_with_doctor.html">Create an appointment</a>
        <?php
    }
    ?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Position</th>
        <th>Specialization</th>
        <th>Room number</th>
        <th>Department name</th>
        <th>Building</th>
        <th>Schedule</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "SELECT *  FROM patient_info";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><b><?= $row["first_name"] ?></b></td>
            <td><b><?= $row["last_name"] ?></b></td>
            <td><b><?= $row["position"] ?></b></td>
            <td><b><?= $row["specialization"] ?></b></td>
            <td><b><?= $row["room_number"] ?></b></td>
            <td><b><?= $row["name"]?></b></td>
            <td><b><?= $row["building"]?></b></td>
            <td>
                <a href="index.php?action=see_schedule&id=<?= $row["schedule_id"]?>">See schedule</a>
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
if (isset($_GET["action"]) && $_GET["action"] == "see_schedule") {
	$schedule_id = $_GET["id"];
?>
	<h3>Schedule of the doctor</h3>
	<p>
	<a href="index.php">Hide</a>
	</p>
	<?php
	# retrieve data about selected products
	$sql = "SELECT mn_from,mn_to,tue_from,tue_to,wed_from,wed_to,thu_from, thu_to,
fr_from,fr_to,sat_from,sat_to FROM working_schedule WHERE schedule_id = '{$schedule_id}'";
	$result = mysqli_query($conn, $sql);

	# check the size of a result set
	if (mysqli_num_rows($result) > 0) {
		?>
		<table border="1">
			<tr>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
			</tr>
		<?php
		# display products if the contract is not empty
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><b><?= $row["mn_from"] ?> <?= $row["mn_to"]?></b></td>
				<td><b><?= $row["tue_from"] ?> <?= $row["tue_to"]?></b></td>
				<td><b><?= $row["wed_from"] ?> <?= $row["wed_to"]?></b></td>
                <td><b><?= $row["thu_from"] ?> <?= $row["thu_to"]?></b></td>
                <td><b><?= $row["fr_from"] ?> <?= $row["fr_to"]?></b></td>
                <td><b><?= $row["sat_from"] ?> <?= $row["sat_to"]?></b></td>
			</tr>
			<?php
		}
	} else {
		# if the result set is empty print the following message
		echo "No schedule";
	}
	?>
	</table>
<?php
}
?>

