                        
<!doctype html>
<html>
	<body>                    
        <div class="add-area">
            <div class="form-wrapper">
                <div class="row">                
                    <div class="col-md-6">
                        <div class="card" style="height: 90%;">
                            <div class="card-body">                                    
                                <div class="form-group">
                                    <label for="title">DODAJ KATEGORIĘ</label><br />
                                </div>
                                <form method='post' action='/category'>
                                    <div class="form-group">
                                        <input type="text" name="category_name" class="form-control" placeholder="Nazwa kategorii" >
                                    </div>
                                    <div class="form-group">          
                                        <button type='submit' value='Add' name='add'> Dodaj</button>
                                    </div>

                                    <?php
                                    //addind category
                                    if(isset($_POST['add'])){
                                        if(isset($_POST['category_name']) and $_POST['category_name']!=''){
                                            $new_category_title =$_POST['category_name'];                            
                                            if (!file_exists('images/'.$new_category_title)) {
                                                mkdir('images/'.$new_category_title);
                                                echo "Dodano";
                                            }else{
                                            echo "Taka kategoria już istnieje";
                                            }
                                        }else{
                                            echo "Wpisz nazwę kategorii";
                                        }
                                    }
                                    ?>
                                </form>                    
                                <div class="form-group">
                                    <label for="title">USUŃ KATEGORIĘ</label><br />
                                </div>
                                <form method='post' action='/category'>
                                    <div class="form-group">
                                        <select  class="custom-select" name="category_to_delete" style="width:60%;">
                                        <?php 
                                            //deleting category function                                     
                                            function delete_directory($dirname) {
                                                if (is_dir($dirname))
                                                    $dir_handle = opendir($dirname);
                                                if (!$dir_handle)
                                                    return false;
                                                while($file = readdir($dir_handle)) {
                                                    if ($file != "." && $file != "..") {
                                                        if (!is_dir($dirname."/".$file))
                                                            unlink($dirname."/".$file);
                                                        else
                                                            delete_directory($dirname.'/'.$file);
                                                    }
                                                }
                                                closedir($dir_handle);
                                                rmdir($dirname);                                                
                                                return true;
                                            }
                                    
                                            //deleting chosen category
                                            if(isset($_POST['delete'])){
                                                if(isset($_POST['category_to_delete']) && $_POST['category_to_delete']!=''){
                                                    $category_delete = $_POST['category_to_delete'];
                                                    delete_directory('images/'.$category_delete);                                                    
                                                }
                                            }
                                            //category list
                                            foreach(glob(dirname(__FILE__) . '/images/*') as $categories_list){
                                                if(is_dir($categories_list)){
                                                    $categories_list = basename($categories_list);
                                                    echo "<option value='" . $categories_list . "'>".$categories_list."</option>";
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">          
                                        <button type='submit' value='Delete' name='delete'> Usuń</button>
                                    </div>                                               
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>   
    </body>
</html>