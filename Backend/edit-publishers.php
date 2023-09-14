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
                <h1>Добавяне на Издател</h1>
                <form class="add-form" action="add-publisher.php" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="title">ИМЕ *</label>
                            <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($row['title']);?>">
                        </div>
                        <div class="add-form-desc-item">
                            <label for="description">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <input id="publisherid" name="publisherid" type="hidden" value=<?php echo $publisher_id;?>>
                    <div class="add-form-button">
                        <div>
                            <input type="submit" id="btn-save" class="btn btn-primary" name="submit" value="Добавяне">
                            <p id="success" style="padding-top: 10px;color:green;"></p>
                            <p id="warning"></p>
                        </div>
                    </div>
                </form>
            </section>
    </div>


    <script>
    $(document).ready(function () {
        $('#btn-save').unbind().bind('click', function (e) {
            e.preventDefault();
            var name = $('#title').val();
            var bio = $('#description').val();
            var form = $('form')[0];
            var formData = new FormData(form);
            if(name != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: '../common/includes/publisher/edit-publisher-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Авторът е редактиран успешно.');
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } else {
                $('form').addClass('validate');
            }
        });
    });
</script>

<?php
require_once 'footer.php';
?>


<?php
$result->close();
$conn->close();
?>