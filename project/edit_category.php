<?php
session_start();

# Database Connection File
include "config.php";

/** 
 * Check if category name is submitted
 **/
if (isset($_POST['category_name']) && isset($_POST['category_id'])) {
    /** 
     * Get data from POST request and store them in variables
     **/
    $name = $_POST['category_name'];
    $id = $_POST['category_id'];

    # Simple form validation
    if (empty($name)) {
        $em = "The category name is required";
        header("Location: admin/edit_category.php?error=$em&id=$id");
        exit;
    } else {
        # UPDATE the Database
        $sql = "UPDATE categories 
SET name=?
WHERE id=?";
        $stmt = $conn->prepare($sql);

        # Check for prepare statement error
        if (!$stmt) {
            die("Error in prepare statement: " . $conn->error);
        }

        # Bind parameters
        $stmt->bind_param("si", $name, $id);

        $res = $stmt->execute();

        # Check for execute error
        if (!$res) {
            die("Error in execute: " . $stmt->error);
        }


        /**
         * If there is no error while updating the data
         **/
        if ($res) {
            # success message
            $sm = "Successfully updated!";
            header("Location: admin/edit_category.php?success=$sm&id=$id");
            exit;
        } else {
            # Error message
            $em = "Unknown Error Occurred!";
            header("Location: admin/edit_category.php?error=$em&id=$id");
            exit;
        }
    }
} else {
    header("Location: admin/index.php");
    exit;
}
?>