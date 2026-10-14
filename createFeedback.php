<?php
header('Content-Type: application/json');
include 'dbconn.php';
session_start();
try
{
    // Проверка авторизации
    if (!isset($_SESSION['role'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Вы не авторизованы!'
        ]);
        exit();
    }
    if(!isset($_POST['feedbackText']) || empty($_POST['feedbackText']))
    {
        echo json_encode([
            'status' => 'error',
            'message' => 'Произошла ошибка с получение текста отзыва!'
        ]);
        exit();
    }
    if(!isset($_POST['orderID']) || empty($_POST['orderID']))
    {
                echo json_encode([
            'status' => 'error',
            'message' => 'Произошла ошибка с получение кода заказа!'
        ]);
        exit();
    }
    $sql = "INSERT INTO `feedback` (`text`,orderID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si',$_POST['feedbackText'],$_POST['orderID']);
    $stmt->execute();

    echo json_encode([
        'status' => 'success',
        'message' => 'Отзыв успешно создан!',
        'post' => $_POST
    ]);
}
catch(Exception $e)
{
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'post' => $_POST
    ]);
}
?>