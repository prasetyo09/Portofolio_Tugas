<?php
include "config/koneksi.php";
session_start();
session_regenerate_id();

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM about ORDER BY id DESC");
$row = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $role = $_POST['role'];
    $birthday = $_POST['birthday'];
    $website = $_POST['website'];
    $degree = $_POST['degree'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $filename = uniqid() . " " . basename($image['name']);
        $filepath = "assets/img/" . $filename;

        if ($id && !empty($row['image'])){
            $old_picture_path = "assets/img/" . $row['image'];
            if(file_exists($old_picture_path)){
                unlink($old_picture_path);
            }
        }

        move_uploaded_file($image['tmp_name'],  $filepath);

        if ($id) {
            $update = mysqli_query($conn, "UPDATE about SET 
            role = '$role', 
            birthday = '$birthday',
            website = '$website',
            degree = '$degree',
            phone = '$phone',
            email = '$email',
            city = '$city',
            status = '$status',
            description = '$description',
            image = '$filename'
            ");

            header("location:about.php?update=berhasil");
        } else {
            $insert = mysqli_query($conn, "INSERT INTO about 
            (role, birthday, website, degree, phone, email, city, status, description, image) VALUES 
            ('$role', '$birthday', '$website', '$degree', '$phone', '$email', '$city', '$status', '$description', '$filename')");

            header("location:about.php?insert=berhasil");
        }
    } else {
        $update = mysqli_query($conn, "UPDATE about SET 
            role = '$role', 
            birthday = '$birthday',
            website = '$website',
            degree = '$degree',
            phone = '$phone',
            email = '$email',
            city = '$city',
            status = '$status',
            description = '$description'
            ");

        header("location:about.php?update=berhasil");
    }
}

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM about WHERE id='$delete'");
    header("location:about.php?hapus=berhasil");
}
?>
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
    <link rel="shortcut icon" type="image/png" href="portofolio/src/assets/images/logos/seodashlogo.png" />
    <link rel="stylesheet" href="portofolio/src/assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="portofolio/src/assets/images/logos/logo-light.svg" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="dashboard.php" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="about.php" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">About</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="resume.php" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Resume</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="contact.php" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Contact</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Buttons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Alerts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Card</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Forms</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Typography</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4" class="fs-6"></iconify-icon>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:sticker-smile-circle-2-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Icons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                <span>
                                    <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li>
                    </ul>
                    <!-- <div class="unlimited-access hide-menu bg-primary-subtle position-relative mb-7 mt-7 rounded-3"> 
                <div class="d-flex">
                    <div class="unlimited-access-title me-3">
                        <h6 class="fw-semibold fs-4 mb-6 text-dark w-75">Upgrade to pro</h6>
                        <a href="#" target="_blank"
                        class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
                    </div>
                    <div class="unlimited-access-img">
                        <img src="portofolio/src/assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div> -->
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            
                            <!-- <a href="#" target="_blank"
                    class="btn btn-success"><span class="d-none d-md-block">Download Free </span> <span class="d-block d-md-none">Free</span></a> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="portofolio/src/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                                Traffic Overview
                                <span>
                                    <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Traffic Overview"></iconify-icon>
                                </span>
                            </h5>
                            <div id="traffic-overview" >
                            </div>
                        </div>
                    </div>
                </div> -->
                    <!-- <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                        <img src="portofolio/src/assets/images/backgrounds/product-tip.png" alt="image" class="img-fluid" width="205">
                        <h4 class="mt-7">Productivity Tips!</h4>
                        <p class="card-subtitle mt-2 mb-3">Duis at orci justo nulla in libero id leo
                            molestie sodales phasellus justo.</p>
                            <button class="btn btn-primary mb-3">View All Tips</button>
                        </div>
                    </div>
                </div> -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">About</h5>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Role</label>
                                        <input type="text" name="role" class="form-control" id="role" aria-describedby="emailHelp" required value="<?php echo ($id) ? $row['role'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Birthday</label>
                                        <input type="date" name="birthday" class="form-control" id="birthday" value="<?php echo ($id) ? $row['birthday'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Website</label>
                                        <input type="url" name="website" class="form-control" id="website" required value="<?php echo ($id) ? $row['website'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Degree</label>
                                        <input type="text" name="degree" class="form-control" id="degree" required value="<?php echo ($id) ? $row['degree'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Phone</label>
                                        <input type="number" name="phone" class="form-control" id="phone" required value="<?php echo ($id) ? $row['phone'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" required value="<?php echo ($id) ? $row['email'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="city" required value="<?php echo ($id) ? $row['city'] : ''?>">
                                    </div>
                                    <div class="form-check mb-4">
                                        <input type="radio" name="status" id="status" value="1" checked <?php echo ($id) && $row['status'] == 1 ? "checked" : '' ?>>
                                        <label for="exampleInputPassword1" class="form-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="status" id="status" value="0" <?php echo ($id) && $row['status'] == 0 ? "checked" : '' ?>>
                                        <label for="exampleInputPassword1" class="form-label">Non-Active</label>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Image</label>
                                        <input type="file" name="image" src="" alt="" id="image" value="<?php echo ($id) ? $row['image'] : ''?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Description</label>
                                        <textarea name="description" id="" class="form-control"><?php echo ($id) ? $row['description'] : ''?></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-25 py-8 fs-4 mb-4" name="save">Save</button>
                                    <button type="reset" class="btn btn-outline-primary w-25 py-8 fs-4 mb-4" name="reset">Reset</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- <div class="card">
                    <div class="card-body">
                    <h5 class="card-title d-flex align-items-center gap-2 mb-5 pb-3">Sessions by
                        device<span><iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Locations"></iconify-icon></span>
                    </h5>
                        <div class="row">
                            <div class="col-4">
                            <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-7 d-flex text-primary"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Computers</span>
                            <h4 class="mb-0 mt-1">87%</h4>
                            </div>
                            <div class="col-4">
                            <iconify-icon icon="solar:smartphone-line-duotone" class="fs-7 d-flex text-secondary"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Smartphone</span>
                            <h4 class="mb-0 mt-1">9.2%</h4>
                            </div>
                            <div class="col-4">
                            <iconify-icon icon="solar:tablet-line-duotone" class="fs-7 d-flex text-success"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Tablets</span>
                            <h4 class="mb-0 mt-1">3.1%</h4>
                            </div>
                        </div>

                        <div class="vstack gap-4 mt-7 pt-2">
                            <div>
                                <div class="hstack justify-content-between">
                                    <span class="fs-3 fw-medium">Computers</span>
                                    <h6 class="fs-3 fw-medium text-dark lh-base mb-0">87%</h6>
                                </div>
                                <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                </div>
                                </div>

                                <div>
                                <div class="hstack justify-content-between">
                                    <span class="fs-3 fw-medium">Smartphones</span>
                                    <h6 class="fs-3 fw-medium text-dark lh-base mb-0">9.2%</h6>
                                </div>
                                <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary" style="width: 50%"></div>
                                </div>
                                </div>

                                <div>
                                <div class="hstack justify-content-between">
                                    <span class="fs-3 fw-medium">Tablets</span>
                                    <h6 class="fs-3 fw-medium text-dark lh-base mb-0">3.1%</h6>
                                </div>
                                <div class="progress mt-6" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: 35%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    </div>
                    <div class="col-lg-4">
                        <!-- <div class="card overflow-hidden hover-img">
                    <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="portofolio/src/assets/images/blog/blog-img1.jpg" class="card-img-top" alt="matdash-img">
                    </a>
                    <span class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                        min Read</span>
                    <img src="portofolio/src/assets/images/profile/user-3.jpg" alt="matdash-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                    </div>
                    <div class="card-body p-4">
                    <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Social</span>
                    <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">As yen tumbles, gadget-loving
                        Japan goes
                        for secondhand iPhones</a>
                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-eye text-dark fs-5"></i>9,125
                        </div>
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-message-2 text-dark fs-5"></i>3
                        </div>
                        <div class="d-flex align-items-center fs-2 ms-auto">
                        <i class="ti ti-point text-dark"></i>Mon, Dec 19
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="card overflow-hidden hover-img">
                    <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="portofolio/src/assets/images/blog/blog-img2.jpg" class="card-img-top" alt="matdash-img">
                    </a>
                    <span class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                        min Read</span>
                    <img src="portofolio/src/assets/images/profile/user-2.jpg" alt="matdash-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                    </div>
                    <div class="card-body p-4">
                    <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Gadget</span>
                    <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">Intel loses bid to revive
                        antitrust case
                        against patent foe Fortress</a>
                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-eye text-dark fs-5"></i>4,150
                        </div>
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-message-2 text-dark fs-5"></i>38
                        </div>
                        <div class="d-flex align-items-center fs-2 ms-auto">
                        <i class="ti ti-point text-dark"></i>Sun, Dec 18
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="card overflow-hidden hover-img">
                    <div class="position-relative">
                    <a href="javascript:void(0)">
                        <img src="portofolio/src/assets/images/blog/blog-img3.jpg" class="card-img-top" alt="matdash-img">
                    </a>
                    <span class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                        min Read</span>
                    <img src="portofolio/src/assets/images/profile/user-3.jpg" alt="matdash-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                    </div>
                    <div class="card-body p-4">
                    <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Health</span>
                    <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">COVID outbreak deepens as more
                        lockdowns
                        loom in China</a>
                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-eye text-dark fs-5"></i>9,480
                        </div>
                        <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-message-2 text-dark fs-5"></i>12
                        </div>
                        <div class="d-flex align-items-center fs-2 ms-auto">
                        <i class="ti ti-point text-dark"></i>Sat, Dec 17
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>Distributed by <a href="https://themewagon.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
                </div>
            </div> -->
                    </div>
                </div>
                <script src="portofolio/src/assets/libs/jquery/dist/jquery.min.js"></script>
                <script src="portofolio/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script src="portofolio/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
                <script src="portofolio/src/assets/libs/simplebar/dist/simplebar.js"></script>
                <script src="portofolio/src/assets/js/sidebarmenu.js"></script>
                <script src="portofolio/src/assets/js/app.min.js"></script>
                <script src="portofolio/src/assets/js/dashboard.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>