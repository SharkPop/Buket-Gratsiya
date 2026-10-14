<?php
include 'dbconn.php'; // Подключение к базе данных
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Инициализация ответа
$response = ['status' => 'error', 'message' => '', 'urls' => []];

// Проверка роли пользователя
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    $response['message'] = 'У вас недостаточно прав!';
    echo json_encode($response);
    exit;
}

// Проверка на наличие файлов
if (!isset($_FILES['images']) || count($_FILES['images']['name']) === 0) {
    $response['message'] = 'Файлы не получены.';
    echo json_encode($response);
    exit;
}

// Директория для загрузки
$uploadDir = realpath(__DIR__ . '/media/images/') . DIRECTORY_SEPARATOR;
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Разрешенные типы файлов
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Обработка файлов
foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
    $fileName = basename($_FILES['images']['name'][$index]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Проверка на допустимые типы файлов
    if (!in_array($fileType, $allowedTypes)) {
        $response['message'] = 'Недопустимый тип файла: ' . $fileName;
        echo json_encode($response);
        exit;
    }

    // Генерация нового имени файла
    $newFileName = $_FILES['images']['name'][$index] . uniqid() . '.' . $fileType;
    file_put_contents('debug.txt', print_r($newFileName, true));
    $targetPath = $uploadDir . $newFileName;
    $response['urls'][] = $targetPath;
    // Перемещение файла в директорию
    if (move_uploaded_file($tmpName, $targetPath)) {
        // Вставка пути к файлу в базу данных
        $stmt = $conn->prepare("INSERT INTO `image` (`Name`) VALUES (?)");
        $stmt->bind_param("s", $newFileName);
        $stmt->execute();

        // Получаем ID вставленной записи
        $imageID = $conn->insert_id; // Это будет ID последней вставленной записи

        $stmt = $conn->prepare("INSERT INTO imagesinorder (OrderID,ImageID) VALUES (?,?)");
        $stmt->bind_param("ii", $_POST['orderID'],$imageID);
        $stmt->execute();
    } else {
        // Ошибка при перемещении файла
        $error = error_get_last();
        $response['message'] = 'Ошибка перемещения файла: ' . $fileName . ' → ' . $targetPath . ' | Ошибка: ' . print_r($error, true);
        echo json_encode($response);
        exit;
    }
}

// Если хотя бы один файл загружен, меняем статус на success
if (count($response['urls']) > 0) {
    $response['status'] = 'success';
    $response['message'] = 'Файлы успешно загружены.';
} else {
    $response['message'] = 'Не удалось загрузить файлы.';
}

echo json_encode($response);