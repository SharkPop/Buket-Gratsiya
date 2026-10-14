<?php
    include 'dbconn.php';
    session_start();

    try {
        $userId = $_SESSION['id'] ?? 0;
    
        if (!$userId) {
            throw new Exception('Вы не авторизованы!');
        }
    
        // Запрос услуг по ID заказа.
        $sql = "SELECT * FROM `orderdetails` WHERE `OrderID` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
        $detailResult = $stmt->get_result();

        if ($detailResult->num_rows === 0) {
            echo json_encode([
                'status' => 'null',
                'message' => 'Произошла ошибка в получении деталей заказа!',
                'id' => $_POST['id'],
                'details' => $detailResult->fetch_all()
            ]);
            die();
        }
        while($detail = $detailResult->fetch_assoc())
        {
            $ordersDetails[] = $detail;
        }


        $sqlOrder = "SELECT * FROM `order` WHERE `id` = ?";
        $stmtOrder = $conn->prepare($sqlOrder);
        $stmtOrder->bind_param('i',$_POST['id']);
        $stmtOrder->execute();
        $orderResult = $stmtOrder->get_result();
        $order = $orderResult->fetch_assoc();

        $sqlFeedback = "SELECT * FROM `feedback` WHERE `orderID` = ?";
        $stmtFeedback = $conn->prepare($sqlFeedback);
        $stmtFeedback->bind_param('i', $_POST['id']);
        $stmtFeedback->execute();
        $feedbackResult = $stmtFeedback->get_result();
        $feedback = $feedbackResult->fetch_assoc();

        if (!$feedback) 
        {
            $feedback = 'null';
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Данные о заказх получены!',
            'details' => $ordersDetails,
            'order' => $order,
            'feedback' => $feedback,
            'role' => $_SESSION['role'],
            'post' => $_POST['id']
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
            'userID' => $userId
        ]);
    }
?>