<?php
require_once 'header.php';

$query = "SELECT orders.* FROM orders"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;

?>
    <div class="content">
        <section class="value">
            <h2>Всички поръчки</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">Поръчка номер</th>
                    <th scope="col">Поръчани книги</th>
                    <th scope="col">Стойност</th>
                    <th scope="col">Име</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Дата</th>
                </tr>
                </thead>
                    <?php
                        if($result->num_rows > 0){
                            while($row = $result -> fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']);?></td>
                                        <td><?php 
                                        $line_items = json_decode($row['book_isbn']);
                                        $count_items = count((array)$line_items);
                                        $i=1;

                                        foreach($line_items as $item) {
                                            echo $item->booksid;
                                            if($count_items != $i){
                                                echo ", ";
                                            }
                                            
                                            $i++;
                                        }
                                        ?></td>
                                        <td><?php echo htmlspecialchars($row['total']);?></td>
                                        <td><?php echo htmlspecialchars($row['name']);?></td>
                                        <td><?php echo htmlspecialchars($row['email']);?></td>
                                        <td><?php echo htmlspecialchars($row['phone']);?></td>
                                        <td><?php echo htmlspecialchars($row['address']);?></td>
                                        <td><?php echo date("d.m.Y", strtotime($row['purchase_date']));?></td>
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