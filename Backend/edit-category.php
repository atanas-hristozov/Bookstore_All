<?php
require_once 'header.php';
?>

<?php
$category_id = $_GET['id'];
$query = "SELECT * FROM categories WHERE categories.id='$category_id'"; 
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
                    <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Картинка</th>
                    <th scope="col">Създаден на</th>
                </tr>
                </thead>
                    <?php
                        $row = $result -> fetch_assoc()
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']);?></td>
                            <td><?php echo htmlspecialchars($row['title']);?></td>
                            <td><?php echo htmlspecialchars($row['description']);?></td>
                            <td><?php echo htmlspecialchars($row['image']);?></td>
                            <td><?php echo date("d.m.Y", strtotime($row['created_at']));?></td>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="add">
                <h1>Добавяне на категория</h1>
                <form action="add-category.php" method="POST" enctype="multipart/form-data">
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="title">ИМЕ *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="add-form-desc-item">
                            <label class="form-label" for="cover">Добавяне на снимка</label>
                            <input type="file" id="cover" name="cover" accept="image/*" />
                        </div>
                        <div class="add-form-desc-item">
                            <label for="description">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <input id="categoryid" name="categoryid" type="hidden" value=<?php echo $category_id;?>>
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
<?php
require_once 'footer.php';
?>

<script>
    $(document).ready(function () {
        $('#btn-save').unbind().bind('click', function (e) {
            e.preventDefault();
            var isbn = $('#isbn').val();
            var title = $('#title').val();
            var author = $('#author').val();
            var category = $('#category').val();
            var year = $('#year').val();
            var description = $('#description').val();
            var cover = $('#cover').val();
            var lang = $('#lang').val();
            var price = $('#price').val();
            var pages = $('#pages').val();
            var publisher = $('#publisher').val();
            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('cover', $('input[type=file]')[0].files[0]);
            if(title != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,

                    processData: false,
                    contentType: false,

                    cache: false,
                    url: '../common/includes/category/edit-category-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Категорията е добавена успешно.');
                        } else if(dataResult.statusCode == 201 && dataResult.flag != ""){
                            switch (dataResult.flag){
                                case 1: 
                                    $('#warning').html('Your file extension must be .jpg, .jpeg or .png');
                                    break;
                                case 2:
                                    $('#warning').html('File too large!');
                                    break;
                                case 3:
                                    $('#warning').html('Failed to upload file.');
                                    break;
                            }
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