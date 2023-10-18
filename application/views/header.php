<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Logo</h2>
        <p><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></p>
        <p><a href="<?= base_url('projects') ?>"><i class="fas fa-clone"></i> Projects</a></p>
        <p><a href="<?= base_url('tasks') ?>"><i class="fas fa-bars"></i> Tasks</a></p>
        <p><a href="<?= base_url('my-profile') ?>"><i class="fas fa-user"></i> Profile</a></p>
        <p><a href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></p>
    </div>
    <div class="top-bar"></div>