Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.

This PHP script is an SVG generator for such labels.  You can specify the following parameters (whose unit size is specified in milimeters) and have the desired sheet generated for printing:

* __paperSize__: The size of the page in ${width}x${height} format.  A4 is the default paper size so the default value is "__210x297__".
* __labelSize__: The size of the label in ${width}x${height} format.
* __labelGapX__: The horizontal gap between adjacent labels.
* __labelGapY__: The vertical gap between adjacent labels.
* __text__: The text to be printed.
* __textSize__: The size of the text.
* __textFont__: The font family of the text.

Example

label-matrix-generator.php?labelSize=20x10&labelGapX=3&text=Label+Matrix+Generator
