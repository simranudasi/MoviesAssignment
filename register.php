<?php
ob_start();
include_once("db.php");
if(isset($_POST['add_user'])){
    extract($_POST);
    $get_user_query = "Select * from users where email = '$email'";
    $get_user = mysqli_query($connection,$get_user_query);
    if($row = mysqli_fetch_assoc($get_user)){
        die("<html><head><title>Create User </title> </head><body><h1>User with same email already exists. <a href = 'register.php'>Click Here!</a></h1></body> </html>");
    }
    if($password === $confirmpassword){
    $options = [
        'cost' =>10,
    ];
    $hashedpassword = password_hash($password,PASSWORD_BCRYPT,$options);
    $add_user_query = "INSERT INTO users(email,password) VALUES ('$email','$hashedpassword')";
    
    $add_user = mysqli_query($connection,$add_user_query); 
    //echo mysqli_error($connection);
    header("Location: login.php");
}
    else
    {
        header("Location: register.php?password=true");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register User</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3>
                                    <?php
                                        if(isset($_GET['password'])){
                                        ?>
                                        <h4 class="text-danger">Passwords did not match </h4> <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"  for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" name="confirmpassword" id="inputConfirmPassword" type="password" placeholder="Confirm password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button name="add_user" class="btn btn-primary btn-block" type="submit">Create Account</button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
