<?php 
include 'dbconn.php';
session_start();
$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$phonenum = $_POST['phonenum'];

$sql = "UPDATE user SET `Name`=?, Surname=?, Patronymic=?, PhoneNumber=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssi', $name,$surname, $patronymic, $phonenum,$_SESSION['id']);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Данные успешно обновлены!',
        'data' => $_SESSION
    ]);
    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['patronymic'] = $patronymic;
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Либо произошла ошибка, либо вы ввели те же самые данные!'
    ]);
}
?>