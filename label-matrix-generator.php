<?php

// Construct $params from $argv or $_GET.

if (php_sapi_name() == 'cli') {
    $paramElements = array_slice($argv, 1);
    $params = array();
    foreach ($paramElements as $paramElement)
    {
        @list($paramName, $paramValue) = explode('=', $paramElement, 2);
        if (!is_null($paramName) && !is_null($paramValue)) {
            $params[$paramName] = $paramValue;
        }
    }
} else {
    $params = $_GET;
}

// Define the list of available parameters.

$availableParams = array(
    'numberOfColumns' => array('mandatory'=>true,  'type'=>'int'),
    'numberOfRows'    => array('mandatory'=>true,  'type'=>'int'),
    'labelSize'       => array('mandatory'=>true,  'type'=>'widthAndHeightFloat'),
    'text'            => array('mandatory'=>true,  'type'=>'string'),
    'paperSize'       => array('mandatory'=>false, 'type'=>'withAndHeightFloat'),
    'textSize'        => array('mandatory'=>false, 'type'=>'float'),
    'textFont'        => array('mandatory'=>false, 'type'=>'string'),
    'labelGapX'       => array('mandatory'=>false, 'type'=>'float'),
    'labelGapY'       => array('mandatory'=>false, 'type'=>'float'),
    'correctionX'     => array('mandatory'=>false, 'type'=>'float'),
    'correctionY'     => array('mandatory'=>false, 'type'=>'float'),
    'outline'         => array('mandatory'=>false, 'type'=>'bool'),
    'labelRadius'     => array('mandatory'=>false, 'type'=>'float'),
);

// Check the presence of mandatory parameters and the type of every parameter.

foreach ($availableParams as $paramName => $paramAttributes) {
    if (!array_key_exists($paramName, $params)) {
        if ($paramAttributes['mandatory']) {
            exit("Missing mandatory parameter: '$paramName'\n");
        } else {
            continue;
        }
    }

    $paramValue = $params[$paramName];
    switch ($paramAttributes['type']) {
        case 'widthAndHeightFloat':
            @list($width, $height) = explode('x', $paramValue, 2);
            if (!is_numeric($width) || !is_numeric($height)) {
                exit("Parameter '$paramName' has invalid widthXheight value: '$paramValue'\n");
            }
            break;
        case 'int':
            if (preg_match('/^[+-]?[0-9]+$/', $paramValue) !== 1) {
                exit("Parameter '$paramName' has invalid int value: '$paramValue'\n");
            }
            break;
        case 'float':
            if (!is_numeric($paramValue)) {
                exit("Parameter '$paramName' has invalid float value: '$paramValue'\n");
            }
            break;
        case 'bool':
            if (!in_array($paramValue, array('true', 'false'))) {
                exit("Parameter '$paramName' has invalid bool value: '$paramValue'\n");
            }
            break;
        case 'string':
            # No check needed.
            break;
    }
}

// Assign default values to undefined parameters.

function get_param($paramName, $defaultValue)
{
    global $params;
    return array_key_exists($paramName, $params) ? $params[$paramName] : $defaultValue;
}

list($paperSizeX, $paperSizeY) = explode('x', get_param('paperSize', '210x297'));
$numberOfColumns =               $params['numberOfColumns'];
$numberOfRows =                  $params['numberOfRows'];
list($labelSizeX, $labelSizeY) = explode('x', $params['labelSize']);
$labelRadius =                   get_param('labelRadius', 0);
$labelGapX =                     get_param('labelGapX', 0);
$labelGapY =                     get_param('labelGapY', 0);
$text =                          $params['text'];
$textSize =                      get_param('textSize', 3);
$textFont =                      get_param('textFont', 'Arial');
$correctionX =                   get_param('correctionX', 0);
$correctionY =                   get_param('correctionY', 0);
$outline =                       get_param('outline', 'false');

// Print SVG output.

header("Content-type: image/svg+xml");

$matrixOffsetX = ($paperSizeX - $numberOfColumns*$labelSizeX - ($numberOfColumns-1)*$labelGapX) / 2;
$matrixOffsetY = ($paperSizeY - $numberOfRows*$labelSizeY - ($numberOfRows-1)*$labelGapY) / 2;

print "<svg width='{$paperSizeX}mm' height='${paperSizeY}mm' viewBox='0 0 ${paperSizeX} {$paperSizeY}' " .
           "xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink'>\n";
?>

<style>
    .outline {
        fill: none;
        stroke: black;
        stroke-width: 0.1;
    }
</style>

<defs>

<symbol id="label" overflow="visible">
<?php
    if ($outline == 'true') {
        print "    <rect class='outline' width='$labelSizeX' height='$labelSizeY' rx='$labelRadius' />\n";
    }
    printf("    <text text-anchor='middle' font-size='%f' x='%f' y='%f'>$text</text>\n",
           $textSize, $labelSizeX/2, ($labelSizeY+$textSize)/2);
?>
</symbol>

<symbol id="row" overflow="visible">
<?php
    for ($columnNumber=0; $columnNumber<$numberOfColumns; $columnNumber++) {
        printf("    <use xlink:href='#label' x='%f' />\n", $columnNumber*($labelSizeX+$labelGapX));
    }
?>
</symbol>

<symbol id="page" overflow="visible">
<?php
    for ($rowNumber=0; $rowNumber<$numberOfRows; $rowNumber++) {
        printf("    <use xlink:href='#row' y='%f' />\n", $rowNumber*($labelSizeY+$labelGapY));
    }
?>
</symbol>

</defs>

<?php
    if ($outline == 'true') {
        print "<rect class='outline' x='$correctionX' y='$correctionY' width='$paperSizeX' height='$paperSizeY' />\n";
    }
    printf("<use xlink:href='#page' x='%f' y='%f' />\n", $matrixOffsetX+$correctionX, $matrixOffsetY+$correctionY);
?>

</svg>
