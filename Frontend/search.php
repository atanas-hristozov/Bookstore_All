<?php
require_once 'header.php';
define('URLBASE3','http://test.local/final_project');
?> 

<section>
<?php
    if(isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
//        $sql = "SELECT * FROM books WHERE title LIKE '%$search%' ";
//        $sql="SELECT isbn, category_id, books.title as title, authors.name as author, year, books.description as description, image, lang, price, publishers.title as publisher, categories.title as category FROM books
//       JOIN authors ON books.author_id = authors.id JOIN publishers ON publisher_id = publishers.id JOIN categories ON category_id = categories.id WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
        $sql="SELECT isbn, category_id, books.title as title, authors.name as author, year, books.description as description, image, lang, price, publishers.title as publisher, categories.title as category FROM books
        JOIN authors ON books.author_id = authors.id JOIN publishers ON publisher_id = publishers.id JOIN categories ON category_id = categories.id";
        $sql = "SELECT * FROM books WHERE title LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);?>
        <section class="home-categories">
                <h3>Намерени резултати</h3>
                <div class="home-categories-number">
                <div class="home-categories-number-table">
                <?php
        if($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {?>
                    <a href="<?php echo URLBASE3; ?>/Frontend/book.php?id=<?php echo $row['id']; ?>" class="home-categories-number-table-item">
                    <img src="<?php echo URLBASE3 . '/common/uploads/' . $row['image']; ?>" alt="">
                    <p class="home-categories-number-table-item-name"><?php echo $row['title']; ?></p>
                    <form class="home-categories-number-table-item-price" method="post">
                        <p>Цена: <?php echo $row['price']; ?></p>
                        <button type="submit" name="add" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    </form>
                    </a>
                
                <?php
            }
        } else {
            echo "Няма намерен резултат";
        }
        ?>
        </div>
        </div> 
                </h3>
                </section>
                <?php
    }

?>
</section>


<?php
require_once 'footer.php';
?>  

