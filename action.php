<?php
if (isset($_POST["create_user"])) {
    $patient_username = $_POST["username"];
    $patient_password = $_POST["user-password"];
    $patient_first_name= $_POST["first-name"];
    $patient_last_name= $_POST["last-name"];
    $patient_middle_name= $_POST["middle-name"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $birthday = $_POST["birthday"];

    # insert new patient
    $sql = "insert into patient(patient_username, patient_first_name, patient_middle_name,patient_last_name,
gender,birthday,address, patient_password) values ('{$patient_username}','{$patient_first_name}','{$patient_middle_name}',
 '{$patient_last_name}','{$gender}','{$birthday}','$address','{$patient_password}')";
    mysqli_query($conn, $sql);

    header("location: index.php");
}

if (isset($_POST["create_appointment"])) {
    $patient_username = $_POST["patient_username"];
    $doctor_name = $_POST["doctor_name"];
    $doctor_surname = $_POST["doctor_surname"];
    $date= $_POST["date"];
    $hours=$_POST["hours"];
    $minutes=$_POST["minutes"];

    # insert new appointment
    $sql = "select appointment_id, date_of_appointment

from appointment_with_doctor

where date_of_appointment

IN (select date_of_appointment 

from appointment_with_doctor

where employee_username IN(select employee_username

from hospital_stuff where first_name = '{$doctor_name}' and last_name ='{$doctor_surname}'))

AND date_of_appointment ='{$date} {$hours}:{$minutes}:00' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("location: appoint_error.php");
    } else {
        $sql="select employee_username
        from hospital_stuff
        where first_name = '{$doctor_name}' and last_name = '{$doctor_surname}'";
        $result = mysqli_query($conn, $sql);
        $doc_username = mysqli_fetch_assoc($result)["employee_username"];
        $sql = "insert into appointment_with_doctor(date_of_appointment,employee_username, patient_username,
diagnosis_id, personal_recomendations) values ('{$date} {$hours}:{$minutes}:00','{$doc_username}',
        '{$patient_username}',NULL,NULL)";
        $result = mysqli_query($conn, $sql);

        header("location: index.php");
    }
}
if (isset($_POST["error_ok"])) {
    header("location: index.php");
}
if (isset($_POST["change_salary"])) {
    $salary = $_POST["salary"];
    $employee_username=$_POST["emp_uname"];
    $sql = "update hospital_stuff
     set salary = {$salary}
     where employee_username ='{$employee_username}'";
    mysqli_query($conn, $sql);

    header("location: index.php");

}
if (isset($_POST["create_employee"])) {
    $employee_username = $_POST["emp_username"];
    $employee_password = $_POST["user-pwd"];
    $employee_first_name= $_POST["first_name"];
    $employee_last_name= $_POST["last_name"];
    $employee_middle_name= $_POST["middle_name"];
    $room_number = $_POST["room_number"];
    $salary = $_POST["salary"];
    $department = $_POST["departure"];
    $position = $_POST["position"];
    $specialization = $_POST["specialization"];

    # insert new patient
    $sql = "insert into hospital_stuff(schedule_id,departure_id, employee_username, position,
first_name, middle_name, last_name, specialization, room_number, salary, employee_password) 
values (5,'{$department}','$employee_username','$position','$employee_first_name','$employee_middle_name',
'$employee_last_name','$specialization','$room_number','$salary','$employee_password')";
    mysqli_query($conn, $sql);

    header("location: index.php");
}
