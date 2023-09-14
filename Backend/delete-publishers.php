<?php
require_once 'header.php';
?>

<?php
$publisher_id = $_GET['id'];
$query = "SELECT publishers.* FROM publishers WHERE publishers.id='$publisher_id'"; 
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
                    <th scope="col">Описание</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $row = $result -> fetch_assoc()
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']);?></td>
                            <td><?php echo htmlspecialchars($row['title']);?></td>
                            <td><?php echo htmlspecialchars($row['description']);?></td>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="add">
            <h1>Изтриване на автор</h1>
            <form class="add-form" action="add-publisher.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-button">
                <input id="publisherid" name="publisherid" type="hidden" value=<?php echo $publisher_id;?>>
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
            if(confirm('Сигурни ли сте, че искате да изтриете автора?')){
                $.ajax({
                    type: 'POST',
                    data: {
                        publisherid:$('#publisherid').val()
                    },


                    cache: false,
                    url: '../common/includes/publisher/delete-publisher-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#success').html('Авторът е изтрит успешно.');
                            window.location = './all_publishers.php';
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } 
        });
    });
</script>

<?php
$result->close();
$conn->close();
?>