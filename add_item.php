<?php
// Get the item data
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');

// Validate inputs
if ($title == null || $description == null) {
    $error = "Invalid item data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO todoitems
                 (Title, Description)
              VALUES
                 (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();

    // Display the To Do List page
    include('index.php');
}