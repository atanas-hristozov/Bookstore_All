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
            <h1>Изтриване на Категорията</h1>
            <form class="add-form" action="add-category.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-button">
                <input id="categoryid" name="categoryid" type="hidden" value=<?php echo $category_id;?>>
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
            if(confirm('Сигурни ли сте, че искате да изтриете категорията?')){
                $.ajax({
                    type: 'POST',
                    data: {
                        categoryid:$('#categoryid').val()
                    },


                    cache: false,
                    url: '../common/includes/category/delete-category-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#success').html('Категорията е изтрита успешно.');
                            window.location = './all_categories.php';
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } 
        });
    });
</script>