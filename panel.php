<?php
require_once 'loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}
$userNumber = $_SESSION['user'];
$check = mysqli_query($connection, "SELECT * FROM `notes` WHERE `user_id` = '$userNumber'");
$num_rows = mysqli_num_rows($check);
$output = mysqli_fetch_all($check, MYSQLI_NUM);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <title>Notes</title>
    <style>
        body {
            background-image: linear-gradient(rgba(105, 67, 0, 0.1) 0%, transparent 5.5%), url(assets/img/wood.png);
            background-repeat: no-repeat, repeat;
            background-size: auto, 400px 400px;
            overflow-x: hidden;
        }

        #paper {
            background-color: #fff;
            background-image: linear-gradient(rgba(53, 85, 131, 0.1) 0%, rgba(255, 255, 255, 0.2) 8%), url(img/paperfibers.png);
            background-position: 0 -3px, 0 0;
            background-size: 100% 25px, 10% 10%;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(118, 80, 13, 0.9);
            margin: 0 auto;
            margin-bottom: 10px;
            margin-top: 10px;
            height: 100% !important;
            width: 55% !important;

            div {
                border: 0 !important;
                border-left: 2px solid rgba(161, 76, 70, 0.45) !important;
                margin-left: 42px;
                height: 100% !important;
                padding: 20px 15px;
            }

            #title {
                border: none !important;
                outline: none !important;
                resize: none !important;
                width: 770px;
                height: 100px !important;
                /* margin-bottom: 20px !important; */
                z-index: 1000 !important;
                background-color: transparent !important;
                font-size: 30px;
            }

            #write {
                border: none !important;
                outline: none !important;
                resize: none !important;
                width: 770px;
                height: 90% !important;
                z-index: 100 !important;
                padding: 30px;
                background-color: transparent !important;
            }

        }

        .save {
            font-size: 18px !important;
            cursor: pointer;
        }

        button {
            border: none;
            padding: 0;
        }

        .exit {
            right: 1.5rem;
            top: 4rem;
            font-size: 18px !important;
            cursor: pointer;
        }

        .no-border {
            border: none !important;
            outline: none !important;
            resize: none !important;
        }

        .badge {
            right: -35px;
            top: 50%;
            transform: translateY(-50%);
        }

        li i {
            font-size: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .action-buttons .form {
            display: none;
        }

        .action-buttons .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .update {
            background-color: #4CAF50;
            color: white;
        }

        .update:hover {
            background-color: #45a049;
        }

        .delete {
            background-color: #f44336;
            color: white;
        }

        .delete:hover {
            background-color: #d32f2f;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }


        .detail {
            margin: 10px;
            display: inline-block;
        }

        #imageModal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
        }

        #imageModal img {
            display: block;
            margin: 5% auto;
            max-width: 90%;
            box-shadow: 0 0 15px white;
            border-radius: 10px;
        }

        #imageModalClose {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 32px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        #imageModalClose:hover {
            color: red;
        }
    </style>
</head>
<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert" id="alert-box">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<?php if (isset($success)):  ?>
    <div class="alert alert-success " role="alert" id="alert-box">
        <?php echo $success; ?>
    </div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var alertBox = document.getElementById('alert-box');
        if (alertBox) {
            alertBox.remove();
        }
    }, 5000);

    $(document).ready(function() {
        $('.fa-ellipsis-v').click(function() {
            $(this).siblings('div').fadeToggle(300); // مخفی یا نمایش با کلیک
        });
    });




    function showModal(imagePath) {
        var modal = document.getElementById("imageModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = "http://localhost/p7/uploads/" + imagePath;
    }

    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }
    // بستن با کلیک بیرون از تصویر
    document.getElementById("imageModal").addEventListener("click", function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>

<body class="position-relative">
    <form action="handle-note.php" method="POST" enctype="multipart/form-data">
        <div id="paper">
            <div>
                <input type="text" name="title" placeholder="Title :" id="title" style="width: 93%;">
                <button class="btn btn-success save" type="submit" name="add"><i class="fas fa-pen text-white"></i></button>
                <input type="file" name="file" width="85%">
                <br><br>
                <label for="write">content :</label>
                <textarea name="content" id="write" required></textarea>
                <br><br>
            </div>
        </div>
    </form>
    <button><a href="logout.php" class="position-fixed btn btn-danger exit">exit</a></button>

    <div class="container">
        <ul class="list-group">
            <?php
            for ($i = 0; $i < $num_rows; $i++) {
                for ($j = 0; $j < 6; $j++) {
                    $out[$i][$j] = $output[$i][$j];
                }
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-start me-4 mb-2  position-relative">
                    <span class="badge bg-primary position-absolute rounded-pill"><?php if ($i <= 8) {
                                                                                        echo '0' . $i + 1;
                                                                                    } else echo $i + 1; ?></span>
                    <div>
                        <div class="fw-bold text-left"><?php echo $out[$i][1]; ?></div>
                        <?php echo $out[$i][2]; ?>
                    </div>
                    <div>
                        <div class="action-buttons position-relative">
                            <div class="form">
                                <a href="http://localhost/p7/edit-note.php?n_id=<?php echo $out[$i][0] ?>&n_Title=<?php echo $out[$i][1] ?>&n_Content=<?php echo $out[$i][2] ?>" class="cursor-pointer btn update" > edit  </a>
                                <a href="http://localhost/p7/del-note.php?n_id=<?php echo $out[$i][0] ?>" class="cursor-pointer btn delete" >delete</a>
                                <div class="detail">
                                    <p class="mb-0" onclick="showModal('<?php echo $out[$i][5]; ?>')">click to view image</p>
                                </div>
                                <div id="imageModal">
                                    <span id="imageModalClose" onclick="closeModal()">
                                        <i class="fas fa-times"></i>
                                    </span>
                                    <img id="modalImage" src="<?php echo base_url() . 'uploads/' ?>">
                                </div>
                            </div>
                            <i status="0" class="fas fa-ellipsis-v px-3 py-2 mt-2 pe-1 cursor-pointer"></i>
                        </div>
                    </div>
                </li>
            <?php }
            ?>

        </ul>
    </div>

</body>

</html>