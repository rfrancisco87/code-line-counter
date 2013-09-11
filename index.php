<?php
/*
 * Copyright (c) 2011 Dalton Tan
 * Licensed under the MIT license http://www.opensource.org/licenses/mit-license
 *
 * @author Dalton Tan
 *
 * Modified by: Roberto Francisco
 * Contact: mail@robertofrancisco.com
 *
 *
 * Icons by: http://www.fatcow.com/free-icons & http://www.customicondesign.com
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Code Line Counter</title>
        <link href="css/css.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    </head>
    <body>
        <div id="wrap">
            <a href="index.php"><h1><img src="img/code.png">Line Counter</h1></a>
            <h2 class="subtitle">How many lines of code contains your project?</h2>
            <div id="dir_bar">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <b>Directory: </b>
                    <input class="input" type="text" name="dir" autofocus style="width: 390px"/>
                    <input class="btn_submit" type="submit" value="Submit" />
                </form>
            </div>
            <?php
            if(empty($_GET['dir']))
            {
                echo '<h2 style="color: #E67F7A; text-align:center;"">Please fill the directory field first.</h2>';
                exit;
            }
            if(isset($_GET['dir'])) {
                $src = __DIR__ . '/protected/';
                require $src . 'Folder.php';
                require $src . 'File.php';
                require $src . 'Option.php';
                require $src . 'Html.php';
                echo '<br>';
                echo '<center><h2>Directory inspected: '.($_GET['dir']) . '</h2></center><hr />';
                echo '<h2 style="color: #7AB45F;">Inspected files:</h2>';


                //Use GET so this script could be reused elsewhere
                //Set to user defined options or default one
                $options = isset($_GET['options']) ? $_GET['options'] : array(
                    'ignoreFolders' => explode(', ', '.svn, .git, nbproject'),
                    'ignoreFiles' => explode(', ', 'jquery-1.5.js, jquery-1.5.min.js'),
                    'extensions' => explode(', ', 'php, js, html'),
                    'whitespace' => false,
                    'comments' => false,
                        );

                //Scan user defined directory
                $folder = new Folder($_GET['dir'], new Option($options));
                $folder->init();

                $lines = $folder->getLines();
                $whitespace = $folder->getWhitespace();
                $comments = $folder->getComments();

                //Prepares the summary
                $result = '<img src="img/bullet_blue.png">Lines: <b>'.$lines.'</b>';
                if(!$options['whitespace'])
                    $result .= '<img src="img/bullet_red.png">Whitespace: <b>'.$whitespace.'</b>';
                if(!$options['comments'])
                    $result .= '<img src="img/bullet_purple.png">Comments: <b>'.$comments.'</b>';
                if(!$options['whitespace'] && !$options['comments']) {
                    @$result .= '<img src="img/bullet_orange.png">Percentage: ' . Html::b(round($lines / ($lines + $whitespace + $comments) * 100)) . '%';
                }
                //Prints the summary
                echo '<hr /><br><div id="result">'.$result.'</div>';
            }
            ?>
        </div>
    </body>
</html>