<?php
include 'dbconn.php';
session_start();

try {
    $userId = $_SESSION['id'] ?? 0;

    if (!$userId) {
        throw new Exception('Вы не авторизованы!');
    }

    // Запрос заказов по ID пользователя
    $sql = "SELECT * FROM `order` WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {

        echo json_encode([
            'status' => 'null',
            'message' => 'У вас нет заказов!'
        ]);
        die();
    }
    $ordersArray = [];
    $ordersDetails = [];

    while($order = $result->fetch_assoc())
    {
        $ordersArray[] = $order;
    }


    echo json_encode([
        'status' => 'success',
        'message' => 'Данные о заказх получены!',
        'orders' => $ordersArray,
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'userID' => $userId
    ]);
}
?>