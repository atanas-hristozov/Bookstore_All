<?php
require_once 'header.php';
?>

<?php

$query = "SELECT books.*, authors.name FROM books INNER JOIN authors ON books.author_id = authors.id";
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>
    <div class="content">
        <section class="value">
            <h2>Всички книги</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">Заглавие</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Създадена на</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if($result->num_rows > 0){
                            while($row = $result -> fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['isbn']);?></td>
                                        <td><?php echo htmlspecialchars($row['title']);?></td>
                                        <td><?php echo htmlspecialchars($row['name']);?></td>
                                        <td><?php echo date("d.m.Y", strtotime($row['created_at']));?></td>
                                        <td>
                                            <a href="<?php echo URLBASE; ?>/delete-book.php?id=<?php echo $row['id']; ?>" class="btn-sm">Изтриване</a>
                                            <a href="<?php echo URLBASE; ?>/edit-book.php?id=<?php echo $row['id']; ?>" class="btn-sm">Редактиране</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

<?php
require_once 'footer.php';
?>


<?php
$result->close();
$conn->close();
?>