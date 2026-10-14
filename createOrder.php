<?php
header('Content-Type: application/json');
include 'dbconn.php';
session_start();

try {
    // Проверка авторизации
    if (!isset($_SESSION['role'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Вы не авторизованы!'
        ]);
        exit();
    }

    // Проверка обязательных полей
    if (!isset($_POST['table']) || !isset($_POST['arch'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Вы не выбрали стол или арку!'
        ]);
        exit();
    }

    if (!isset($_POST['color'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Вы не выбрали цвет свадьбы!'
        ]);
        exit();
    }

    if (!isset($_POST['amount']) || $_POST['amount'] <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Кол-во гостей должно быть больше нуля!'
        ]);
        exit();
    }

    // Вычисляем цену
    $price = 0;
    $selectedServices = [];

    $sqlTable = "SELECT * FROM `services` WHERE id = ?";
    $stmtTable = $conn->prepare($sqlTable);
    $stmtTable->bind_param('i', $_POST['table']);
    $stmtTable->execute();
    $result = $stmtTable->get_result();
    $table = $result->fetch_assoc();
    $price += (int)ceil($_POST['amount'] / 4) * $table['Price'];
    
    $sqlArch = "SELECT * FROM `services` WHERE id = ?";
    $stmtArch = $conn->prepare($sqlArch);
    $stmtArch->bind_param('i',$_POST['arch']);
    $stmtArch->execute();
    $result = $stmtArch->get_result();
    $arch = $result->fetch_assoc();
    $price += (int)$arch['Price'];
    $selectedServices[] = $table;
    $selectedServices[] = $arch;

    if (isset($_POST['other']) && !empty($_POST['other'])) {
        $placeholders = implode(',', array_fill(0, count($_POST['other']), '?'));
        $sqlServices = "SELECT * FROM `services` WHERE id IN ($placeholders)";
        $stmtServices = $conn->prepare($sqlServices);
        $types = str_repeat('i', count($_POST['other']));
        $stmtServices->bind_param($types, ...$_POST['other']);
        $stmtServices->execute();
        $result = $stmtServices->get_result();

        while ($service = $result->fetch_assoc()) {
            $selectedServices[] = $service;
            $price += $service['Price'];
        }
    }

    // Вставляем заказ
    $sql = "INSERT INTO `order` (UserID, OrderDate, ColorsID, Price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $currentDateTime = date("Y-m-d H:i:s");
    $stmt->bind_param("isii", $_SESSION['id'], $currentDateTime, $_POST['color'], $price);
    $stmt->execute();
    $orderID = $conn->insert_id;

    // Вставляем услуги в orderdetails
    foreach ($selectedServices as $service) {
        $insertDetail = $conn->prepare("INSERT INTO orderdetails (ServiceID, OrderID) VALUES (?, ?)");
        $insertDetail->bind_param("ii", $service['id'], $orderID);
        $insertDetail->execute();
    }

    // Успешный ответ
    echo json_encode([
        'status' => 'success',
        'message' => 'Заказ создан успешно!',
        'order_id' => $orderID,
        'post' => $_POST['other'] ?? [],
        'price' => $price, 
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'post' => $_POST
    ]);
}
?>
