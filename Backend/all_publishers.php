<?php
require_once 'header.php';

$query = "SELECT publishers.* FROM publishers"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>
    <div class="content">
        <section class="value">
            <h2>Всички идатели</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if($result->num_rows > 0){
                            while($row = $result -> fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']);?></td>
                                        <td><?php echo htmlspecialchars($row['title']);?></td>
                                        <td>
                                            <a href="<?php echo URLBASE; ?>/delete-publishers.php?id=<?php echo $row['id']; ?>" class="btn-sm">Изтриване</a>
                                            <a href="<?php echo URLBASE; ?>/edit-publishers.php?id=<?php echo $row['id']; ?>" class="btn-sm">Редактиране</a>
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