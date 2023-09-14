<?php
require_once 'header.php';

$sql_authors = "SELECT id, name FROM authors";
$result_authors = $conn->query($sql_authors);

$sql_categories = "SELECT id, title FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_publishers = "SELECT id, title FROM publishers";
$result_publishers = $conn->query($sql_publishers);

$conn->close();
?>       
    <div class="content">
        <section class="add">
            <h1>Добавяне на книга</h1>
            <form class="add-form" action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-desc">
                    <div class="add-form-desc-item">
                        <label for="isbn">ISBN *</label>
                        <input type="text" id="isbn" name="isbn" required>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="title">Заглавие *</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="author">Автор *</label>
                        <select id="author" name="author">
                            <?php
                                if ($result_authors->num_rows > 0) {
                                    while ($row = $result_authors->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="category">Категория *</label>
                        <select id="category" name="category">
                            <?php
                                if ($result_categories->num_rows > 0) {
                                    while ($row = $result_categories->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="year">Година</label>
                        <input type="text" id="year" name="year">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="description">Описание</label>
                        <textarea type="text" id="description" name="description"></textarea>
                    </div>
                    <div class="add-form-desc-item">
                        <label class="form-label" for="cover">Добавяне на снимка</label>
                        <input type="file" id="cover" name="cover" accept="image/*" />
                    </div>
                    <div class="add-form-desc-item">
                        <label for="lang">Език</label>
                        <input type="text" id="lang" name="lang">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="price">Цена *</label>
                        <input type="number" id="price" name="price" required>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="pages">Брой страници</label>
                        <input type="number" id="pages" name="pages">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="publisher">Издател *</label>
                        <select id="publisher" name="publisher">
                            <?php
                                if ($result_publishers->num_rows > 0) {
                                    while ($row = $result_publishers->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
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


            if(isbn != "" && title != "" && category != "" && price != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,

                    processData: false,
                    contentType: false,

                    cache: false,
                    url: '../common/includes/book/create.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Книгата е добавена успешно.');
                        } else if(dataResult.statusCode == 201 && dataResult.flag != ""){
                            switch (dataResult.flag){
                                case 1: 
                                    $('#warning').html('Файлът трябва да е с разширение .jpg, .jpeg or .png');
                                    break;
                                case 2:
                                    $('#warning').html('Файлът е твърде голям!');
                                    break;
                                case 3:
                                    $('#warning').html('Неуспех при качването на файла.');
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