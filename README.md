# Midtrans-PHP

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Coverage Status][badge-coverage]][coverage]

Midtrans-PHP is a wrapper for Midtrans Payment Gateway API for PHP 5.6+. There is an emphasis of readability, simplicity, and flexibility – basically provide the features and flexibility to get the job done and make those features really easy to use.

This project adheres to a [Contributor Code of Conduct][conduct]. By participating in this project and its community, you are expected to uphold this code.


## Sneak Peak

Here's something to whet your appetite. Get a transaction status from an `order_id` or `transaction_id`. Notice that the library automatically interprets the response as JSON and parses it as an array of objects. See the [cookbook on the wiki][wiki-cookbook] for more examples and approaches to specific use-cases.

```php
<?php
require 'vendor/autoload.php';

use Lowsprofile\Midtrans\Method\Midtrans;

Midtrans::$server_key = 'SERVER_KEY_HERE';

$order_id = 'example-1424936368';
$status = Midtrans::status($orderid);

echo json_encode($status);
/*
{
  "status_code" : "200",
  "status_message" : "Success, transaction found",
  "transaction_id" : "249fc620-6017-4540-af7c-5a1c25788f46",
  "masked_card" : "481111-1114",
  "order_id" : "example-1424936368",
  "payment_type" : "credit_card",
  "transaction_time" : "2015-02-26 14:39:33",
  "transaction_status" : "capture",
  "fraud_status" : "accept",
  "approval_code" : "1424936374393",
  "signature_key" : "2802a264cb978fbc59f631c68d120cbda8dc853f5dfdc52301c615cf4f14e7a0b09aa...",
  "bank" : "bni",
  "gross_amount" : "30000.00"
}
*/
```

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

```bash
composer require lowsprofile/midtrans
```


## Documentation

See the [latest documentation on the wiki][wiki-docs].


## Contributing

Contributions are welcome! Please read [CONTRIBUTING][] for details.


## License

[MIT License][license] © 2017-Present [Eries Trisnadi](https://eries.id/). All rights reserved.

[conduct]: https://github.com/lowsprofile/midtrans-php/blob/master/CODE_OF_CONDUCT.md
[packagist]: https://packagist.org/packages/lowsprofile/midtrans-php
[composer]: http://getcomposer.org/
[wiki-docs]: https://github.com/lowsprofile/midtrans-php/wiki/Midtrans-Documentation
[wiki-cookbook]: https://github.com/lowsprofile/midtrans-php/wiki/Midtrans-Cookbook
[contributing]: https://github.com/lowsprofile/midtrans-php/blob/master/CONTRIBUTING.md

[badge-source]: https://img.shields.io/badge/source-lowsprofile/midtrans-php-blue.svg
[badge-release]: https://img.shields.io/packagist/v/lowsprofile/midtrans-php.svg
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[badge-build]: https://img.shields.io/travis/lowsprofile/midtrans-php/master.svg
[badge-coverage]: https://img.shields.io/coveralls/lowsprofile/midtrans-php/master.svg
[badge-downloads]: https://img.shields.io/packagist/dt/lowsprofile/midtrans-php.svg

[source]: https://github.com/lowsprofile/midtrans-php
[release]: https://packagist.org/packages/lowsprofile/midtrans
[license]: https://github.com/lowsprofile/midtrans-php/blob/master/LICENSE
[build]: https://travis-ci.org/lowsprofile/midtrans
[coverage]: https://coveralls.io/r/lowsprofile/midtrans-php?branch=master
[downloads]: https://packagist.org/packages/lowsprofile/midtrans