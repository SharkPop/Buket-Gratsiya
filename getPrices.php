<?php
include 'dbconn.php';
$sql = "SELECT * FROM `services`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}
echo json_encode([
    'status' => 'success',
    'services' => $services
])
?>