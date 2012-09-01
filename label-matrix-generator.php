<?php
header("Content-type: image/svg+xml");

$paperSizeX = 210;
$paperSizeY = 297;
$numberOfColumns = 7;
$numberOfRows = 27;
$labelSizeX = 25.4;
$labelSizeY = 10;
$labelRadius = 2;
$labelGapX = 2.5;
$labelGapY = 0;
$text = 'test';
$textSize = 3;
$textFont = 'Arial';
$correctionX = 0.25;
$correctionY = -0.6;
$outlineEnabled = false;

$matrixOffsetX = ($paperSizeX - $numberOfColumns*$labelSizeX - ($numberOfColumns-1)*$labelGapX) / 2;
$matrixOffsetY = ($paperSizeY - $numberOfRows*$labelSizeY - ($numberOfRows-1)*$labelGapY) / 2;

print "<svg width='{$paperSizeX}mm' height='${paperSizeY}mm' viewBox='0 0 ${paperSizeX} {$paperSizeY}' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink'>";
?>
<defs>

<symbol id="label" overflow="visible">
<?php
    if ($outlineEnabled) {
        print "<rect fill='none' stroke='black' stroke-width='0.1' width='$labelSizeX' height='$labelSizeY' rx='$labelRadius' />";
    }
    printf("<text text-anchor='middle' font-size='%f' x='%f' y='%f'>$text</text>", $textSize, $labelSizeX/2, ($labelSizeY+$textSize)/2);
?>
</symbol>

<symbol id="row" overflow="visible">
<?php
    for ($columnNumber=0; $columnNumber<$numberOfColumns; $columnNumber++) {
        printf("<use xlink:href='#label' x='%f' />\n", $columnNumber*($labelSizeX+$labelGapX));
    }
?>
</symbol>

<symbol id="page" overflow="visible">
<?php
    for ($rowNumber=0; $rowNumber<$numberOfRows; $rowNumber++) {
        printf("<use xlink:href='#row' y='%f' />\n", $rowNumber*($labelSizeY+$labelGapY));
    }
?>
</symbol>

</defs>

<use xlink:href="#page" <?php printf("x='%f' y='%f'", $matrixOffsetX+$correctionX, $matrixOffsetY+$correctionY) ?> />

</svg>
