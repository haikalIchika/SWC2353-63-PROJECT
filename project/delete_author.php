<?php  
session_start();

# Database Connection File
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    #simple form Validation
    if (empty($id)) {
        $em = "Error Occurred!";
        header("Location: admin/index.php?error=$em");
        exit;
    } else {
        # DELETE the category from Database
        $sql  = "DELETE FROM authors WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        $res  = $stmt->execute();

        if ($res) {
            # success message
            $sm = "Successfully removed!";
            header("Location: admin/index.php?success=$sm");
            exit;
        } else {
            $em = "Error Occurred!";
            header("Location: admin/index.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: admin/index.php");
    exit;
}
?>
