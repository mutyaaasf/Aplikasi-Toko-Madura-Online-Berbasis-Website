<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection file
include_once "db_connect.php";

// Check if key and quantity parameters exist
if(isset($_GET['key']) && isset($_GET['quantity'])) {
    $key = $_GET['key'];
    $quantity = $_GET['quantity'];

    // Check if quantity is a positive integer
    if (filter_var($quantity, FILTER_VALIDATE_INT) && $quantity > 0) {
        // Get the item from the session
        $item = $_SESSION['cart'][$key];

        // Fetch stock from database
        $stmt = $conn->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->bind_param("i", $item['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        // Check if requested quantity is available
        if ($quantity <= $product['stock']) {
            // Update quantity in session
            $_SESSION['cart'][$key]['quantity'] = $quantity;
            echo "success";
        } else {
            echo "error: Stok tidak mencukupi";
        }
    } else {
        echo "error: Invalid quantity";
    }
} else {
    echo "error: Parameter tidak lengkap";
}
?>
