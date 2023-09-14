<?php
require_once 'header.php';
?>

<?php

$customer_id = $_GET['id'];
$query = "SELECT customers.* FROM customers WHERE customers.id='$customer_id'"; 
$result = $conn->query($query);
if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>
    <div class="content">
        <section class="value">
            <h2>Изтриване на потребителя</h2>
            <table class="value-table">
                <thead>
                <tr>
                <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">E_mail</th>
                    <th scope="col">Адрес</th>
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
                            <td><?php echo htmlspecialchars($row['phone']);?></td>
                            <td><?php echo htmlspecialchars($row['email']);?></td>
                            <td><?php echo htmlspecialchars($row['address']);?></td>
                            <td><?php echo date("d.m.Y", strtotime($row['registrated']));?></td>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="add">
            <h1>Изтриване на потребителя</h1>
            <form class="add-form" action="delete-user.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="add-form-button">
                <input id="customerid" name="customerid" type="hidden" value=<?php echo $customer_id;?>>
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
            if(confirm('Сигурни ли сте, че искате да изтриете потребителя?')){
                $.ajax({
                    type: 'POST',
                    data: {
                        customerid:$('#customerid').val()
                    },

                    
                    cache: false,
                    url: '../common/includes/customer/delete-customer-01.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#success').html('Потребителят е изтрит успешно.');
                            window.location = './all_users.php';
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } 
        });
    });
</script>

<?php
$result->close();
$conn->close();
?>