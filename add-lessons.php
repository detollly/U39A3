<?php include "./inc/header.php"; ?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<form method="POST" enctype="multipart/form-data">
    <?php
    $course_code = filter_var($_GET["course-code"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_name = urlencode(filter_var($_GET["course-name"], FILTER_SANITIZE_SPECIAL_CHARS));
    $number_of_lessons = filter_var($_GET["lesson-number"], FILTER_SANITIZE_SPECIAL_CHARS);
    $file_error = false;


    for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
        echo "
        <div>
        <h2>Lesson $lesson</h2>
            <div>
                <label for='lesson-$lesson-title'>Lesson $lesson title: </label>
                <input type='text' name='lesson-$lesson-title' required>
            </div>
            <div>
                <label for='lesson-$lesson-description'>Lesson $lesson description: </label>
                <input type='text' name='lesson-$lesson-description' required>
            </div>
            <div>
                <label for='lesson-$lesson-ppt'>Lesson $lesson PowerPoint</label>
                <input type='file' name='lesson-$lesson-ppt'>
            </div>
            <div>
                <label for='lesson-$lesson-pdf'>Lesson $lesson PDF</label>
                <input type='file' name='lesson-$lesson-pdf'>
            </div>
            <div>
                <label for='lesson-$lesson-video-url'>Lesson $lesson video URL: </label>
                <input type='text' name='lesson-$lesson-video-url' required >
                <input type='hidden' name='course-code' value=$course_code> 
                <input type='hidden' name='course-name' value=$course_name> 
                <input type='hidden' name='lesson-number' value=$number_of_lessons> 
            </div>
        </div>";
    }
    ?>
    <input type='submit'>

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //Sanitise and validate input
    $course_code = filter_var($_POST["course-code"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_name = urldecode(filter_var($_POST["course-name"], FILTER_SANITIZE_SPECIAL_CHARS));
    $number_of_lessons = filter_var($_POST["lesson-number"], FILTER_SANITIZE_SPECIAL_CHARS);

    //Connect to database and start transaction
    include "./inc/connect.php";
    $mysqli->begin_transaction();

    try {
        //Get the course ID
        $stmt = $mysqli->prepare("SELECT * FROM courses WHERE course_code=?");
        $stmt->bind_param("s", $course_code);
        $stmt->execute();
        $resultSet = $stmt->get_result();
        $result = $resultSet->fetch_assoc();
        $course_id;
        if (!empty($result["id"])) {
            $course_id = $result["id"];
        } else {
            exit("Error: The course could not be found!");
        };

        for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
            //Create lesson directory
            $lesson_dir = "./courses/$course_name/Lesson $lesson/";

            //Check if directory exists and set permissions
            if (!is_dir($lesson_dir)) {
                mkdir($lesson_dir, 0777);
            } else {
                exit("Error: Directory already exists!");
            }

            //Get lesson data
            $lesson_title = filter_var($_POST["lesson-$lesson-title"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_description = filter_var($_POST["lesson-$lesson-description"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_video = filter_var($_POST["lesson-$lesson-video-url"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_ppt;
            $lesson_pdf;


            //Check and validate PPT Files
            if ($_FILES["lesson-$lesson-ppt"]["error"] === UPLOAD_ERR_OK) {
                //Get file info
                $lesson_ppt = $_FILES["lesson-$lesson-ppt"]["name"];
                $file_size = $_FILES["lesson-$lesson-ppt"]['size'];
                $file_tmp = $_FILES["lesson-$lesson-ppt"]['tmp_name'];
                $file_type = $_FILES["lesson-$lesson-ppt"]['type'];

                //Get & check file extension
                $file_name_parts = explode('.', $_FILES["lesson-$lesson-ppt"]['name']);
                $file_ext = strtolower(end($file_name_parts));
                $extensions = ["ppt", "pptx"];

                if (!in_array($file_ext, $extensions)) {
                    exit("Error: Unexpected file extension for $lesson_ppt! Allowed extensions: " . implode(",", $extensions));
                } elseif ($file_size > 5242880) {
                    exit("Error: File ($lesson_ppt) size cannot be greater than 5MB.");
                }

                $ppt_dir = "./courses/$course_name/Lesson $lesson/$lesson_ppt";
                if (!file_exists($ppt_dir)) {
                    if (move_uploaded_file($file_tmp, $ppt_dir)) {
                        echo "File <b>$lesson_ppt</b> has been uploaded successfully. <br>";
                    } else {
                        exit("Error uploading file ($lesson_ppt).");
                    }
                } else {
                    exit("Error: File ($lesson_ppt) already exists!");
                }
            } else {
                $lesson_ppt = null;
            }

            //Check and validate PDF Files
            if ($_FILES["lesson-$lesson-pdf"]["error"] === UPLOAD_ERR_OK) {
                //Get file info
                $lesson_pdf = $_FILES["lesson-$lesson-pdf"]["name"];
                $file_size = $_FILES["lesson-$lesson-pdf"]['size'];
                $file_tmp = $_FILES["lesson-$lesson-pdf"]['tmp_name'];
                $file_type = $_FILES["lesson-$lesson-pdf"]['type'];

                //Get & check file extension
                $file_name_parts = explode('.', $_FILES["lesson-$lesson-pdf"]['name']);
                $file_ext = strtolower(end($file_name_parts));

                if ($file_ext != "pdf") {
                    exit("Error: Unexpected file extension for $lesson_pdf! Allowed extension: pdf ");
                } elseif ($file_size > 5242880) {
                    exit("Error: File ($lesson_pdf) size cannot be greater than 5MB.");
                }

                $pdf_dir = "./courses/$course_name/Lesson $lesson/$lesson_pdf";
                if (!file_exists($pdf_dir)) {
                    if (move_uploaded_file($file_tmp, $pdf_dir)) {
                        echo "File <b>$lesson_pdf</b> has been uploaded successfully. <br>";
                    } else {
                        exit("Error uploading file ($lesson_pdf).");
                    }
                } else {
                    exit("Error: File ($lesson_pdf) already exists!");
                }
            } else {
                $lesson_pdf = null;
            }

            $sql = "INSERT INTO lessons (title, description, pdf, ppt, video, course_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);

            //Checking conditions
            if (!empty($lesson_ppt)) {
                $lesson_pdf = null;
            } elseif (!empty($lesson_pdf)) {
                $lesson_ppt = null;
            } else {
                $lesson_pdf = null;
                $lesson_ppt = null;
            }
            $stmt->bind_param('ssssss', $lesson_title, $lesson_description, $lesson_pdf, $lesson_ppt, $lesson_video, $course_id);
            $stmt->execute();
            $stmt->close();

            //Commit the transaction
            $mysqli->commit();
        }
    } catch (Exception $err) {
        $mysqli->rollback();
        echo 'Error ' . $err->getMessage();
    } finally {
        $mysqli->close();
    }
}

?>