<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forbidden</title>
    <link rel="stylesheet" href="<?= base_url('assets/admin_panel/') ?>assets/css/bootstrap.css ">

    <link rel="shortcut icon" href="<?= base_url('assets/admin_panel/') ?>assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/admin_panel/') ?>assets/css/app.css">
</head>

<body>
    <div id="error">

        <div class="container text-center pt-32">
            <h1 class='error-title'>403</h1>
            <p>You're not allowed in here</p>
            <?php if ($user['role_id'] == 2) : ?>
                <a href="<?= base_url('admin') ?>" class='btn btn-primary'>Go Home</a>
            <?php else : ?>
                <a href="<?= base_url('user') ?>" class='btn btn-primary'>Go Home</a>
            <?php endif; ?>
        </div>

        <div class="footer pt-32">
            <p class="text-center">Copyright &copy; Voler 2020</p>
        </div>
    </div>
</body>

</html>