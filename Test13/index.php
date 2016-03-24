<?php
/**
 * Super power
 * User: eugene
 * Date: 3/23/16
 * Time: 12:52 PM
 */

$Z=intval(read_stdin());
echo superPower($Z).PHP_EOL;



function superPower($value) {
    // Fail if supplied value is not numeric
    if (!is_numeric($value)) {
        // throw new InvalidArgumentException("Value is not numeric: $value");
        return 0;
    }

    // Normalise numeric input
    $number = abs($value);

    // Fail if supplied number is not an integer
    if (!is_int($number)) {
        // throw new InvalidArgumentException("Number is not an integer: $number");
        return 0;
    }

    // Exit early if possible
    if ($number == 1) {
        // 1 to the power of any positive integer is one
        return 1;
    } elseif ($number < 1) {
        // X to the power of Y is never less then 1, if X & Y are greater then 0
        return 0;
    }

    // Determine the highest logarithm base and work backwards from it
    for ($base = (int) sqrt($number); $base > 1; $base--) {
        $coefficient = log($number)/log($base);

        // Check that the result of division is a whole number
        if (ctype_digit((string) $coefficient)) {
            return 1;
        }
    }

    return 0;
}

/**
 * read STDIN
 * @return string
 */
function read_stdin()
{
    $fr=fopen("php://stdin","r");   // open our file pointer to read from stdin
    $input = fgets($fr,128);        // read a maximum of 128 characters
    $input = rtrim($input);         // trim any trailing spaces.
    fclose ($fr);                   // close the file handle
    return $input;                  // return the text entered
}
