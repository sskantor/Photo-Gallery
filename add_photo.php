
<!doctype html>
<html>
	<body>
    <?php
    

        if(isset($_POST['upload'])){

            //getting file name
            $filename = $_FILES['file']['name'];
            $category=$_POST['file_category'];
            //correct extensions
            $valid_ext = array('png','jpeg','jpg');
            $title = $_POST['file_title'];

            //location
            $location = "images/".$filename;

            //file extension
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            //checking extension
            if(in_array($file_extension,$valid_ext)){  
                
                //uploading file
                if(move_uploaded_file($_FILES['file']['tmp_name'],"images/".$category."/".$title.".".$file_extension)){
                    $src = $location;                                 
                }echo "Zdjęcie dodane!";          
            }               
        }
        ?>

        <?php
        //all directories
        $dir=opendir("images");
        
        $directories = glob("images" . '/*' , GLOB_ONLYDIR);

        ?>


       
   <!-- Upload form -->
  <div class = "add-area">
    <div class="form-wrapper">
        <div class="row">
          <div class="col-md-8 offset-md-4" >
            <form method='post' action='add_photo' class="dropzone" enctype='multipart/form-data'>
              <div class="form-group"> 
                <label for="title">Tytuł obrazka</label><br />
              </div>
              <div class="form-group">
                <input type="text" name="file_title" class="form-control" placeholder="Tytuł obrazka" required >
              </div>
              <div class="form-group">
                <label for="category">Kategoria</label><br />
              </div>
              <div class="form-group">
                <select class="custom-select" name="file_category" style="width: 40%" class="form-control" required>
              <option></option>
              <?php  
              //displaying categories in list
              foreach($directories as $cat){
                echo '<option value="'.basename($cat).'">'.basename($cat)."</option>\n";
              }
              ?>
                </select><br />
              </div>
              <div class="form-group">
                <input type='file' name='file' id='file'>
              </div>         
              <div class="form-group">          
                <button type='submit' value='Upload' name='upload'> Dodaj</button>
              </div>
            </form>
          </div>
        </div> 
      </div>
    </div>
 </body>
</html>
