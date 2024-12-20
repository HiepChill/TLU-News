<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">List of News</h1>
        <div class="row">
            <?php foreach ($newsList as $news): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $news['image'] ?>" class="card-img-top" alt="<?= $news['title'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $news['title'] ?></h5>
                            <p class="card-text"><?= substr($news['content'], 0, 100) ?>...</p>
                            <a href="index.php?controller=home&action=detail&id=<?= $news['id'] ?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>