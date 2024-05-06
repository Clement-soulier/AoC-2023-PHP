<!DOCTYPE html>
<html>

<head>
    <title>Day 1</title>
</head>

<body>
    <?php
    $sum = 0;
    $number_on_current_line = array();
    $file = "input.txt";
    $content = file_get_contents($file);
    $index = 0;

    while ($index < strlen($content)) {
        if (ctype_digit($content[$index])) {
            array_push($number_on_current_line, intval($content[$index]));
        }
        if ($content[$index] == "\n") {
            $sum += ($number_on_current_line[0] * 10) + end($number_on_current_line);
            $number_on_current_line = array();
        }
        $index++;
    }

    $sum += ($number_on_current_line[0] * 10) + end($number_on_current_line);

    echo $sum;

    ?>
</body>

</html>