<?php
session_start();
error_reporting(0);

$dir = "Holograms/"; // set your gallery folder name

$username = 'admin'; // set your username
$password = 'admin'; // set your password

if (isset($_POST['username'])) {
    $fromuser = $_POST['username'];
    $frompass = $_POST['password'];
    if ($fromuser == $username && $frompass == $password) { // Corrected the condition
        $_SESSION["access"] = 1;
        $_SESSION['last_activity'] = time(); // Set the last activity time
    } else {
        echo "Invalid Username or Password";
    }
}

if (isset($_GET['del'])) {
    $fileToDelete = $_GET['del'];
    $imagePath = $dir . $fileToDelete;
    if (file_exists($imagePath)) {
        unlink($imagePath);
        echo "File deleted successfully!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to login page after logging out
}

if (isset($_POST['fileupload'])) {
    $dirfile = $dir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $dirfile)) {
        // Save image details to a text file
        $title = $_POST['title'];
        $description = $_POST['description'];
        $detailsFilePath = $dir . basename($_FILES['file']['name'], ".jpg") . ".txt";
        file_put_contents($detailsFilePath, $title . "\n" . $description);
        echo "File uploaded successfully!";
    } else {
        echo "Sorry, file not uploaded, please try again!";
    }
}

$useraccess = $_SESSION["access"] ?? 0;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin - Albums</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .image-details {
            margin-top: 10px;
        }

        .form-group.row {
            margin-bottom: 15px;
        }

        

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


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
          <img class="logoimg"  src="img/gglogo.png" alt="">
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
              <a href="about.html" class="nav-item nav-link" style="color:#8fa457">About Us </a>
              <a href="service.html" class="nav-item nav-link" style="color:#8fa457">Solutions</a>
              <a href="gallery.php" class="nav-item nav-link" style="color:#8fa457">Product</a>
              <a href="Accreditations.html" class="nav-item nav-link" style="color:#8fa457">Accreditations</a>
             
              <a href="contact.html" class="nav-item nav-link" style="color:#8fa457">Contact us</a>
              <a href="admin.php" class="nav-item nav-link" style="color:#8fa457">Login </a>
            </div>
            <!-- <butaton
              type="button"
              class="btn text-white p-0 d-none d-lg-block"
              data-bs-toggle="modal"
              data-bs-target="#searchModal"
              style="color:#8fa457" ><i class="fa fa-search"></i
            ></butaton> -->
          </div>
        </nav>
      </div>
    </div>

    <?php if ($useraccess != 1) { ?>

        <main class="login-form" style="margin-top: 150px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Login to Admin Panel</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-end">Username</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="username" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                                        <div class="col-md-8">
                                            <input type="password" id="password" class="form-control" name="password" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" style="margin-top: 20px;">
                    <div class="col-md-8">
                        <a href="index.html" class="btn btn-secondary">
                            <i class="fa fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </main>

    <?php } else { ?>

        <main class="login-form" style="margin-top: 50px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Upload Images</div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="1" name="fileupload">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-end">Select a File</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="file" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-end">Image Title</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-end">Image Description</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="description" required></textarea>
                                        </div>
                                    </div>



                                    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-end">Select a Category</label>
    <div class="col-md-8">
        <select class="form-control" name="category" required>
            <option value="">Select Category</option>
            <option value="1">Category 1</option>
            <option value="2">Category 2</option>
            <option value="3">Category 3</option>
            <option value="4">Category 4</option>
        </select>
    </div>
</div>




                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-success">
                                                Upload
                                            </button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-8" style="margin-top: 15px;">
                        <div class="card">
                            <div class="card-header">My Gallery</div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    if (is_dir($dir)) {
                                        if ($dh = opendir($dir)) {
                                            while (($file = readdir($dh)) !== false) {
                                                if ($file == "." || $file == "..") continue;

                                                $filePath = $dir . $file;
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

                                                    ?>

                                                    <div class="col-md-3">
                                                        <img src="<?php echo $filePath; ?>" width="100%" class="img-thumbnail">
                                                        <div class="image-details">
                                                            <h5><?php echo $title; ?></h5>
                                                            <p><?php echo $description; ?></p>
                                                        </div>
                                                        <a href="?del=<?php echo $file; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                    </div>

                                    <?php
                                                }
                                            }
                                            closedir($dh);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" style="margin-top: 20px;">
                    <div class="col-md-8">
                        <a href="index.html" class="btn btn-secondary">
                            <i class="fa fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </main>
           
        

        <div class="text-center" style="margin-top: 20px;">
            <a href="?logout=1" class="btn btn-danger" style="background-color: red; border-color: red;">Logout From Admin</a>
        </div>

    <?php } ?>

    <script>
        // Auto-logout after refreshing the page
        window.onload = function() {
            if (window.performance) {
                if (window.performance.navigation.type == 1) {
                    window.location.href = "?logout=1";
                }
            }
        };
    </script>

</body>

</html>







