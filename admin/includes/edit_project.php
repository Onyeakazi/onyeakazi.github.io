<?php
   if(isset($_GET['p_id'])){
        $project_id = $_GET['p_id'];
   }

    $query = "SELECT * FROM projects WHERE id = $project_id ";
    $select_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_by_id)) {
    $project_id = $row['id'];
    $project_name = $row['project_name'];
    $project_image = $row['image'];
    $project_link = $row['link'];

    }
      
    if(isset($_POST['update_project'])) {
        $project_name = $_POST['project_name'];
        $project_link = $_POST['project_link'];
        
         // Check if a new image file was uploaded
        if ($_FILES['image']['name'] != '') {
            $project_image = $_FILES['image']['name'];
            $project_image_temp = $_FILES['image']['tmp_name'];

            // Move the uploaded image to the 'img' directory
            move_uploaded_file($project_image_temp, "img/$project_image");
        } else {
            // No new image selected, retain the existing image
            $query = "SELECT image FROM projects WHERE id = {$project_id}";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $project_image = $row['image'];
        }
        
        $query = "UPDATE projects SET ";
        $query.="project_name = '{$project_name}', ";   
        $query.="image = '{$project_image}', ";
        $query.="link = '{$project_link}' ";
        $query.="WHERE id = {$project_id} ";
        $update_project = mysqli_query($connection, $query);
        if(!$update_project) {
            echo "QUERY FALIED" . mysqli_error($connection);
        }
        echo "<p class='bg-success'>Project Updated: " . " " . "<a href='project.php'>View projects</a></p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <div class="form-group">
            <label for="project_name">Project Name</label>
            <input type="text" value="<?php echo $project_name; ?>" class="form-control" name="project_name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="project_link">Project link</label>
            <input type="text" value="<?php echo $project_link; ?>" class="form-control" name="project_link">
        </div>
    </div>

    <div class="col-md-6 mb-5">
        <div class="form-group">
            <label for="inpfile" class="fw-bold">Display Image</label>:</label>
            <input type="file" accept="image/*" name="image" id="inpfile" class="form-control" style="display: none;"><br>
            <img id="image-preview" style=" width:40%;" class="image-preview__image" src="img/<?php echo $project_image; ?>" alt=""><br><br>
            <button type="button" id="profile_upload-btn" class="btn btn-success">Choose Image <i class="fa fa-image"></i></button>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_project" value="Update project" style="margin-left: 16px; font-size: 19px;">
    </div>
</form>