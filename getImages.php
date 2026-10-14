<?php 
include 'dbconn.php';
session_start();

$sql = "SELECT * FROM imagesinorder WHERE OrderID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_POST['orderID']);
$stmt->execute();
$iio = $stmt->get_result();

if ($iio->num_rows === 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Произошла ошибка в получении фотографий в заказе!',
        'id' => $_POST['orderID']
    ]);
    die();
}

// Собираем все ImageID
$imageIDs = [];
while ($row = $iio->fetch_assoc()) {
    $imageIDs[] = $row['ImageID'];
}

// Получаем все изображения одним запросом
$imageArray = [];

if (count($imageIDs) > 0) {
    $placeholders = implode(',', array_fill(0, count($imageIDs), '?'));
    $types = str_repeat('i', count($imageIDs));

    $sql = "SELECT * FROM `image` WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$imageIDs);
    $stmt->execute();

    $result = $stmt->get_result();
    $imageArray = $result->fetch_all(MYSQLI_ASSOC);
}

echo json_encode([
    'status' => 'success',
    'message' => 'Данные о фотографиях получены!',
    'images' => $imageArray
]);
?>
