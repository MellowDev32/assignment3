<?php
require_once('database.php');

// Get all categories
$query = 'SELECT * FROM todoitems
                       ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$todoitems = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>To Do List || Assignment</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<!-- the body section -->
<body>
<header><h1>To Do List</h1></header>
<main>
    <aside>
        <!-- add a new item -->
        <h3>Add Item</h3>
        <form action="add_item.php" method="post">
            <table>
                <tr>
                    <td>
                        <label>Title:</label>
                    </td>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Description:</label>
                    </td>
                    <td>
                        <input type="text" name="description">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>&nbsp;</label>
                        <input type="submit" value="Add">
                    </td>
                </tr>
            </table>
        </form>         
    </aside>

    <section class='content'>
        <!-- display a table of items to do -->
        <?php if (empty($todoitems)){?>
        <div class='congrats'>
            <h2><b>Congratulations!</b><br></h2>
            <p>You have accomplished everything on your list!<br>  Take this time to enjoy yourself and relax, <br>or add some more items and we can get started again!</p>
        </div>
        <?php } else { ?>
        <h2>Let's Get it Done!</h2>
        <table class='display'>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>
            <?php foreach ($todoitems as $item) : ?>
            <tr>
                <td><?php echo $item['Title']; ?></td>
                <td><?php echo $item['Description']; ?></td>
                <td><form action="delete_item.php" method="post">
                    <input type="hidden" name="ItemNum"
                           value="<?php echo $item['ItemNum']; ?>">
                    <input type="submit" value="Complete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php } ?>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> To Do List</p>
</footer>
</body>
</html>
