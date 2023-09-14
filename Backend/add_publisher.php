<?php
require_once 'header.php';
?>  
        <div class="content">
            <section class="add">
                <h1>Добавяне на Издател</h1>
                <form class="add-form" action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                                <label for="title">ИМЕ *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
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
                    url: '../common/includes/publisher/create_publisher.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Издателят е добавен успешно.');
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