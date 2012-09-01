Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.

This PHP script is an SVG generator for such removable labels.  You can specify the following parameters and have the desired sheet generated for printing:

* *unit*: Any SVG unit is valid but typically `mm` and `in` (for inch) is expected to be used.
* pageSize
* labelSize
* labelGapX
* labelGapY
* text
* textSize
* textFont

Example

label-matrix-generator.php?labelSize=20x10&labelGapX=3&text=Label+Matrix+Generator
