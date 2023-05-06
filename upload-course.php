<?php
include "./inc/header.php";
include "./inc/check-admin.php";
?>
<div>
    <?php
    include "./inc/get-user-data.php";
    echo "Hello {$user["name"]}";
    ?>
    <section>
        <div class="container login">
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
                        <option value="Cyber Security">Cyber Security</option>
                        <option value="Data Structures">JavaScript</option>
                        <option value="Algorithms">React</option>
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