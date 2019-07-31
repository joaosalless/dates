
# dates  
  
[![Software License][ico-license]](LICENSE.md)  
  
Collaborative date library for identification of holidays or commemorative dates (national, state, municipal), automatic calculation of working days and office hours.
  
This library was inspired by the [checkdomain/holiday](https://github.com/checkdomain/Holiday) project, adapting it to support city holidays and completely rewritten to support multiple countries, states and cities without having to write a new class for each. Events are loaded from a CSV that may be updated from an API in the future.  
  
## Install  
  
Via Composer  
  
``` bash  
$ composer require joaosalless/dates  
```  
  
## Usage  
  
### Holidays  
  
``` php  
$dates = new Joaosalless\Dates\Dates('BR');  
  
// Get only national holidays  
$dates->getHolidays(  
    '2019-09-07', // Date  
);  
  
// Check if a given date is holiday only national holidays  
$dates->isHoliday(  
    '2019-09-07', // Date  
);  
  
// Get national and state holidays  
$dates->getHolidays(  
    '2019-09-07', // Date  
    'SP',         // State code  
);  
  
// Check if a given date is holiday in national and state holidays  
$dates->isHoliday(  
    '2019-09-07', // Date  
    'SP',         // State code  
);  
  
// Get national, state and city holidays  
$dates->getHolidays(  
    '2019-09-07', // Date  
    'SP',         // State code  
    '3550308',    // City code  
);  
  
// Check if a given date is holiday in national, state and city holidays  
$dates->isHoliday(  
    '2019-09-07', // Date  
    'SP',         // State code  
    '3550308',    // City code  
);  
```  
  
### Commemorative Dates  
  
``` php  
$dates = new Joaosalless\Dates\Dates('BR');  
  
// Get only national commemorative dates  
$dates->getCommemorativeDates(  
    '2019-09-07', // Date  
);  
  
// Get national and state commemorative dates  
$dates->getCommemorativeDates(  
    '2019-09-07', // Date  
    'SP',         // State code  
);  
  
// Get national, state and city commemorative dates  
$dates->getCommemorativeDates(  
    '2019-09-07', // Date  
    'SP',         // State code  
    '3550308',    // City code  
);  
```  
  
### Business days  
  
Calculates business days from a start date and a specified number of days  
  
``` php  
$dates = new Joaosalless\Dates\Dates('BR');  
  
$dates->calculateBusinessDays(  
    10,           // Number of days  
    '2019-09-07', // Start date  
    'SP',         // Check state holidays  
    '3550308',    // Check city holidays  
);  

$dateTime = new DateTime('2019-07-31 08:23:00');  

// Check if given DateTime instance is a business day  
$dates->isBusinessDay($dateTime); // Returns bool 
  
// Check if given datetime string is a business day  
$dates->isBusinessDay('2019-07-31 08:23:00'); // Returns bool
  
// Returns \DateTime;  
```  
  
### Office hours  
  
Checks if given DateTime instance or datetime string is a office hours  
  
``` php  
$dates = new Joaosalless\Dates\Dates('BR');  
  
$dateTime = new DateTime('2019-07-31 08:23:00');  
  
// Check if given DateTime instance is a office hour  
$dates->isOfficeHour($dateTime); // Returns bool
  
// Check if given string date is office hours  
$dates->isOfficeHour('2019-07-31 08:23:00'); // Returns bool
```  
  
## Change log  
  
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.  
  
## Testing  
  
``` bash  
$ composer test  
```  
  
## Contributing  
  
Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.  
  
## Security  
  
If you discover any security related issues, please email joaosalless@gmail.com instead of using the issue tracker.  
  
## Credits  
  
- [João Sales][link-author]  
- [All Contributors][link-contributors]  
  
## License  
  
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.  
  
[ico-version]: https://img.shields.io/packagist/v/joaosalless/dates.svg?style=flat-square  
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square  
[ico-travis]: https://img.shields.io/travis/joaosalless/dates/master.svg?style=flat-square  
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/joaosalless/dates.svg?style=flat-square  
[ico-code-quality]: https://img.shields.io/scrutinizer/g/joaosalless/dates.svg?style=flat-square  
[ico-downloads]: https://img.shields.io/packagist/dt/joaosalless/dates.svg?style=flat-square  
  
[link-packagist]: https://packagist.org/packages/joaosalless/dates  
[link-travis]: https://travis-ci.org/joaosalless/dates  
[link-scrutinizer]: https://scrutinizer-ci.com/g/joaosalless/dates/code-structure  
[link-code-quality]: https://scrutinizer-ci.com/g/joaosalless/dates  
[link-downloads]: https://packagist.org/packages/joaosalless/dates  
[link-author]: https://github.com/joaosalless  
[link-contributors]: ../../contributors
