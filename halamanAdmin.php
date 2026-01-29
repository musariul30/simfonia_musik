<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}

if(isset($_POST['logout'])){
    // Hapus semua session
    session_unset();
    session_destroy();
    
    // Hapus semua cookie
    setcookie("cookie_username", "", time() - 3600, "/");
    setcookie("cookie_password", "", time() - 3600, "/");
    
    // Redirect ke halaman login
    header("location:login.php");
    exit();
}

include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sekolah Musik Simfonia</title>
    <link href="img/icon.jpg" rel="icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <h1 class="m-0 text-primary"></i>Simfonia</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About Us</a>
                    <a href="index.php" class="nav-item nav-link active">Schedule</a>
                </div>
                <form method="post">
                    <button type="submit" name="logout" class="btn btn-danger rounded-pill px-3">Logout <i class="fa fa-arrow-right ms-3"></i></button>
                </form>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Admin</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="container">
            <?php
            if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            ?>
            <a href="add-new.php" class="btn btn-dark mb-3">Add New</a>

            <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `crud`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["nama"] ?></td>
                    <td><?php echo $row["kelas"] ?></td>
                    <td><?php echo $row["hari"] ?></td>
                    <td><?php echo $row["jam"] ?></td>
                    <td>
                    <a href="edit.php?nama=<?php echo $row["nama"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <a href="delete.php?nama=<?php echo $row["nama"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            </table>
        </div>


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Get In Touch</h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Perumahan Gedangan Sektor 10, Jl. Bima Sakti No.2, RT.04/RW.06, Dusun 1, Gedangan, Kec. Grogol, Sukoharjo, Jawa Tengah, Indonesia 57552</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 851 0178 0907</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>simfonia@email.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/smsimfonia" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://web.facebook.com/smsimfonia" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/@smsimfonia" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <h3 class="text-white mb-4">Photo Gallery</h3>
                        <div class="row g-3 pt-10">
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-1.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-2.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-3.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-4.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-5.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-6.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-7.jpg" alt="">
                            </div>
                            <div class="col-3">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-8.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a href="#">2024 Sekolah Musik Simfonia</a> All Right Reserved.  
							Designed By <a >Cooking Coding</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>