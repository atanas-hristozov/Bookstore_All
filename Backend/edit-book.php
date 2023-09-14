<?php
require_once 'header.php';
?>

<?php
$book_id = $_GET['id'];
$query = "SELECT books.* FROM books WHERE books.id='$book_id'";
$result = $conn->query($query);
if(!$result) die("Fatal error");

$sql_authors = "SELECT id, name FROM authors";
$result_authors = $conn->query($sql_authors);

$sql_categories = "SELECT id, title FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_publishers = "SELECT id, title FROM publishers";
$result_publishers = $conn->query($sql_publishers);

$rows = $result->num_rows;


// Start function
function shorter($text, $chars_limit)
{
    // Check if length is larger than the character limit
    if (strlen($text) > $chars_limit)
    {
        // If so, cut the string at the character limit
        $new_text = substr($text, 0, $chars_limit);
        // Trim off white space
        $new_text = trim($new_text);
        // Add at end of text ...
        return $new_text . "...";
    }
    // If not just return the text as is
    else
    {
    return $text;
    }
}

?>
    <div class="content">
    <section class="value">
            <h2>Редактиране на книга</h2>
            <table class="value-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Заглавие</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Година</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Език</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Брой страници</th>
                    <th scope="col">Издател</th>
                    <th scope="col">Създадена на</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $result -> fetch_assoc()
                            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']);?></td>
                            <td><?php echo htmlspecialchars($row['isbn']);?></td>
                            <td><?php echo htmlspecialchars($row['title']);?></td>
                            <td><?php echo htmlspecialchars($row['author_id']);?></td>
                            <td><?php echo htmlspecialchars($row['category_id']);?></td>
                            <td><?php echo htmlspecialchars($row['year']);?></td>
                            <td style="max-width:100px;"><?php echo shorter(htmlspecialchars($row['description']), 100);?></td>
                            <td><?php echo htmlspecialchars($row['lang']);?></td>
                            <td><?php echo htmlspecialchars($row['price']);?></td>
                            <td><?php echo htmlspecialchars($row['pages']);?></td>
                            <td><?php echo htmlspecialchars($row['publisher_id']);?></td>
                            <td><?php echo date("d.m.Y", strtotime($row['created_at']));?></td>
                        </tr>
                </tbody>
            </table>
        </section>

        <section class="add">
            <h1>Нови стойности</h1>
            <form class="add-form" action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-desc">
                    <div class="add-form-desc-item">
                        <label for="isbn">ISBN *</label>
                        <input type="text" id="isbn" name="isbn" required value="<?php echo htmlspecialchars($row['isbn']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="title">Заглавие *</label>
                        <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($row['title']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="author">Автор *</label>
                        <select id="author" name="author">
                            <?php
                                if ($result_authors->num_rows > 0) {
                                    while ($row_authors = $result_authors->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_authors['id']; ?>" <?php echo ($row_authors['id']==$row['author_id']) ? 'selected' : '' ;?>><?php echo $row_authors['name']; ?></option>
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
                                    while ($row_category = $result_categories->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_category['id']; ?>" <?php echo ($row_category['id']==$row['category_id']) ? 'selected' : '' ;?>><?php echo $row_category['title']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="add-form-desc-item">
                        <label for="year">Година</label>
                        <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($row['year']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="description">Описание</label>
                        <textarea type="text" id="description" name="description"><?php echo htmlspecialchars($row['description']);?></textarea>
                    </div>
                    <div class="add-form-desc-item">
                        <label class="form-label" for="cover">Добавяне на снимка</label>
                        <input type="file" id="cover" name="cover" accept="image/*" />
                    </div>
                    <div class="add-form-desc-item">
                        <label for="lang">Език</label>
                        <input type="text" id="lang" name="lang" value="<?php echo htmlspecialchars($row['lang']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="price">Цена *</label>
                        <input type="number" id="price" name="price" required value="<?php echo htmlspecialchars($row['price']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="pages">Брой страници</label>
                        <input type="number" id="pages" name="pages" value="<?php echo htmlspecialchars($row['pages']);?>">
                    </div>
                    <div class="add-form-desc-item">
                        <label for="publisher">Издател *</label>
                        <select id="publisher" name="publisher">
                            <?php
                                if ($result_publishers->num_rows > 0) {
                                    while ($row_publishers = $result_publishers->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_publishers['id']; ?>" <?php echo ($row_publishers['id']==$row['publisher_id']) ? 'selected' : '' ;?>><?php echo $row_publishers['title']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input id="bookid" name="bookid" type="hidden" value=<?php echo $book_id;?>>
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


            if(isbn != "" && title != "" && category != "" && price != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,

                    processData: false,
                    contentType: false,

                    cache: false,
                    url: '../common/includes/book/edit-book-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Книгата е добавена успешно.');
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