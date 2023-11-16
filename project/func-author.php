<?php

# Get all authors function
function get_all_author($con) {
    $sql = "SELECT * FROM authors";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $authors = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $authors = array();
    }

    return $authors;
}



# Get all authors by ID function
function get_author($con, $id) {
    $sql = "SELECT * FROM authors WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id); // Assuming id is an integer, adjust if necessary
    $stmt->execute() or die($stmt->error); // Remove the array from execute

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $author = $result->fetch_assoc();
    } else {
        $author = array();
    }

    return $author;
}