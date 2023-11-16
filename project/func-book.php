<?php

function get_all_books($con) {
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $books = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $books = array();
    }

    return $books;
}



function get_book($con, $id) {
    $sql = "SELECT * FROM books WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id); // Assuming id is an integer, adjust if necessary
    $stmt->execute() or die($stmt->error); // Remove the array from execute

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        $book = array();
    }

    return $book;
}

# Search books function
function search_books($con, $key){
    # creating simple search algorithm :) 
    $key = "%{$key}%";
 
    $sql  = "SELECT * FROM books 
             WHERE title LIKE ?
             OR description LIKE ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$key, $key]);
 
    if ($stmt->rowCount() > 0) {
         $books = $stmt->fetchAll();
    }else {
       $books = 0;
    }
 
    return $books;
 }
 
 # get books by category
function get_books_by_category($con, $id){
    $sql  = "SELECT * FROM books WHERE category_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
 
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $books = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $books = 0;
    }
 
    return $books;
}

 
 
 # get books by author
function get_books_by_author($con, $id){
    $sql  = "SELECT * FROM books WHERE author_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
 
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $books = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $books = 0;
    }
 
    return $books;
}
?>