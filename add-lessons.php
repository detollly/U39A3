<?php include "./inc/header.php"; ?>

<form method="POST" enctype="multipart/form-data">
    <?php
    $course_code = filter_var($_GET["course-code"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_name = urlencode(filter_var($_GET["course-name"], FILTER_SANITIZE_SPECIAL_CHARS));
    $number_of_lessons = filter_var($_GET["lesson-number"], FILTER_SANITIZE_SPECIAL_CHARS);
    $file_error = false;

    for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
        echo "
        <div class='" . ($file_error === false ? 'success' : 'fail') . "';>
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
                <input type='file' name='lesson-$lesson-ppt' required>
            </div>
            <div>
                <label for='lesson-$lesson-pdf'>Lesson $lesson PDF</label>
                <input type='file' name='lesson-$lesson-pdf' required>
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

        $success_messages = [];

        for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
            //Check and validate PPT Files
            if (isset($_FILES["lesson-$lesson-ppt"]["name"])) {
                //Get file info
                $lesson_ppt = $_FILES["lesson-$lesson-ppt"]["name"];
                $file_size = $_FILES["lesson-$lesson-ppt"]['size'];
                $ppt_tmp = $_FILES["lesson-$lesson-ppt"]['tmp_name'];
                $file_type = $_FILES["lesson-$lesson-ppt"]['type'];

                //Get & check file extension
                $file_name_parts = explode('.', $_FILES["lesson-$lesson-ppt"]['name']);
                $file_ext = strtolower(end($file_name_parts));
                $extensions = ["ppt", "pptx"];

                if (!in_array($file_ext, $extensions)) {
                    $file_error = true;
                    exit("Error: Unexpected file extension for $lesson_ppt! Allowed extensions: " . implode(",", $extensions));
                } elseif ($file_size > 500000) {
                    $file_error = true;
                    exit("Error: File ($lesson_ppt) size cannot be greater than 5MB.");
                }
            }

            //Check and validate PDF Files
            if (isset($_FILES["lesson-$lesson-pdf"]["name"])) {
                //Get file info
                $lesson_pdf = $_FILES["lesson-$lesson-pdf"]["name"];
                $file_size = $_FILES["lesson-$lesson-pdf"]['size'];
                $pdf_tmp = $_FILES["lesson-$lesson-pdf"]['tmp_name'];
                $file_type = $_FILES["lesson-$lesson-pdf"]['type'];

                //Get & check file extension
                $file_name_parts = explode('.', $_FILES["lesson-$lesson-pdf"]['name']);
                $file_ext = strtolower(end($file_name_parts));

                if ($file_ext != "pdf") {
                    $file_error = true;
                    exit("Error: Unexpected file extension for $lesson_pdf! Allowed extension: pdf ");
                } elseif ($file_size > 500000) {
                    $file_error = true;
                    exit("Error: File ($lesson_pdf) size cannot be greater than 5MB.");
                }

                if (!$file_error) {
                    //Create PPT directory
                    $lesson_dir = "./courses/$course_name/Lesson $lesson/";

                    //Check if directory exists and set permissions
                    if (!is_dir($lesson_dir)) {
                        mkdir($lesson_dir, 0777);
                    } else {
                        exit("Error: Directory already exists!");
                    }

                    $ppt_dir = "./courses/$course_name/Lesson $lesson/$lesson_ppt";
                    if (!move_uploaded_file($ppt_tmp, $ppt_dir)) {
                        exit("Error uploading file ($lesson_ppt).");
                    } else {
                        array_push($success_messages, "File <b>$lesson_ppt</b> has been uploaded successfully. <br>");
                    }

                    //Create PDF directory
                    $pdf_dir = "./courses/$course_name/Lesson $lesson/$lesson_pdf";
                    if (!file_exists($pdf_dir)) {
                        if (move_uploaded_file($pdf_tmp, $pdf_dir)) {
                            array_push($success_messages, "File <b>$lesson_pdf</b> has been uploaded successfully. <br>");
                        } else {
                            exit("Error uploading file ($lesson_pdf).");
                        }
                    } else {
                        exit("Error: File ($lesson_pdf) already exists!");
                    }
                }
            }

            //Get lesson data
            $lesson_title = filter_var($_POST["lesson-$lesson-title"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_description = filter_var($_POST["lesson-$lesson-description"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_video = filter_var($_POST["lesson-$lesson-video-url"], FILTER_SANITIZE_SPECIAL_CHARS);
            $lesson_ppt;
            $lesson_pdf;


            //Insert lesson into database
            $sql = "INSERT INTO lessons (title, description, pdf, ppt, video, course_id, course_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $result = $stmt->bind_param('sssssss', $lesson_title, $lesson_description, $lesson_ppt, $lesson_pdf, $lesson_video, $course_id, $course_code);
            $stmt->execute();
            $stmt->close();
        }

        // if (!$file_error) {
        //     $_SESSION["success_messages"] = $success_messages;
        //     header("Location: success-upload.php");
        // }

        //Commit the transaction
        $mysqli->commit();
    } catch (Exception $err) {
        $mysqli->rollback();
        echo 'Error ' . $err->getMessage();
    } finally {
        $mysqli->close();
    }
}
?>