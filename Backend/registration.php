<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"/>
        <!-- theme CSS -->
        <link rel="stylesheet" href="assets/libs/css/style.css"/>
        <!-- Bootstrap bundle js -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- jquery 3.6.0 -->
        <script src="assets/vendor/jquery/jquery-3.6.0.min.js"></script>
        <!-- added registration validation
        <script defer src="registration.js"></script>-->
        <title>Регистрация</title>
    </head>
    <body class="registration">
        <div class="row m-0 h-100">
            <div class="col p-0 text-center d-flex justify-content-center align-items-center m-display-none-image">
                <img src="assets/img/login.svg" class="w-100">
            </div>
            <div class="col p-0 bg-custom d-flex justify-content-center align-items-center flex-column w-100">
                <form id="myform" class="w-75" action="#">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btn-register" class="btn btn-custom btn-lg btn-block mt-3">Регистриране</button>
                    <p id="success" style="display:none;color:green;"></p>
                    <p id="error" style="display:none;color:red;"></p>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
    $('#btn-register').unbind().bind('click', function(e){
        e.preventDefault();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        
        if (username != "" && email != "" && password != "") {
            $.ajax({
                url: "../common/includes/admin/create_admin.php",
                type: "POST",
                data: {
                    username: username,
                    email: email,
                    password: password,
                },
                cache: false,
                success: function(dataResult){  
                   var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode == 200){
                        $('#success').show();
                        $('#success').html('Успешна регистрация!');
                    } else if (dataResult.statusCode == 201){
                        $('#error').show();
                        $('#error').html('Имейлът или името, което ползвате вече съществува');
                    }
                }
            });
        } else {
            alert('Попълнете задължителните полета!')
        }
    });
</script>
