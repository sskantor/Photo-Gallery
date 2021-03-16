
<!doctype html>
<html>
    <body>
        <div class='container'>
            <div class="container1">
                <h2> GALERIA </h2>

                <?php
                
                $folder = "./images";
                //iterating over directories
                $files = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS),
                            RecursiveIteratorIterator::CHILD_FIRST
                        );
               
               
                if($folder1="./images"){
                    $counter = 1;

                    foreach ($files as $fileinfo) {
                        
                        if($fileinfo!="" && $fileinfo!="." && $fileinfo!=".."){
                        //getting absolute path
                        $path = $fileinfo->getRealPath();
                        $path1 = str_replace('/home/s35/public_html/', '/', $path);
                        
                        if($fileinfo->isDir()){
                        }else{
                        ?>
                        <!-- displaying photos with captions and categories-->
                        <!-- hidden inputs to get directories and extensions -->
                        <div class="gallery">
                            <?php
                            echo '<a href="'. $path1 . '">
                                <img src="'. $path1.'">
                                </a>
                            <div id="contenteditable">
                                <p id="caption-photo'. $counter .'" contenteditable>'. pathinfo($path1, PATHINFO_FILENAME).'</p>
                                <input type="hidden" name="directory-' . $counter . ' " value=" ' . pathinfo($path1, PATHINFO_DIRNAME) . ' "/>
                                <input type="hidden" name="extension-' . $counter . ' " value=" ' . pathinfo($path1, PATHINFO_EXTENSION) . ' "/>
                                </div>';
                            echo '<p id="category-caption">'.basename(dirname($path1)).'</p>';
                            
                            ?>
                            </div>
                        
                        <?php
                               $counter++;            
                            }
                        }
                    }    
                }?>            
            </div>
        </div>

    <script type='text/javascript'>
    //opening photobox
        $(document).ready(function(){            
            $('.container1').photobox('a',{ time:0 });             
        });
    </script>
    <script>
    //protecting pictures from download
        $(document).ready(function(){
            $("a").mousedown(function(e) {
                document.addEventListener('contextmenu', e =>
                    e.preventDefault()
                );
            });
        });
    </script>
    
    <script>
        //updating files after renaming
        function update_file(old_name, new_name, directory, extension) {
            //creating an object
            var update = new XMLHttpRequest();
            //specifying the request
            update.open("GET", "update_file.php?old_name=" + old_name + "&new_name=" + new_name + "&directory=" + directory + "&extension=" + extension, true);
            //function executed every time the status of the XMLHttpRequest object changes
            update.onreadystatechange = function() {
                if (this.readyState == this.DONE && this.status == 200) {
                    if (this.responseText != null) {
                        console.log(this.responseText);
                        //1 if passed values are correct
                        if(this.responseText == 1){
                            console.log("Zmiana nazwy udana");
                        }
                        else {
                            console.log("Error!");
                        }
                    }
                    else {
                        console.log("Nie wysłano!");
                    }
                }
            };
            //sending data to a server
            update.send();
        }

        document.addEventListener("DOMContentLoaded", function(){
            const editables = document.querySelectorAll("[contenteditable]");
            editables.forEach(el => {
                var curr = el.innerHTML;
                //next element is the first hidden input - directory
                var dir = el.nextElementSibling.value;
                //next element after is second hidden input - extension
                var ext = el.nextElementSibling.nextElementSibling.value;
                el.addEventListener("blur", () => {
                    localStorage.setItem("dataStorage-" + el.id, el.innerHTML);
                    //logs changed name
                    console.log(el.innerHTML); 
                    update_file(curr, el.innerHTML, dir, ext);
                })
            });
        });
    </script>
   </body>
</html> 



