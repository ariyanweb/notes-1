<?php
require_once 'loader.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userNumber = $_SESSION['user'];



if (isset($_GET['n_id']) && !empty($_GET['n_id'])) {
    $id = $_GET['n_id'];
    $noteContent = $_GET['n_Content'];
    $noteTitle = $_GET['n_Title'];
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
                    padding: 29px 15px;
                }

                #title {
                    border: none !important;
                    outline: none !important;
                    resize: none !important;
                    width: 770px;
                    height: 100px !important;
                    margin-bottom: 20px !important;
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
                    background-color: transparent !important;
                }

            }

            .save {
                left: 1.5rem;
                top: 2rem;
                font-size: 18px !important;
                cursor: pointer;
            }

            button {
                border: none;
                padding: 0;
            }

            .exit {
                right: 1.5rem;
                top: 2rem;
                font-size: 18px !important;
                cursor: pointer;
            }

            .no-border {
                border: none !important;
                outline: none !important;
                resize: none !important;
            }
        </style>

    <body class="position-relative">
        <form action="handle-note.php" method="POST">
            <button class="position-fixed btn btn-success save" type="submit" name="add-update"><i class="fas fa-pen text-white"></i></button>
            <input type="hidden" name="noteID" value="<?php echo $id; ?>">
            <div id="paper">
                <div>
                    <input type="text" name="titleu" value="<?php echo $noteTitle; ?>" id="title">

                    <label for="write"> </label>
                    <textarea name="contentu" id="write" required><?php echo $noteContent; ?></textarea>
                </div>
            </div>
        </form><button><a href="panel.php" class="position-fixed btn btn-danger exit">exit</a></button>
    </body>

    </html>
<?php



} else {
    header('location: panel.php');
}