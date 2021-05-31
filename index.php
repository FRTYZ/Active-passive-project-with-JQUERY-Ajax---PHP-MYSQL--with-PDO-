<!DOCTYPE html>
<html>
<head>
    <title>Active Passive</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
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
                    include('fonc.php'); // We include our database on our pages
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
                                    class="ActivePassive" <?php echo $result['active'] == 1 ? 'checked' : '' ?> />  
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