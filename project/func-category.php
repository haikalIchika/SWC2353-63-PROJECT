<?php

function get_all_categories($con) {
    $sql = "SELECT * FROM categories";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categories = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $categories = array();
    }

    return $categories;
}

function get_category($con, $id) {
    $sql = "SELECT * FROM categories WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id); // Assuming id is an integer, adjust if necessary
    $stmt->execute() or die($stmt->error); // Remove the array from execute

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
    } else {
        $category = array();
    }

    return $category;
}