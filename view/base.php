<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php foreach ($scripts as $script)
            echo "<script type='text/javascript' src='js/$script.js?'></script>";
          foreach ($styles as $style)
            echo "<link type='text/css' rel='stylesheet' href='css/$style.css?'>";
        ?>
        <title><?php echo $title?></title>
    </head>
    <body>
        <?php foreach ($blocks as $block)
            echo $block;
        ?>
    </body>
</html>
