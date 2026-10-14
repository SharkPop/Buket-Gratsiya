<?php 
include 'dbconn.php';
session_start();

try {
    if (!isset($_POST['serviceID'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID услуги не передан!'
        ]);
        return;
    }

    $serviceID = (int)$_POST['serviceID'];

    $sql = "SELECT * FROM `services` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $serviceID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'status' => 'null',
            'message' => 'Услуга не найдена!',
            'id' => $serviceID
        ]);
        return;
    }

    $service = $result->fetch_assoc();

    echo json_encode([
        'status' => 'success',
        'message' => 'Данные об услуге получены!',
        'service' => $service
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
