<?php  
require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id, name, done
    from todo_list
    where user = :user
");

$itemsQuery->execute([
    'user'=> $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

// foreach($items as $item) {
//     echo $item['name'], '<br>';
// } //this fucks up the foreach down below

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesheet.css">
    <script src="https://kit.fontawesome.com/5e0d0dddaa.js" crossorigin="anonymous"></script>
    <title>to-do</title>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Jay Lists</h1>
            </div>
            <div class="links">
                <nav class="navLinks">
                    <ul>
                        <li><a href="#">Options</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </header>

    <section id="showcase">
        <div class="container">
        <h1>To-Do List</h1>
        </div>
    </section>

    <!--list begin -->
    <section>
        <div class="container">
            <div class="list">
                <h1 class="header">To Do</h1>

                <?php if(!empty($items)) : ?>
                <ul class="items">
                    <?php foreach($items as $item): ?>
                    <li>
                        <span class="item<?php echo $item['done'] ? ' done': '' ?> "><?php echo $item['name']; ?></span>
                        <?php if(!$item['done']): ?>
                            <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as Done</a>
                            <a href="delete.php?delete=true&item=<?php echo $item['id']?>" class="item-delete">Delete <i class="fas fa-trash-alt"></i></a>

                        <?php elseif($item['done']): ?>
                            <a href="mark.php?as=notdone&item=<?php echo $item['id']; ?>" class="undo-button">Undo<i class="fas fa-undo-alt"></i></a>
                            <a href="delete.php?delete=true&item=<?php echo $item['id']?>" class="item-delete">Delete <i class="fas fa-trash-alt"></i></a>
                        <?php endif; ?>
                    </li>
                    
                  
                    <?php endforeach; ?>
                </ul>
                <?php else:?>
                        <p>you haven't added anything yet</p>
                <?php endif; ?>
                <form class="item-add" action="add.php" method="post">
                    <input type="text" name="name" placeholder="type a new item" class="input" autocomplete="off" required>
                    <input type="submit" value="Add" class="submit">

                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>Jay webdesign, copyright &copy 2021</p>
    </footer>



</body>
</html>