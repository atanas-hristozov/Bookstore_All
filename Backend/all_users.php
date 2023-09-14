<?php
require_once 'header.php';

$query = "SELECT customers.* FROM customers"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>  
    <div class="content">
        <section class="value">
            <h2>Всички потребители</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">E_mail</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Създаден на</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if($result->num_rows > 0){
                            while($row = $result -> fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']);?></td>
                                        <td><?php echo htmlspecialchars($row['name']);?></td>
                                        <td><?php echo htmlspecialchars($row['phone']);?></td>
                                        <td><?php echo htmlspecialchars($row['email']);?></td>
                                        <td><?php echo htmlspecialchars($row['address']);?></td>
                                        <td><?php echo date("d.m.Y", strtotime($row['registrated']));?></td>
                                        <td>
                                            <a href="<?php echo URLBASE; ?>/delete-user.php?id=<?php echo $row['id']; ?>" class="btn-sm">Изтриване</a>
                                            <a href="<?php echo URLBASE; ?>/orders-user.php?id=<?php echo $row['id']; ?>" class="btn-sm">Поръчки</a>
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