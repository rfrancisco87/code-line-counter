Code-Line-Counter
=================

How much lines of code contains your project?


History
=========================================================
This project was created by Dalton Tan, here - https://code.google.com/p/php-line-counter/
I just want to modify the style of project and improve some features to the project.


How to use?
=========================================================
Just download it, put it in your localhost project folder and run the index.php.
Indicate the directory of your project and the magic happens (=


Configs
=========================================================
Open index.php and you can define some options about line 53 like:
<pre>
$options = isset($_GET['options']) ? $_GET['options'] : array(
    'ignoreFolders' => explode(', ', '.svn, .git, nbproject'),
    'ignoreFiles' => explode(', ', 'jquery-1.5.js, jquery-1.5.min.js'),
    'extensions' => explode(', ', 'php, js, html'),
    'whitespace' => false,
    'comments' => false,
);
</pre>
