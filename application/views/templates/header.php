<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Pixie - Ecommerce HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/tooplate-main.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/flex-slider.css">

    <!--
Tooplate 2114 Pixie
https://www.tooplate.com/view/2114-pixie
-->
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">


            <a class="navbar-brand" href="<?= base_url() ?>">Berbuku.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($title_page == 'Home') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('') ?>">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($title_page == 'Books') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('') ?>books/">Products</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0" action="<?= site_url('books/search') ?>" method="get">
                    <select name="field" class="form-control mr-sm-2">
                        <option value="title">Title</option>
                        <option value="author">Author</option>
                        <option value="isbn">ISBN</option>
                    </select>
                    <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Search by title, author, ISBN..." aria-label="Search" style="width: 300px;">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?= ($title_page == 'Cart') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('') ?>cart/">Cart</a>
                    </li>
                    <?php if ($this->session->userdata('user')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sign In
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= site_url('auth/login') ?>">Login</a>
                                <a class="dropdown-item" href="<?= site_url('auth/register') ?>">Register</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>