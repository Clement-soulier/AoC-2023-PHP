<!DOCTYPE html>
<html>

<head>
    <title>Day 1</title>
</head>

<body>
    <?php

    $letter_to_number = array(
        "one" => 1,
        "two" => 2,
        "three" => 3,
        "four" => 4,
        "five" => 5,
        "six" => 6,
        "seven" => 7,
        "eight" => 8,
        "nine" => 9
    );

    $sum = 0;
    $number_on_current_line = array();
    $file = "input.txt";
    $content = file_get_contents($file);
    $index = 0;
    $index_for_letter_numbers = 0;

    function is_number($current_index)
    {
        global $letter_to_number;
        global $content;
        $keys = array_keys($letter_to_number);
        for ($i = 0; $i < count($keys); $i++) {
            $offset = 0;
            while ($content[$current_index + $offset] != "\n") {
                if ($offset == strlen($keys[$i])) {
                    return $letter_to_number[$keys[$i]];
                }
                if ($content[$current_index + $offset] != $keys[$i][$offset]) {
                    break;
                }
                $offset++;
            }
        }
        return -1;
    }

    while ($index < strlen($content)) {
        if (ctype_digit($content[$index])) {
            array_push($number_on_current_line, intval($content[$index]));
        } else {
            $result = is_number($index);
            if ($result != -1) {
                array_push($number_on_current_line, $result);
            }
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