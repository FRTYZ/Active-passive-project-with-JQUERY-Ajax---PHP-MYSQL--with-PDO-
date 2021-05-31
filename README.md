# Active passive project with JQUERY Ajax | PHP MYSQL (with PDO)

## Hello there,
With JQUERY Ajax, you can create more practical and efficient sites by entering the active and passive button in the Admin panel in your projects or applications with active and passive.

#### How Our Project Works,
Sending the action we did in Checkbox to the "activedata.js" file. then updating "activepassiv.php"

## İndex.php 
Active Passive And Products
![alt text](https://github.com/FRTYZ/Active-passive-project-with-JQUERY-Ajax---PHP-MYSQL--with-PDO-/blob/main/img/ss/home.png?raw=true)
 
## İndex.php 

->Shows edit status or errors in h2 tag (via active data.js)  
![alt text](https://github.com/FRTYZ/Active-passive-project-with-JQUERY-Ajax---PHP-MYSQL--with-PDO-/blob/main/img/ss/home-edit.png?raw=true)
->As you can see, passive ones do not appear in the product table.

## Datable Table
Note=Apply the Active column of our Database Table with the data type "int" and the default part "no default" 
![alt text](https://github.com/FRTYZ/Active-passive-project-with-JQUERY-Ajax---PHP-MYSQL--with-PDO-/blob/main/img/ss/database-table.png?raw=true)

### Datable Data
![alt text](https://github.com/FRTYZ/Active-passive-project-with-JQUERY-Ajax---PHP-MYSQL--with-PDO-/blob/main/img/ss/database-table-data.png?raw=true)

## Source Codes

#### Code for Active Passive

```
<div class="col-md-6">
                <!-- We created a table to show our data-->
                <table class="table table-sm table-hover">
                    <br>
                    <h4 style="text-align:center;">Active Passive Editing of Data</h4>
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Active</th>                       
                    </thead>
                    <?php
                    include('fonk.php'); // We include our database on our pages
                    $query = $connect->prepare("Select * from products"); // We write our query to sort our data by id
                    $query->execute(); // We start the query

                    while ($result = $query->fetch())  // We returned it with a while loop to sort our data
                            {      // While Start , We sort our data between the start of while and the end of while
                    ?>
                        <tbody>
                            <td><?= $result['id']?></td>
                            <td><?= $result['title']?></td>
                            <td><?= $result['content']?></td>
                            <td>
                                <label class="switch">
                                    <!-- We added id and active (1 or 0) information to our checkbox -->
                                    <input type="checkbox" id='<?php echo $result['id'] ?>'
                                    class="ActivePassiv" <?php echo $result['active'] == 1 ? 'checked' : '' ?> />  
                                    <!--Let's pay attention to what is written to the class in the input. We will send this data to our file named "activedata.js" -->
                                     <span class="slider"></span>
                                </label>
                            </td>                            
                            </tbody>
                            <?php
                        }  // While End

                        ?>
                    </table>
                    <h2 style="color:red; text-align:center;" id="result"></h2> <!-- Our header to report errors and results -->
                </div>
```

#### Code for Sorting Data in the Database 

```

<div class="col-md-6">
                <!--Sorting Data in the Database -->
                    <table class="table">
                        <br>
                        <h4 style="text-align:center;">Products</h4>
                        <h6>Sorting Data in the Database</h6>

                        <thead class="thead-dark">
                             <tr>
                                <th scope="col">id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>                                
                             </tr>
                        </thead>
                    <tbody>
                        <?php
                            $query = $connect->prepare("SELECT * FROM products where active=1"); 
            // We sort your data according to Active-Passive Status. State = 1 shows the data. Status = 0 We are not showing data
                            $query->execute(); // query end

                                while ($result = $query->fetch()) 
                                    { //While Start, We sort our data between the start of while and the end of while
                        ?>

                            <tr>
                                <td><?= $result['id']?></td>
                                <td><?= $result['title']?></td>
                                <td><?= $result['content']?></td>  
                            </tr>

                            <?php
                                    } //While End
                            ?>
                        
                    </tbody>
                </table>
                    


                </div>
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="activedata.js"></script> <!-- We get our "activdata.js" file, including-->
        <link rel="stylesheet" type="text/css" href="css/switch.css"> <!--We include the css file of our Active Passive Button -->
    </body>
    </html>
```

#### code for activepassiv.php 

```
<?php
if ($_POST) { //We check if there is a post
    include("fonk.php"); //connecting to database

    //we take variables as integers
    $id = (int)$_POST['id'];
    $status = (int)$_POST['status'];


    $satir = array('id' => $id,
        'status' => $status,
    );
    // We write our data update query.
    $sql = "UPDATE products SET active=:status WHERE id=:id;";
    $status = $connect->prepare($sql)->execute($satir);    
    echo $id . " Numbered Data Changed";
}
?>
```

#### activedata.js

```
$(document).ready(function () {
    $('.ActivePassiv').click(function (event) {
        var id = $(this).attr("id");  //we get the id value

        var status = ($(this).is(':checked')) ? '1' : '0';
        //According to the checkbox, we get the information whether it is active or passive.

        $.ajax({
            type: 'POST',
            url: 'activepassiv.php',  //We indicate the page we are processing
            data: {id: id, status: status}, //We send our data
            success: function (result) {
                $('#result').text(result);
                //We show the result in h2 tag
            },
            error: function () {
                alert('Error');
            }
        });
    });
});
```

#### Database Settings
```
<?php
$host = '127.0.0.1';
$dbname = 'activepassive';  // We wrote the name of our database
$username = 'root'; 
$password = '';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connect Error: ' . $e->getMessage();
    exit;
}
?>

```



Good Koding

