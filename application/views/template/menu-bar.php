<body>
<?php
require_once APP . 'libs/ValidateUser.php';
$validator = new ValidateUser();
if ($validator->is_logged_in()) {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Vulnerable Report System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">Create report </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Template </a>
            </li>
            <?php if ($_SESSION['role'] === 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="account">Account management </a>
                </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link text-success"
                   href="profile?action=update&id=<?php echo $_SESSION['id'] ?>">Wellcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES) ?> </a>
            </li>
            <li class="nav-item">
                <button type="button" onclick="location.href = 'logout'" class="btn btn-outline-danger">Logout</button>
            </li>
        </ul>
    </div>
</nav>

<?php } ?>