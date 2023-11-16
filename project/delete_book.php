<?php  
session_start();

# Database Connection File
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    # simple form Validation
    if (empty($id)) {
        $em = "Error Occurred!";
        header("Location: admin/index.php?error=$em");
        exit;
    } else {
        # GET book from Database
        $sql2  = "SELECT * FROM books WHERE id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);  // Bind parameter
        $stmt2->execute();
        $stmt2->store_result();  // Store the result
        $rowCount = $stmt2->num_rows;

        if ($rowCount > 0) {
            # DELETE the book from Database
            $sql  = "DELETE FROM books WHERE id=?";
            $stmt = $conn->prepare($sql);

            // Bind parameter
            $stmt->bind_param("i", $id);

            // Execute the statement
            $res  = $stmt->execute();

            if ($res) {
                # delete the current book_cover and the file
                $cover = $the_book['cover'];
                $file  = $the_book['file'];
                $c_b_c = "uploads/cover/$cover";
                $c_f = "uploads/files/$cover";

                unlink($c_b_c);
                unlink($c_f);

                # success message
                $sm = "Successfully removed!";
                header("Location: admin/index.php?success=$sm");
                exit;
            } else {
                # Error message
                $em = "Unknown Error Occurred!";
                header("Location: admin/index.php?error=$em");
                exit;
            }
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
