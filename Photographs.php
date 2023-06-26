<?php
$dir = "photographs/";  // set your gallery folder name

$images = array();

if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if($file=="." || $file=="..") continue;

            $filePath = $dir.$file;
            if (is_file($filePath) && getimagesize($filePath) !== false) { // Check if it's a valid image file
                $title = '';
                $description = '';

                // Read image details from text file
                $detailsFilePath = $dir . basename($file, ".jpg") . ".txt";
                if (file_exists($detailsFilePath)) {
                    $details = file($detailsFilePath);
                    if (count($details) >= 2) {
                        $title = trim($details[0]);
                        $description = trim($details[1]);
                    }
                }

                $images[] = array(
                    'file' => $filePath,
                    'title' => $title,
                    'description' => $description
                );
            }
        }
        closedir($dh);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="img/fav.jpg" rel="icon">


   
   
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />

    



    <style>
        .container {
            max-width: 1350px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
            vertical-align: middle;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .image-details {
            padding: 15px;
            background-color: 00FFFFFF;
            color: #fff;
        }

        .image-details h5,
        .image-details p {
            margin: 0;
            padding: 0;
            color:#8fa457 ;
        }

        .image-details h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .image-details p {
            margin-top: 5px;
            font-size: 14px;
        }

        .contact-button {
            margin-top: 10px;
            background-color: blue;
        }
    </style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


   
<style>
  .navbar-toggler-icon {
    background-image: none;
    border: none;
    color: #8fa457; /* Set the desired color */
  }
</style>



</head>
<body>




<div class="container-fluid sticky-top" style="background-color:#FFFFFF">
      <div class="container" style="background-color:#FFFFFF">
        <nav class="navbar navbar-expand-lg navbar-dark p-0" style="background-color:#FFFFFF">
          <a href="index.html" class="navbar-brand">
            <img class="logoimg"  src="img/loggg.png" alt="">
            <!-- <h1 class="text-white">
              Giriraj<span class="text-dark"> </span>Foils
            </h1> -->
          </a>
          <button
            type="button"
            class="navbar-toggler ms-auto me-0"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"

            
          >
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
              <a href="index.html" class="nav-item nav-link active" style="color:#8fa457">Home</a>
              <a href="about-us.html" class="nav-item nav-link" style="color:#8fa457">About Us</a>
              <a href="solutions.html" class="nav-item nav-link" style="color:#8fa457">Solutions</a>
              <a href="product.html" class="nav-item nav-link" style="color:#8fa457">Product</a>
              <a href="Accreditations.html" class="nav-item nav-link" style="color:#8fa457">Accreditations</a>
             
              <a href="contact-us.html" class="nav-item nav-link" style="color:#8fa457">Contact Us</a>
              <!-- <a href="admin.php" class="nav-item nav-link" style="color:#8fa457">Login </a> -->
            </div>
            
          </div>
        </nav>
      </div>
    </div>








<div class="container">
        <img src="img/productheader.png" alt="Header Image" class="img-fluid" style="width: 1920px; height: auto;  margin-bottom: 25px ;">
      </div>





    <div class="container">
        <div class="row">
            <?php foreach($images as $image) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="gallery-item">
                        <img src="<?php echo $image['file']; ?>" alt="<?php echo $image['title']; ?>">
                        <div class="image-details">
                            <h5><?php echo $image['title']; ?></h5>
                            <p><?php echo $image['description']; ?></p>
                            <button class="btn btn-primary contact-button">Contact</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>








     <!-- Footer Start -->

     <div class="container-fluid bg-dark text-white-50 footer pt-5">
      <div class="container py-5">
        <div class="row g-5">
          
          <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
            <img src="img/footericon.png" alt="Logo" class="logo-img" style="max-width: 150px; height: auto;">
            <a href="index.html" class="d-inline-block mb-3">
              <!-- <img src="img/footericon.png" alt="Logo" class="logo-img" style="max-width: 150px; height: auto;"> -->
              <h1 class="text-white">
                Giriraj<span class="text-primary"> </span>Foils
              </h1>
            </a>
            <p class="mb-0">Founded in 1993, Giriraj Foils Pvt Ltd (GFPL) offers a comprehensive portfolio from very high security films, stamping foils, and laminates which are used by Authentication, Packaging, Healthcare, and Decorative Industry</p>
          </div>

          <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
            <h5 class="text-white mb-4">Get In Touch</h5>
            <p>
              <i class="fa fa-map-marker-alt me-3"></i>Giriraj Foils Pvt. Ltd.
              Udyog Nagar, Mathura Road, Vrindaban - 281121 (U.P.) India
              
            </p>
            <!-- <p><i class="fa fa-phone-alt me-3"></i>+91 565 2443822, 2442276, 6534422
            </p> -->
            <p><i class="fa fa-envelope me-3"></i>ashish@girirajfoils.com</p>
            <div class="d-flex pt-2">
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-twitter"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-youtube"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-instagram"></i
              ></a>
              <a class="btn btn-outline-light btn-social" href=""
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
            <h5 class="text-white mb-4">Popular Link</h5>
            <a class="btn btn-link" href="about-us.html">About Us</a>
            <a class="btn btn-link" href="contact-us.html">Contact Us</a>
            <a class="btn btn-link" href="gallery.php">Product</a>
            <a class="btn btn-link" href="solutions.html">Solutions</a>
            <a class="btn btn-link" href="Accreditations.html">Accreditations</a>
          </div>
          <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
            <h5 class="text-white mb-4">Our Services</h5>
            <a class="btn btn-link" href="solutions.html"
              >Films / Foils for High Security Application
            </a>
            <a class="btn btn-link" href="solutions.html"
              >Films / Foils for Brand Protection & Labeling</a
            >
            <a class="btn btn-link" href="solutions.html"
              >Flexible Laminates for Healthcare Packaging
            </a>
            <a class="btn btn-link" href="">Films for Interior Architectural</a>
            <!-- <a class="btn btn-link" href="">Robot Technology</a> -->
          </div>
        </div>
      </div>
      <div class="container wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Giriraj Foils</a>, All
              Right Reserved.

             
              <a class="border-bottom" href="https://quazze.com"></a>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <div class="footer-menu">
                <a href="index.html">Home</a>
                <a href="about-us.html">About us</a>
                <!-- <a href="n">News</a> -->
                <a href="privacy.html">Privacy</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   





</body>
</html>