<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Chỉnh sửa Tin tức</h1>
        <form method="POST" action="index.php?url=admin&action=edit&id=<?php echo $news['id']; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($news['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($news['content']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh hiện tại</label><br>
                <img src="<?php echo $news['image']; ?>" alt="Hình ảnh" width="200"><br><br>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <input type="number" name="category_id" class="form-control" value="<?php echo $news['category_id']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
            <a href="index.php?url=admin" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>