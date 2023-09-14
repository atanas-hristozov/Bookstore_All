<?php
require_once 'header.php';

define('URLBASE7','http://test.local/final_project');

if(isset($_POST['remove'])){
    if($_GET['action']=='remove'){
        foreach($_SESSION['cart'] as $key=>$value){
            if($value["product_id"]==$_GET['id']){
                unset($_SESSION['cart'][$key]);
                if($_SESSION['cart'] == null){
                    unset($_SESSION['cart']);
                }
            }
        }
    }
}
?>  

<section class="shopping-cart">
    <h2>Моята количка</h2>
    <div class="shopping-cart-all">
    <div class="shopping-cart-all-list">
            <?php
            $total = 0;
            if(isset($_SESSION['cart'])){
            $product_id=array_column($_SESSION['cart'], 'product_id');
            $query = "SELECT books.*, authors.name FROM books INNER JOIN authors ON books.author_id = authors.id";
            $result = $conn->query($query);

            if($result->num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    foreach($product_id as $id){
                        if($row['id'] == $id){
                            $total = $total + (int)$row['price'];
                                ?>
                                <form class="shopping-cart-all-list-item" action="shopping-cart.php?action=remove&id=<?php echo htmlspecialchars($row['id']);?>" method="post">
                                    <div class="shopping-cart-all-list-item-info">
                                        <img src="<?php echo URLBASE7 . '/common/uploads/' . $row['image']; ?>" alt="">
                                        <p class="shopping-cart-all-list-item-info"><?php echo htmlspecialchars($row['title']);?></p>
                                        <p class="shopping-cart-all-list-item-info"><?php echo htmlspecialchars($row['name']);?></p>
                                        <p>Цена: <?php echo htmlspecialchars($row['price']);?> лв</p>
                                        <div class="shopping-cart-all-list-item-info-buttons">
                                            <button type="submit" name="remove">Премахване</button>
                                            <input type="hidden" name="product_id">
                                        </div>  
                                    </div>
                                </form>
                                <?php
                            }
                        }
                    }
                }
            } else{
                echo "<h5>Количката е празна!</h5>";
            }
            ?>

        </div>
        <div class="shopping-cart-all-ordered">
        <?php
                if(isset($_SESSION['cart'])){
        ?>
            <h4>Детайли за поръчката</h4>
            <?php
                }
            ?>
            <div class="shopping-cart-all-ordered-details">
                <div class="shopping-cart-all-ordered-details-items">
                <?php
                if(isset($_SESSION['cart'])){
                $product_id=array_column($_SESSION['cart'], 'product_id');
                $query = "SELECT books.*, authors.name FROM books INNER JOIN authors ON books.author_id = authors.id";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        foreach($product_id as $id){
                            if($row['id'] == $id){
                ?>
                    
                        <div class="shopping-cart-all-ordered-details-items-value">
                            <h6><?php echo htmlspecialchars($row['title']);?></h6>
                            <p>Цена: <?php echo htmlspecialchars($row['price']);?> лв</p>
                        </div>   
                    
                    <?php
                            }
                        }
                    }
                    }
                        
                    ?>
                    </div>
                    <div class="shopping-cart-all-ordered-details-total">
                        <h6>Общо сума <?php echo $total?> лв<h6>
                        <?php
                        //if(isset($_SESSION['login_user'])){
                        //    $customer_in = $_SESSION['login_user'];
                        
                            //if($customer_in = "")
                            //{
                            if(isset($_SESSION['login_user'])){
                                ?>
                                <a href="<?php echo URLBASE7; ?>/Frontend/chek_out.php?id=6">Финализиране</a>
                                <?php
                            } else {
                        ?>
                        <a href="<?php echo URLBASE7; ?>/Frontend/chek_out.php">Финализиране</a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php
require_once 'footer.php';
?>  