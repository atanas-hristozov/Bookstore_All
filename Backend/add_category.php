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
            var title = $('#title').val();
            var description = $('#description').val();
            
            
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
                    url: '../common/includes/category/create_category.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
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


<?php
require_once 'footer.php';
?>