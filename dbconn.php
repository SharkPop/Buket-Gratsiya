<?php
$host = 'localhost';  // Адрес сервера MySQL
$user = 'root';   // Имя пользователя MySQL
$pass = '';   // Пароль пользователя MySQL
$dbname = 'buketandgratsiya';  // Имя базы данных

// Создание соединения
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Ошибка подключения к базе данных: ' . $conn->connect_error
    ]);
    exit;
}
?>