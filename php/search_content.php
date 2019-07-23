<!DOCTYPE html>
<html lang="en">

<html>

<head>
    <title>CSCI 355</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../javascript/node.js"></script>
</head>

<body>

    <nav id="navbar">
        <div class="container">
            <div class="dropdown">
                <button class="dropbtn" onclick="window.location.href='../index.html'">HOME</button>
            </div>
        </div>
    </nav>

    <div class="dropdown">
        <div class="search">
        <form action="fileUpload.php" method="post" enctype="multipart/form-data">
            <h2 style ="color: white;">Upload a File: </h2>
            <input style = "background-color: green; color: white; padding: 10px; font-size: 17px;
                border: blue;"type="file" name="myfile" id="fileToUpload">
            <button name="submit">Upload </button>
        </form>
    </dir>
    </div>

    <div class="dropdown">
        <div class="search">
            <form class="form" method="post" action="search_content.php">
                <input type="text" id="myText" name="search_string" placeholder="Search..." value="">
                <button>Search</button>
            </form>
        </div>
    </div>

    

    <div class="container">

        <?php

            if($_POST['search_string']!='')
            {
            ?>
            <br>
            <br>
            <table style="width:100%" border="1">
                <tr>
                    <th colspan="3">Search String :
                        <?php echo $_POST['search_string']; ?>
                    </th>

                </tr>
                <tr>
    
                    <th>Serial</th>
                    <th>File Name</th>
                    <th>Content</th>
                    
                </tr>

                <?php  
                    $searchString =  $_POST['search_string'];

                    $path = "../files";

                    $dir = dir($path);

                    // the following line prevents the browser from parsing this as HTML.

                    // Get next file/dir name in directory
                    $i = 1;
                    while (false !== ($file = $dir->read()))
                    {   
                        if ($file != '.' && $file != '..')
                        {
                            // Is this entry a file or directory?
                            if (is_file($path . '/' . $file))
                            {
                                // Its a file, yay! Lets get the file's contents
                                $data = file_get_contents($path . '/' . $file);

                                $pattern = preg_quote($findThisString, '/');
                                // finalise the regular expression, matching the whole line

                                $pattern = "/^.*$pattern.*\$/m";
                                // search, and store all matching occurences in $matches

                                // Is the str in the data (case-insensitive search)
                                if (stripos($data, $searchString) !== false)
                                {
                                    if(preg_match_all($pattern, $data, $matches))
                                    {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $file; ?>
                                        </td>
                                        <td>
                                            <?php echo implode("\n", $matches[0]); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }

                                    $i++;
                                }

                            }
                        }

                    }
                    $dir->close();
                ?>
            </table>
            <?php
            } 
            ?>

    </div>

</body>

</html>