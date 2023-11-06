<?php 
    if(isset($_POST['add_project'])) {

        $project_name = $_POST['project_name'];
        $project_link = $_POST['project_link'];

        $project_image = $_FILES['image']['name'];
        $project_image_temp = $_FILES['image']['tmp_name'];
        
        move_uploaded_file($project_image_temp, "img/$project_image");

        $query = "INSERT INTO projects(project_name, link, image) ";

        $query .= "VALUES( '{$project_name}', '{$project_link}', '{$project_image}' ) ";

        $create_project_query = mysqli_query($connection, $query);

        echo "Project Added: " . " " . "<a href='project.php'>View projects</a>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="project_name" class="fw-bold">Project Name</label>
            <input type="text" class="form-control" name="project_name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="project_link" class="fw-bold">Link</label>
            <input type="text" class="form-control" name="project_link">
        </div>
    </div>

   
    <div class="col-md-6 mb-5">
        <div class="form-group">
            <label for="inpfile" class="fw-bold">Display Image</label>:</label>
            <input type="file" accept="image/*" name="image" id="inpfile" class="form-control" style="display: none;"><br>
            <img id="image-preview" style=" width:40%;" class="image-preview__image" src="img/placeholder.png" alt=""><br><br>
            <button type="button" id="profile_upload-btn" class="btn btn-success">Choose Image <i class="fa fa-image"></i></button>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_project" value="Add Project" style="margin-left: 16px; font-size: 19px;">
    </div>
</form>