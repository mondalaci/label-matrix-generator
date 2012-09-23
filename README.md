Label Matrix Generator
======================

In office stores one can buy removable labels.  Such products are sold as a set of pages featuring a matrix of labels that can be peeled off without leaving any trace of adhesive.  This PHP script generates such a matrix of labels with pinpoint accuracy, ready for printing.

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

Usage
-----

```
http://localhost/your-path/label-matrix-generator.php?numberOfColumns=7&numberOfRows=27&labelSize=25.4x10&labelGapX=2.5&text=I'm+a+label&outline=true&labelRadius=2
```

* __In the command line__ assuming that PHP is installed on `localhost` and `label-matrix-generator.php` resides within the current directory type the following and the output will be saved into `example.svg`.

```bash
php5 ./label-matrix-generator.php numberOfColumns=7 numberOfRows=27 labelSize=25.4x10 labelGapX=2.5 "text=I'm a label" outline=true labelRadius=2 | tee example.svg
```

Here's how the result looks like:

![](/mondalaci/label-matrix-generator/raw/master/example.png)

Testing
-------

Given that peelable label matrix papers are lot more expensive than regular papers it's a very wise practice to test the correctness of the generated graphics on regular papers first.

1. Take some sheets of regular paper whose size matches the label matrix papers.
2. Use `outline=true` and optionally the `labelRadius` parameters for testing.
3. Print on an regular sheet of paper and measure the empty space on all sides of the paper to see whether it matches for the spacing of the label matrix paper.
4. If spacing is off on either side then fine-tune the printer-dependent `correctionX` and `correctionY` values and go back to 3.
5. If you're sure that spacing is all right then set `outline` to `false` and print on the label matrix paper.

* __In the browser__ assuming that PHP is installed on `localhost` and `label-matrix-generator.php` resides within the `your-path` directory under your web root visit the following URL and save the output as [example.svg](/mondalaci/label-matrix-generator/raw/master/example.svg).

Conversion from SVG to PDF
--------------------------

Due to the vast popularity of PDF, SVG to PDF conversion can be handy.

* __On the desktop__ you can use a number of applications to convert SVG to PDF, [Inkscape](http://inkscape.org/) being an excellent Free and cross-platform one.  You simply have to open the File menu, click on the Save As... menu item, select PDF as the output type, type a filename like [example.pdf](/mondalaci/label-matrix-generator/raw/master/example.pdf) and save it.

* __In the command line__ you can also use Inkscape:

```bash
inkscape --without-gui --export-pdf=example.pdf example.svg
```
