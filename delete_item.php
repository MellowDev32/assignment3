<?php
require_once('database.php');

// Get IDs
$ItemNum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($ItemNum != false) {
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :ItemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':ItemNum', $ItemNum);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('index.php');
