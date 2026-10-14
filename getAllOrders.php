<?php
include 'dbconn.php';
session_start();
$userId = $_SESSION['id'] ?? 0;

try {
    $sortField = isset($_POST['sortField']) ? trim($_POST['sortField']) : null;
    $sortDirection = isset($_POST['sortDirection']) ? strtoupper(trim($_POST['sortDirection'])) : null;

    $idSearch = isset($_POST['idSearch']) ? trim($_POST['idSearch']) : null;
    $dateFrom = isset($_POST['dateFrom']) ? trim($_POST['dateFrom']) : null;
    $dateTo = isset($_POST['dateTo']) ? trim($_POST['dateTo']) : null;

    $allowedFields = ['OrderDate', 'id'];
    $allowedDirections = ['ASC', 'DESC'];

    $sql = "SELECT * FROM `order` WHERE 1=1";
    $params = [];
    $types = '';

    // Ограничение по текущему пользователю
    if (!empty($userId)) {
        $sql .= " AND UserID = ?";
        $params[] = $userId;
        $types .= 'i';
    }

    // Фильтрация по ID заказа (точное совпадение)
    if (!empty($idSearch) && ctype_digit($idSearch)) {
        $sql .= " AND CAST(id AS CHAR) LIKE ?";
        $params[] = $idSearch . '%';
        $types .= 's';
    }


    // Фильтрация по дате от/до
    if (!empty($dateFrom)) {
        $sql .= " AND OrderDate >= ?";
        $params[] = $dateFrom;
        $types .= 's';
    }

    if (!empty($dateTo)) {
        $sql .= " AND OrderDate <= ?";
        $params[] = $dateTo;
        $types .= 's';
    }

    // Сортировка
    if (in_array($sortField, $allowedFields) && in_array($sortDirection, $allowedDirections)) {
        $sql .= " ORDER BY $sortField $sortDirection";
    }

    $stmt = $conn->prepare($sql);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'status' => 'null',
            'message' => 'Заказов нет!'
        ]);
        exit;
    }

    $ordersArray = [];
    while ($order = $result->fetch_assoc()) {
        $ordersArray[] = $order;
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Данные о заказах получены!',
        'orders' => $ordersArray,
        'field' => $sortField,
        'sort' => $sortDirection
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
