# Plivo notifications channel for Laravel 5.3

This package makes it easy to send SMS notifications using [Plivo][https://plivo.com] with Laravel 5.3.

## Update  

This package is now part of Laravel Notification Channels - https://github.com/laravel-notification-channels/plivo.

## Contents

- [Installation](#installation)
	- [Setting up the Plivo service](#setting-up-the-Plivo-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install this package via composer:
`composer require laravel-notification-channels/plivo`

Add the service provider to `config/app.php`:
```
// config/app.php
'providers' => [
    ...
    NotificationChannels\Plivo\PlivoServiceProvider::class,
],
```

### Setting up your Plivo service
Log in to your [Plivo dashboard](https://manage.plivo.com/dashboard/) and grab your Auth Id, Auth Token and the phone number you're sending from. Add them to `config/services.php`.  
```
// config/services.php
...
'plivo' => [
    'auth_id' => env('PLIVO_AUTH_ID'),
    'auth_token' => env('PLIVO_AUTH_TOKEN'),
    // Country code, area code and number without symbols or spaces
    'from_number' => env('PLIVO_FROM_NUMBER'),
],
```

## Usage

Follow Laravel's documentation to add the channel your Notification class:
```
use Illuminate\Notifications\Notification;
use NotificationChannels\Plivo\PlivoChannel;
use NotificationChannels\Plivo\PlivoMessage;

public function via($notifiable)
{
    return [Plivo::class];
}

public function toPlivo($notifiable)
{
    return (new PlivoMessage)
                    ->content('This is a test SMS via Plivo using Laravel Notifications!');
}
```  

Add a `routeNotificationForPlivo` method to your Notifiable model to return the phone number:  

```
public function routeNotificationForPlivo()
{
    // Country code, area code and number without symbols or spaces
    return preg_replace('/\D+/', '', $this->phone_number);
}
```    

### Available methods

* `content()` - (string), SMS notification body
* `from()` - (integer) Override default from number

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email sid@koomai.net instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Sid K](https://github.com/koomai)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
