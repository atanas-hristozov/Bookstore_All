<?php
require_once 'header.php';

$author_id = $_GET['id'];
$query = "SELECT authors.* FROM authors WHERE authors.id='$author_id'"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>
    <div class="content">
        <section class="value">
            <h2>Всички автори</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Биография</th>
                    <th scope="col">Създаден на</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $row = $result -> fetch_assoc()
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']);?></td>
                            <td><?php echo htmlspecialchars($row['name']);?></td>
                            <td><?php echo htmlspecialchars($row['bio']);?></td>
                            <td><?php echo date("d.m.Y", strtotime($row['created_at']));?></td>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="add">
                <h1>Добавяне на Автор</h1>
                <form class="add-form" action="add-author.php" method="POST" enctype="multipart/form-data">
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="name">ИМЕ *</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($row['name']);?>">
                        </div>
                    </div>
                    <div class="add-form-desc">
                        <div class="add-form-desc-item">
                            <label for="bio">Биография</label>
                            <textarea type="text" class="form-control" id="bio" name="bio"><?php echo htmlspecialchars($row['bio']);?></textarea>
                        </div>
                    </div>
                    <input id="authorid" name="authorid" type="hidden" value=<?php echo $author_id;?>>
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
                    url: '../common/includes/author/edit-author-01.php',
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