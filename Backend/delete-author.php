<?php
require_once 'header.php';
?>

<?php
$author_id = $_GET['id'];
$query = "SELECT * FROM authors WHERE authors.id = '$author_id'";
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
                    <th scope="col">Действия</th>
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
                            <td>
                                <a href="<?php echo URLBASE; ?>/view-author.php?id=<?php echo $row['id']; ?>" class="btn-sm">Изтриване</a>
                                <a href="<?php echo URLBASE; ?>/edit-author.php?id=<?php echo $row['id']; ?>" class="btn-sm">Редактиране</a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="add">
            <h1>Изтриване на автор</h1>
            <form class="add-form" action="add-author.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-button">
                <input id="authorid" name="authorid" type="hidden" value=<?php echo $author_id;?>>
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
                        authorid:$('#authorid').val()
                    },


                    cache: false,
                    url: '../common/includes/author/delete-author-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#success').html('Авторът е изтрит успешно.');
                            window.location = './all_authors.php';
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } 
        });
    });
</script>
