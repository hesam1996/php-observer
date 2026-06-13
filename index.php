<?php
require_once "bootstrap.php";
require_once "check.php";

use Classes\FileController;
use Classes\LogController;
use Observers\Analytics;
use Observers\Counter;
use Observers\Logger;
use UseCases\FileDownload;


//Useful classes
$fileDownload = new FileDownload();
$fileController = new FileController();
$logController = new LogController();

//Check user clicked 'Download or Not'
$file = $_GET['file'] ?? null;

$error = null;

if (isset($_GET['file']) && !$file) {
    $error = "No file selected";
}

if (isset($_GET['file'])) {
    $fileInfo = $fileController->fetch($file);
    if (!$fileInfo) {
        header('Location: ' . URL_ROOT . 'notfound');
    } else {
        //Attach observers
        $fileDownload->attach(new Logger());
        $fileDownload->attach(new Counter());
        $fileDownload->attach(new Analytics());

        $fileDownload->download($fileInfo['id'], $fileInfo['slug'], $fileInfo['title']);
        header('Location: ' . URL_ROOT);
    }
}

//Fetch Logs
$logs = $logController->getAll();

//Fetch files
$files = $fileController->getAll();

//Total Downloads
$totalDownloads = array_sum(array_column($files, 'downloads'));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Observer Design Pattern - Demo</title>

    <link href="Assets/css/bootstrap.css" rel="stylesheet">
    <link href="Assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">File Download Observer</h2>
            <small class="text-secondary">Observer Pattern Simulation in Pure PHP</small>
            <span class="text-secondary"> | </span>
            <small class="text-secondary">Click the Download button to trigger the observer</small>
            <span class="text-secondary"> | </span>
            <small class="text-secondary">Note that no actual file is downloaded, This is just a test</small>
        </div>

        <span class="badge badge-soft px-3 py-2">
            <?= date('l d F Y') ?>
        </span>
    </div>

    <div class="row g-4">
        <!-- LEFT SIDE -->
        <div class="col-lg-8">
            <!-- FILE TABLE -->
            <div class="glass-card p-4 mb-4">

                <div class="d-flex justify-content-between mb-4">
                    <h5 class="mb-0">Available Files</h5>
                </div>

                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                    <tr class="text-secondary">
                        <th>File</th>
                        <th>Size</th>
                        <th>Downloads</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($files as $file) {
                        ?>
                        <tr class="file-row">
                            <td><?= $file['title'] ?></td>
                            <td><?= $file['size'] ?></td>
                            <td><?= $file['downloads'] ?></td>
                            <td>
                                <a href="<?= URL_ROOT . '?file=' . $file['slug'] ?>" class="btn btn-download btn-sm">Download</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <!-- LIVE LOG -->
            <div class="glass-card p-4">
                <h5 class="mb-3">Live Activity Log</h5>

                <div class="event-log">
                    <?php
                    foreach ($logs as $log) {
                        ?>
                        <?= "[" . $log['created_at'] . '] ' . $log['msg'] ?><br>
                        <?php
                    }
                    ?>
                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-lg-4">
            <!-- STATS -->
            <div class="glass-card p-4 mb-4">

                <h5 class="mb-3">Statistics</h5>

                <div class="mb-3">
                    <small class="text-secondary">Total Files</small>
                    <div class="stat-value"><?= count($files) ?></div>
                </div>

                <div class="mb-3">
                    <small class="text-secondary">Total Downloads</small>
                    <div class="stat-value"><?= $totalDownloads ?></div>
                </div>

                <div>
                    <small class="text-secondary">Observers</small>
                    <div class="stat-value">3</div>
                </div>
            </div>

            <!-- OBSERVERS -->
            <div class="glass-card p-4">

                <h5 class="mb-3">Registered Observers</h5>

                <div class="observer-box">
                    <span class="observer-active">🟢 DownloadCounter</span>
                    <span class="observer-active">🟢 ActivityLogger</span>
                    <span class="observer-active">🟢 AnalyticsTracker</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 mt-5">
            <p class="m-0 text-center text-light-emphasis">
                Implemented by
                <a class="text-light-emphasis" target="_blank" href="https://kazembeygi.com">
                    Hesam Kazembeygi
                </a>
            </p>
        </div>

        <div class="col-12 mt-3">
            <ul class="footer-social m-0 p-0 d-flex justify-content-center align-items-center gap-4">
                <li>
                    <a target="_blank" href="https://github.com/hesam1996">
                        <img src="<?= URL_ROOT ?>Assets/images/github.png" alt="Hesam Kazembeygi GitHub">
                    </a>
                </li>

                <li>
                    <a target="_blank" href="https://www.linkedin.com/in/hessam-kazembeygi/">
                        <img src="<?= URL_ROOT ?>Assets/images/linkedin.png" alt="Hesam Kazembeygi Linkedin">
                    </a>
                </li>

                <li>
                    <a target="_blank" href="https://kazembeygi.com">
                        <img src="<?= URL_ROOT ?>Assets/images/website.png" alt="Hesam Kazembeygi Website">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>