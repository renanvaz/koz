# U test case library

## How to use

```php
    // You need to include the U Lib
    require_once('U.php');

    // Load one or more files with tests
    UCore::load('examples/Core.u.php');

    // Get the report data in JSON format
    echo UCore::getJSON();
```
