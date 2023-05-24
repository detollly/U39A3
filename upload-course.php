<?php
include "./inc/header.php";
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<div>
    <?php include "./inc/get-user-data.php"; ?>
    <section>
        <div>
            <h1>Upload course</h1>
            <?php echo $message ?? null; ?>
            <form method="post" action="process-add-course.php">
                <div>
                    <label for="course-name">Course Name: </label>
                    <input type="text" name="course-name" required>
                </div>
                <div>
                    <label for="category">Category: </label>
                    <select name="category" required>
                        <option value="Databases">Databases</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="Data Science">Data Science</option>
                        <option value="Programming">Programming</option>
                    </select>
                </div>
                <div>
                    <label for="cost">Cost: </label>
                    <input type="text" name="cost" required>
                </div>
                <div>
                    <label for="teacher-id">Teacher ID:</label>
                    <input type="text" name="teacher-id" value="<?php echo $user["id"] ?>" required>
                </div>
                <div>
                    <label for="language">Language: </label>
                    <select name="language" required>
                        <option value="English">English</option>
                        <option value="English, Spanish">Enslish, Spanish</option>
                        <option value="English, German">English, German</option>
                        <option value="English, French">English, French</option>
                        <option value="English, Italian">English, Italian</option>
                    </select>
                </div>
                <div>
                    <label for="lesson-number">Number of lessons: </label>
                    <input type="text" name="lesson-number" required>
                </div>
                <div>
                    <label for="course-code">Course Code: </label>
                    <input type="text" name="course-code" required>
                </div>
                <div style="display: flex; align-items: center;">
                    <input type="checkbox" required>
                    <p>I confirm that I double checked the details.</p>
                </div>
                <button name="submit">Upload course</button>
            </form>
        </div>
    </section>
</div>