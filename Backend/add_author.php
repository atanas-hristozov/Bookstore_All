<?php
require_once 'header.php';
?>     
        <div class="content">
            <section class="add">
                <h1>Добавяне на Автор</h1>
                <form class="add-form" action="add-author.php" method="POST" enctype="multipart/form-data">
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="name">ИМЕ *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="bio">Биография</label>
                            <textarea type="text" class="form-control" id="bio" name="bio"></textarea>
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
            var name = $('#name').val();
            var bio = $('#bio').val();
            var form = $('form')[0];
            var formData = new FormData(form);

            if(name != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,

                    processData: false,
                    contentType: false,

                    cache: false,
                    url: '../common/includes/author/create_author.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Авторът е добавен успешно.');
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