<?php 
session_start();
include 'dbconn.php'; // Не забудь подключить БД

header('Content-Type: application/json');

try {
    // Проверка на пустые поля
    if (
        empty($_POST['email']) || empty($_POST['password']) ||
        empty($_POST['name']) || empty($_POST['surname']) ||
        empty($_POST['phonenum']) || empty($_POST['patronymic'])
    ) {
        throw new Exception('Заполните все поля!');
    }
    if(empty($_POST['approval']) || $_POST['approval'] != 'yes')
    {
        echo json_encode([
            'status' => 'nocheck',
            'message' => 'Вы не подтвердили разрешение на обработку персональных данных!'
        ]);
        die();
    }

    // Получение данных
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $patronymic = $_POST['patronymic'] ?? '';
    $phonenum = $_POST['phonenum'] ?? '';
    $role = 2;

    // Шифрование пароля
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Проверка существования email или телефона
    $sql = "SELECT * FROM user WHERE Email = ? OR PhoneNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $phonenum);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('Аккаунт с такой почтой или номером телефона уже существует!');
    }

    // Вставка нового пользователя
    $sql = "INSERT INTO user (Email, Password, Name, Surname, Patronymic, PhoneNumber, Role) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $email, $passwordHash, $name, $surname, $patronymic, $phonenum, $role);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['patronymic'] = $patronymic;
        $_SESSION['phonenum'] = $phonenum;
        $_SESSION['id'] = $stmt->insert_id;

        echo json_encode([
            'status' => 'success',
            'message' => 'Аккаунт создан!'
        ]);
    } else {
        throw new Exception('Ошибка при добавлении пользователя');
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'data' => $_POST
    ]);
}
