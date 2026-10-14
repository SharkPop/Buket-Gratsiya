<?php
include 'dbconn.php';
session_start();
header('Content-Type: application/json');

try {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        throw new Exception('Введите почту и пароль.');
    }

    // Запрос пользователя по email
    $sql = "SELECT * FROM user WHERE Email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'status' => 'wrongEmail',
            'message' => 'Неверный логин или пароль!'
        ]);
        die();
    }

    $user = $result->fetch_assoc();

    // Проверка пароля
    if (!password_verify($password, $user['Password'])) {
        echo json_encode([
            'status' => 'wrongPass',
            'message' => 'Неверный логин или пароль!'
        ]);
        die();
    }

    // Успешный вход
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['Email'];
    $_SESSION['name'] = $user['Name'];
    $_SESSION['surname'] = $user['Surname'];
    $_SESSION['patronymic'] = $user['Patronymic'];
    $_SESSION['phonenum'] = $user['PhoneNumber'];
    $_SESSION['role'] = $user['Role'];

    echo json_encode([
        'status' => 'success',
        'message' => 'Успешный вход'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
