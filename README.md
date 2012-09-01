Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.  This PHP script generates a such a matrix of labels with pinpoint accuracy ready for printing.

Parameters
----------

You can specify the following GET parameters for the script.  Unit size is millimetres.

* __paperSize__: The size of the page in "${width}x${height}" format.  A4 is the default paper size so the default value is "__210x297__".
* __labelSize__: The size of the label in "${width}x${height}" format.  A typical value is "48.5x25.4".  This parameter is __mandatory__.
* __labelGapX__: The horizontal gap between adjacent labels.  Default value is __0__.
* __labelGapY__: The vertical gap between adjacent labels.  Default value is __0__.
* __text__: The text to be printed.  This value is __mandatory__.
* __textSize__: The size of the text.  Default value is __X__.
* __textFont__: The font family of the text.  Default value is __X__.

Example
-------

label-matrix-generator.php?labelSize=20x10&labelGapX=3&text=Label+Matrix+Generator
