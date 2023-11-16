<?php
session_start();

# Database Connection File
include "config.php";

/** 
 * Check if category name is submitted
 **/
if (isset($_POST['author_name']) && isset($_POST['author_id'])) {
    /** 
     * Get data from POST request and store them in variables
     **/
    $name = $_POST['author_name'];
    $id = $_POST['author_id'];

    # Simple form validation
    if (empty($name)) {
        $em = "The author name is required";
        header("Location: admin/edit_author.php?error=$em&id=$id");
        exit;
    } else {
        # UPDATE the Database
        $sql = "UPDATE authors 
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
            header("Location: admin/edit_author.php?success=$sm&id=$id");
            exit;
        } else {
            # Error message
            $em = "Unknown Error Occurred!";
            header("Location: admin/edit_author.php?error=$em&id=$id");
            exit;
        }
    }
} else {
    header("Location: admin/index.php");
    exit;
}
?>