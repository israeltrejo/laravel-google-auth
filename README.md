# Laravel Google Auth

This project is a template to start using Laravel with the Google Authentication implemented. <br>
The implementation is based on the [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) with some changes to adapt the Google Authentication.

## Google Authentication

We implemented [OpenID Connect](https://developers.google.com/identity/openid-connect/openid-connect) to use Google Authentication in this project. <br>
You only to get the [OAuth 2.0 credentials](https://developers.google.com/identity/openid-connect/openid-connect#getcredentials) and add them to **GOOGLE_CLIENT_ID** and **GOOGLE_CLIENT_SECRET** values in your .env file. <br>
Configuring these values and the corresponding Laravel env values, your application is ready to use all incorporated features.

## Features added

* Refreshed Login and Register pages
* Sign in and registration through Google Authentication
* Sync between both authentication systems for the User creation
* Sync between both authentication systems for the User updates
* Prepared for localization feature
* Section dedicated in the Profile page to show when authentication is enabled
* Mechanism to unlink Google account

## Contributing

Thank you for considering contributing to this Laravel template! Each contribution should be added as a Pull request that it will be checked to analyze the idea to incorporate that.

## Code of Conduct

The Code of Conduct is the same used for the Laravel community, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel or this template, please send an e-mail to Israel Trejo via [israeltrejoj2002@gmail.com](mailto:israeltrejoj2002@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The license of this project is the same as Laravel framework. [MIT license](https://opensource.org/licenses/MIT).
