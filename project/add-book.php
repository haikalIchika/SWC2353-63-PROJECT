<?php
session_start();

include "config.php";
include "func-validation.php";
include "func-file-upload.php";

if (
    isset($_POST['book_title']) &&
    isset($_POST['book_description']) &&
    isset($_POST['book_author']) &&
    isset($_POST['book_category']) &&
    isset($_FILES['book_cover']) &&
    isset($_FILES['file'])
) {
    $title = $_POST['book_title'];
    $description = $_POST['book_description'];
    $author = $_POST['book_author'];
    $category = $_POST['book_category'];

    # making URL data format
    $user_input = 'title=' . $title . '&category_id=' . $category . '&desc=' . $description.'&author_id='.$author;

    # simple form validation
    $text = "Book Title";
    $location = "admin/add_book.php";
    $ms = "error";
    is_empty($title, $text, $location, $ms, $user_input);

    $text = "Book Description";
    $location = "admin/add_book.php";
    $ms = "error";
    is_empty($description, $text, $location, $ms, $user_input);

    $text = "Book Author";
    $location = "admin/add_book.php";
    $ms = "error";
    is_empty($author, $text, $location, $ms, $user_input);

    $text = "Book Category";
    $location = "admin/add_book.php";
    $ms = "error";
    is_empty($category, $text, $location, $ms, $user_input);

    # book cover uploading
    $allowed_image_exs = array("jpg", "jpeg", "png");
    $path = "cover";
    $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

    if ($book_cover['status'] == "error") {
        $em = $book_cover['data'];
        header("Location: admin/add_book.php?error=$em&$user_input");
        exit;
    }

    # file uploading
    $allowed_file_exs = array("pdf", "docx", "pptx");
    $path = "files";
    $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

    if ($file['status'] == "error") {
        $em = $file['data'];
        header("Location: admin/add_book.php?error=$em&$user_input");
        exit;
    } else {
        $file_URL = $file['data'];
        $book_cover_URL = $book_cover['data'];

        # Insert the data into the database
        $sql = "INSERT INTO books (title, author_id, description, category_id, cover, file)
        VALUES (?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssss", $title, $author, $description, $category, $book_cover_URL, $file_URL);

        $res = $stmt->execute();

        /**
        If there is no error while 
        inserting the data
        **/
        if ($res) {
            # success message
            $sm = "The book successfully created!";
            header("Location: admin/add_book.php?success=$sm");
            exit;
        } else {
            # Error message
            $em = "Unknown Error Occurred!";
            header("Location: admin/add_book.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: admin/index.php");
    exit;
}
?>
