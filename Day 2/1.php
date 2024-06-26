<!DOCTYPE html>
<html>

<head>
    <title>Day 2</title>
</head>

<body>
    <?php
    $file = "input.txt";
    $content = file_get_contents($file);
    $index_content = 0;
    $cubes = ["red" => 12, "green" => 13, "blue" => 14];
    $color_string = "";
    $game_counter = 0;
    $sum = 0;

    while ($index_content < strlen($content)) {
        // new game
        if ($content[$index_content] == ":") {
            $game_counter++;
            $index_content += 2;
            while ($index_content < strlen($content)) {
                if ($content[$index_content] == "," || $content[$index_content] == ";" || $content[$index_content] == "\n" || $index_content == strlen($content) - 1) {
                    if ($index_content == strlen($content) - 1) {
                        $color_string .= $content[$index_content];
                    }
                    //a color has been announced
                    //get the number
                    $index_color = 0;
                    $numbers = array();
                    while ($color_string[$index_color] != " ") {
                        array_push($numbers, intval($color_string[$index_color]));
                        $index_color++;
                    }
                    $exposant = 10 ** (count($numbers) - 1);
                    $number = 0;
                    for ($i = 0; $i < count($numbers); $i++) {
                        $number += $numbers[$i] * $exposant;
                        $exposant /= 10;
                    }
                    $index_color++;
                    //get the color
                    if (ctype_space($color_string[strlen($color_string) - 1])) {
                        $color = substr($color_string, $index_color, -1);
                    } else {
                        $color = substr($color_string, $index_color);
                    }
                    //verify if the game is possible
                    if ($number > $cubes[$color]) {
                        $color_string = "";
                        break;
                    }
                    $color_string = "";
                    if ($content[$index_content] == "," || $content[$index_content] == ";") {
                        $index_content += 2;
                    } else {
                        $sum += $game_counter;
                        break;
                    }
                }
                $color_string .= $content[$index_content];
                $index_content++;
            }
        }
        $index_content++;
    }
    echo $sum;
    ?>
</body>

</html>