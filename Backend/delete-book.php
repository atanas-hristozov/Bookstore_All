<?php
require_once 'header.php';
?>

<?php
$book_id = $_GET['id'];
$query = "SELECT books.* FROM books WHERE books.id='$book_id'";
$result = $conn->query($query);
if(!$result) die("Fatal error");

$rows = $result->num_rows;

?>
    <div class="content">
    <section class="value">
            <h2>Редактиране на книга</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Заглавие</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Година</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Език</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Брой страници</th>
                    <th scope="col">Издател</th>
                    <th scope="col">Създадена на</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $row = $result -> fetch_assoc()
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']);?></td>
                                <td><?php echo htmlspecialchars($row['isbn']);?></td>
                                <td><?php echo htmlspecialchars($row['title']);?></td>
                                <td><?php echo htmlspecialchars($row['author_id']);?></td>
                                <td><?php echo htmlspecialchars($row['category_id']);?></td>
                                <td><?php echo htmlspecialchars($row['year']);?></td>
                                <td style="max-width:100px;"><?php echo htmlspecialchars($row['description']);?></td>
                                <td><?php echo htmlspecialchars($row['lang']);?></td>
                                <td><?php echo htmlspecialchars($row['price']);?></td>
                                <td><?php echo htmlspecialchars($row['pages']);?></td>
                                <td><?php echo htmlspecialchars($row['publisher_id']);?></td>
                                <td><?php echo date("d.m.Y", strtotime($row['created_at']));?></td>
                            </tr>
                </tbody>
            </table>
        </section>

        <section class="add">
            <h1>Изтриване на книга</h1>
            <form class="add-form" action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-button">
                <input id="bookid" name="bookid" type="hidden" value=<?php echo $book_id;?>>
                    <div>
                        <input type="submit" id="btn-delete" class="btn btn-primary" name="submit" value="Изтриване">
                        <p id="success" style="padding-top: 10px;color:green;"></p>
                        <p id="warning"></p>
                    </div>
                </div>
            </form>
        </section>
    </div>


<?php
require_once 'footer.php';
?>


<script>
    $(document).ready(function () {
        $('#btn-delete').unbind().bind('click', function (e) {
            e.preventDefault();
            if(confirm('Сигурни ли сте, че искате да изтриете книгата?')){
                $.ajax({
                    type: 'POST',
                    data: {
                        bookid:$('#bookid').val()
                    },


                    cache: false,
                    url: '../common/includes/book/delete-book-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#success').html('Книгата е изтрита успешно.');
                            window.location = './all_books.php';
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } 
        });
    });
</script>