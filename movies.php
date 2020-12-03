<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user_email'])){
        header("Location: login.php");
    }
    include_once("db.php");

$query = "SELECT * FROM MOVIES";
$moviesdata = mysqli_query($connection,$query);

if(isset($_POST['add_movie'])){
    extract($_POST);
    $add_movie_query = "INSERT INTO movies(movie_name, movie_description, movie_category, movie_date) VALUES ('$movie_name','$movie_description','$movie_category','$movie_date')";
    
    $add_movie = mysqli_query($connection,$add_movie_query); 
    //echo mysqli_error($connection);
    header("Location: movies.php");
}

if(isset($_GET['logout_user'])){
    $_SESSION['user_email'] = null;
    session_destroy();
    header("Location: login.php");
}


if(isset($_POST['edit_movie_btn'])){
    extract($_POST);
    $movie_id=$_GET['edit_movie'];
    $edit_movie_query = "UPDATE movies SET movie_name='$movie_name',movie_description='$movie_description',movie_category='$movie_category',movie_date='$movie_date' WHERE movie_id=$movie_id";
    
    $edit_movie = mysqli_query($connection,$edit_movie_query); 
    //echo mysqli_error($connection);
    header("Location: movies.php");
    
    
}
    if(isset($_GET['edit_movie'])){
        $movie_id=$_GET['edit_movie'];
        $get_movie_query = "SELECT * FROM MOVIES";
        $get_movie = mysqli_query($connection,$get_movie_query);

        
    }
    if(isset($_GET['delete_movie'])){
        $movie_id=$_GET['delete_movie'];
        $get_movie_query = "delete FROM MOVIES where movie_id = $movie_id";
        $get_movie = mysqli_query($connection,$get_movie_query);
        header("Location: movies.php");
        
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
        <title>Movies</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Netflix</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    
                        <a class="dropdown-item" href="movies.php?logout_user=true">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                           
                            
                            <a class="nav-link" href="movies.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Movies
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['user_email']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Movies</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="">Netflix</a></li>
                            <li class="breadcrumb-item active">Movies</li>
                        </ol>
                        <?php
                        if(!isset($_GET['edit_movie'])){                        ?>
                        <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Add Movie</h5>
                                    <form method="post">
                                     <div class="row">
                                        <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="movie_name" aria-describedby="emailHelp" placeholder="Enter Movie name">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="movie_description" placeholder="Enter movie description">
                                      </div> 
                                       <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="movie_category" placeholder="Enter movie Category">
                                      </div> 
                                       <div class="form-group col-md-6">
                                        <label>Release Date</label>
                                        <input type="text" class="form-control" name="movie_date" placeholder="Enter movie Release Date">
                                      </div> 
                                     </div>
                                      
                                      <button type="submit" class="btn btn-primary" name="add_movie">Add</button>
                                    </form>
                              
                              </div>
                            </div>
                            <?php }
                            ?>
                            &nbsp;
                            <?php
                        if(isset($_GET['edit_movie'])){
                            if($row = mysqli_fetch_assoc($get_movie)){
                                extract($row);
                            
                        ?>
                            <div class="card" >
                              <div class="card-body">
                                <h5 class="card-title">Edit Movie</h5>
                                    <form method="post">
                                     <div class="row">
                                        <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="<?php echo $movie_name; ?>"  name="movie_name" aria-describedby="emailHelp" placeholder="Enter Movie name">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <input type="text" class="form-control" value="<?php echo $movie_description; ?>"  name="movie_description" placeholder="Enter movie description">
                                      </div> 
                                       <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <input type="text" class="form-control" value="<?php echo $movie_category; ?>"  name="movie_category" placeholder="Enter movie Category">
                                      </div> 
                                       <div class="form-group col-md-6">
                                        <label>Release Date</label>
                                        <input type="text" class="form-control" value="<?php echo $movie_date; ?>"  name="movie_date" placeholder="Enter movie Release Date">
                                      </div> 
                                     </div>
                                      
                                      <button type="submit" name="edit_movie_btn" class="btn btn-primary">Edit</button>
                                    </form>
                              
                              </div>
                            </div>
                            <?php
                        }
                        }
                            ?>
                            &nbsp;
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                List Of Movies
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Release Date</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                           <?php
                                                while($row = mysqli_fetch_assoc($moviesdata))
                                                {
                                                    extract($row);
                                            ?>
                                            <tr>
                                                <td><?php echo $movie_name; ?></td>
                                                <td><?php echo $movie_description; ?></td>
                                                <td><?php echo $movie_category; ?></td>
                                                <td><?php echo $movie_date; ?></td>
                                                <td><a href="movies.php?edit_movie=<?php echo $movie_id; ?>" class="btn btn-primary">Edit</a></td>
                                                <td><a href="movies.php?delete_movie=<?php echo $movie_id; ?>" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

