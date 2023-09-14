<?php
require_once 'header.php';
?>

<?php
require_once 'header.php';
$user_id2 = $_SESSION['login_admin'];
$query = "SELECT * FROM users where id = $user_id2"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>
    <div class="content">
    <?php $row = $result -> fetch_assoc() ?>
        <h1>Здравейте <?php echo htmlspecialchars($row['username']);?></h1>
    </div>


<?php
require_once 'footer.php';
?>


<?php
$result->close();
$conn->close();
?>