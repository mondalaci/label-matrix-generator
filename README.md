Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.  This PHP script generates such a matrix of labels with pinpoint accuracy ready for printing.

Parameters
----------

You can specify the following parameters for the script.
* Parameters without default values are mandatory to be specified.
* Unit size must be specified is millimetres.
* Parameters can be specified in the browser or in the command line (see examples below).

| Parameter name | Default | Description |
| ---------- | ------- | ----------- |
| numberOfColumns | - | The number of columns of the label matrix. |
| numberOfRows | - | The number of rows of the label matrix. |
| labelSize | - | The size of the label in "{width}x{height}" format. |
| text | - | The text to be printed per label. |
| paperSize | 210x297 | The size of the page in "{width}x{height}" format |
| textSize | 3 | The size of the text. |
| textFont | Arial | The font family of the text. |
| labelGapX | 0 | The horizontal gap between adjacent labels. |
| labelGapY | 0 | The vertical gap between adjacent labels. |
| correctionX | 0 | Correction value for offsetting the page horizontally. |
| correctionY | 0 | Correction value for offsetting the page vertically. |
| outline | false | If true then draw an outline for labels.  Meant to be used for testing purposes. |
| labelRadius | 0 | The radius of the corners of the labels.  Only displayed when _outline_ is _true_. |

Example
-------

Assuming that PHP is installed on localhost and label-matrix-generator.php resides within the your-path directory under your web root visit the following URL and save the result as label-matrix.svg for example.

```
http://localhost/your-path/label-matrix-generator.php?numberOfColumns=7&numberOfRows=27&labelSize=25.4x10&labelGapX=2.5&text=I'm+a+label&outline=true&labelRadius=2
```

Assuming that PHP is installed on localhost and label-matrix-generator.php resides in the current directory type the following and the output will be saved into label-matrix.svg.

```bash
php5 ./label-matrix-generator.php numberOfColumns=7 numberOfRows=27 labelSize=25.4x10 labelGapX=2.5 "text=I'm a label" outline=true labelRadius=2 | tee label-matrix.svg
```
