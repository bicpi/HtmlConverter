# bicpi's HtmlConverter library

HtmlConverter is a PHP5 library that provides easy HTML-to-Text conversion. This is useful, for example, for
automatically creating plain text parts of HTML emails.

[![Build Status](https://secure.travis-ci.org/bicpi/HtmlConverter.png)](http://travis-ci.org/bicpi/HtmlConverter)

## Usage

1. Create converter
2. Call `->convert($html)` method
3. Enjoy returned plain text

### SimpleConverter

The `SimpleConverter` works on every PHP enabled system by using PHP's `strip_tags()` function and putting some HTML
entity decoding on top.

```php
<?php

use bicpi\HtmlConverter\Converter\SimpleConverter;

$html = '... <h1>... you HTML content ...</h1> ...';
$converter = new SimpleConverter();
$plain = $converter->convert($html);
```

### LynxConverter

The `LynxConverter` works on every system with the `lynx` text browser package installed. The converted plain text
is equivalent to what you would see when opening the HTML in `lynx`. This is currently the most useful converter as
it provides the best results and includes all links as references.

```php
<?php

use bicpi\HtmlConverter\Converter\LynxConverter;

$html = '... <h1>... you HTML content ...</h1> ...';
$converter = new LynxConverter();
$plain = $converter->convert($html);
```

### Html2TextConverter

The `Html2TextConverter` works on every system with the `html2text` package installed. The converted plain text
is equivalent to what you would see when passing the HTML on the command line to the `html2text` command. The result
is quite nice but be aware that links will be removed. Hence, this should not be used for converting a whole web page
or marketing email. May be useful for small chunks of HTML code.

```php
<?php

use bicpi\HtmlConverter\Converter\Html2TextConverter;

$html = '... <h1>... you HTML content ...</h1> ...';
$converter = new Html2TextConverter();
$plain = $converter->convert($html);
```

## Running unit tests

PHPUnit 3.5 or newer is required. To setup and run tests follow these steps:

1. Go to the root directory of this library
2. Run: `composer install`
3. Run: `phpunit`
