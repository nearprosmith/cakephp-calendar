# Calendar plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require nearprosmith/cakephp-calendar
```

## Usage


1. Load helper in Controller.
     ```php
    class PagesController extends AppController {
      public $helpers =['Calendar.Calendar'];
    ...
   }
    ```
2. Call `table` method in your viewfile.
    ```php
   <?php
   echo $this->Calendar->table($options);
   ?>
   ```
