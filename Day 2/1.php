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
    $games = array();
    $color_string = "";
    $game_counter = 0;
    $changement = 0;

    while ($index_content < strlen($content)) {
        // echo $content[$index_content];
        if ($content[$index_content] == ":") {
            //add a new game to the list
            array_push($games, array(
                "red" => 0,
                "green" => 0,
                "blue" => 0
            ));
            $games[$changement]["id"] = ++$game_counter;
            $index_content += 2;
            while (1) {
                if ($content[$index_content] == "," || $content[$index_content] == ";" || $content[$index_content] == "\n") {
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
                    //add the color to the game's data
                    if (ctype_space($color_string[strlen($color_string) - 1])) {
                        $color = substr($color_string, $index_color, -1);
                    } else {
                        $color = substr($color_string, $index_color);
                    }
                    $games[$changement][$color] += $number;
                    $color_string = "";
                    if ($content[$index_content] == "," || $content[$index_content] == ";") {
                        $index_content += 2;
                    } else {
                        ++$changement;
                        break;
                    }
                    if ($index_content == strlen($content) - 1) {
                        break;
                    }
                }
                // echo $content[$index_content];
                $color_string .= $content[$index_content];
                $index_content++;
            }
        }
        $index_content++;
    }

    for ($i = 0; $i < count($games); $i++) {
        echo "id :";
        echo $games[$i]["id"];
        echo "
        ";
        echo "red :";
        echo $games[$i]["red"];
        echo "
        ";
        echo "blue :";
        echo $games[$i]["blue"];
        echo "
        ";
        echo "green :";
        echo $games[$i]["green"];
        echo "\n";
    }

    $sum = 0;
    for ($i = 0; $i < count($games); $i++) {
        if (!($games[$i]["red"] > 12 || $games[$i]["green"] > 13 || $games[$i]["blue"] > 14)) {
            $sum += $games[$i]["id"];
        }
    }

    echo $sum;
    ?>
</body>

</html>