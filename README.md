Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.  This PHP script generates such a matrix of labels with pinpoint accuracy ready for printing.

Parameters
----------

You can specify the following parameters for the script.  Unit size is millimetres.

| Param name | Default | Description |
| ----- | ----- | ---- |
| paperSize | 210x297 | The size of the page in "${width}x${height}" format |
| __numberOfColumns__ | - | The number of columns of the label matrix. |
| __numberOfRows__ | - | The number of rows of the label matrix. |
| __labelSize__ | - | The size of the label in "${width}x${height}" format.  A typical value is "48.5x25.4". |
| __labelRadius__ | 0 | The radius of the labels.
| labelGapX | 0 | The horizontal gap between adjacent labels. |
| labelGapY | 0 | The vertical gap between adjacent labels. |
| __text__ | - | The text to be printed. |
| textSize | 3 | The size of the text. |
| textFont | Arial | The font family of the text. |
| correctionX | 0 | Correction value for offsetting the page horizontally.
| correctionX | 0 | Correction value for offsetting the page vertically. |
| __outline__ | false | Draw an outline for labels.  Menat to be used for testing purposes. |

Example
-------

label-matrix-generator.php?labelSize=20x10&labelGapX=3&text=Label+Matrix+Generator
