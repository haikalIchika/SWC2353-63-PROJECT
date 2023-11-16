<?php 
session_start();

include 'config.php';

if (isset($_POST['category_name'])) {
    $name = $_POST['category_name'];

    if (empty($name)) {
        $em = "The category name is required";
        header("Location: admin/add_category.php?error=$em");
        exit;
    } else {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("s", $name); // "s" indicates a string type
            $res = $stmt->execute();

            if ($res) {
                // Success message
                $sm = "Successfully Created!";
                header("Location: admin/add_category.php?success=$sm");
                exit;
            } else {
                // Error message
                $em = "Unknown Error Occurred!";
                header("Location: admin/add_category.php?error=$em");
                exit;
            }
        } else {
            // Handle the case where the statement preparation failed
            $em = "Statement preparation failed";
            header("Location: admin/add_author.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: admin/index.php");
    exit;
}
?>
