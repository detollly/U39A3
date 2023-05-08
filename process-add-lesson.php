<?php
include "./inc/header.php";

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
            if (isset($_FILES["lesson-$lesson-ppt"]["name"])) {
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
            }

            //Check and validate PDF Files
            if (isset($_FILES["lesson-$lesson-pdf"]["name"])) {
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
            }

            //Insert lesson into database
            $sql = "INSERT INTO lessons (title, description, pdf, ppt, video, course_id, course_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $result = $stmt->bind_param('sssssss', $lesson_title, $lesson_description, $lesson_ppt, $lesson_pdf, $lesson_video, $course_id, $course_code);
            $stmt->execute();
            $stmt->close();
        }

        //Commit the transaction
        $mysqli->commit();
    } catch (Exception $err) {
        $mysqli->rollback();
        echo 'Error ' . $err->getMessage();
    } finally {
        $mysqli->close();
    }
}
