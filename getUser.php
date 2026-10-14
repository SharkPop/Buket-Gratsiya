<?php 
include 'dbconn.php';
session_start();

try {
    $userId = $_SESSION['id'] ?? 0;

    if (!$userId) {
        throw new Exception('Вы не авторизованы!');
    }

    // Запрос пользователя по ID
    $sql = "SELECT * FROM user WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Пользователь не найден!');
    }

    $user = $result->fetch_assoc();

    // Формирование данных
    $userData = [
        'email' => $user['Email'],
        'name' => $user['Name'],
        'surname' => $user['Surname'],
        'patronymic' => $user['Patronymic'],
        'phonenum' => $user['PhoneNumber']
    ];

    echo json_encode([
        'status' => 'success',
        'message' => 'Данные пользователя получены',
        'userData' => $userData
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
