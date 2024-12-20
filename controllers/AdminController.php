<?php
require_once 'models/News.php';
require_once 'models/Admin.php';

class AdminController
{
    private $newsModel;
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin();
        $this->newsModel = new News();
    }

    // DASHBOARD

    public function dashboard()
    {
        $users = $this->admin->getUsers();
        $news = $this->newsModel->getAllNews();
        require 'views/admin/dashboard.php';
    }

    // MANAGE NEWS

    public function showNews()
    {
        $newsList = $this->newsModel->getAllNews();
        require_once 'views/admin/news/index.php';
    }

    public function addNews()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/news/';
                $imageName = basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $imageName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $image = $targetFilePath;
                } else {
                    echo "Lỗi khi upload ảnh.";
                    return;
                }
            } else {
                echo "Hãy chọn một ảnh để upload.";
                return;
            }

            $this->newsModel->createNews($title, $content, $image, $category_id);
            header('Location: index.php?controller=admin&action=showNews');
        }
        require_once 'views/admin/news/add.php';
    }

    public function editNews()
    {
        $id = $_GET['id'];
        $news = $this->newsModel->getNewsById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $image = $news['image'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/news/';
                $imageName = basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $imageName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $image = $targetFilePath;
                } else {
                    echo "Lỗi khi upload ảnh.";
                    return;
                }
            }
            $this->newsModel->updateNews($id, $title, $content, $image, $category_id);
            header('Location: index.php?controller=admin&action=showNews');
        }

        require_once 'views/admin/news/edit.php';
    }

    public function deleteNews($id)
    {
        $this->newsModel->deleteNews($id);
        header('Location: index.php?controller=admin&action=showNews');
    }

    // MANAGE USERS

    public function showUsers()
    {
        $users = $this->admin->getUsers();
        require 'views/admin/users/index.php';
    }

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $this->admin->addUser($username, $password);
                header('Location: index.php?controller=admin&action=showUsers');
                exit();
            } else {
                echo 'Please provide both username and password.';
            }
        } else {
            require 'views/admin/users/add.php';
        }
    }

    public function editUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->admin->getUserById($id);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $this->admin->editUser($id, $username, $password);
                    header('Location: index.php?controller=admin&action=showUsers');
                    exit();
                } else {
                    echo 'Please provide both username and password.';
                }
            } else {
                require 'views/admin/users/edit.php';
            }
        }
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->admin->deleteUser($id);
            header('Location: index.php?controller=admin&action=showUsers');
            exit();
        }
    }
}
