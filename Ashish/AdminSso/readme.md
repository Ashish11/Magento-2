# ASolutions.co.in

Hello Everyone, This is a sample module for Admin SSO. This module has been created in intent of coverng a scenarion when we have requirement of automatic admin login. Whenever you install this module you will find SSO.php file at the root of this module. You need to change the admin username mention in json encode string

```sh
$simple_string = json_encode(array('username' => 'admin'));
```
You need to mention your admin username here.

Next step is to save the same encryption key and encryption IV value in store->configuration 
```sh
$encryption_iv = '1234567891011121';
$encryption_key = "asolutionscoin";
```
you can change these value as per your need and save in store->configuration.

This module is in its early stage and I would love to hear from you how it works. Please feel free to reach out to me on admin@asolutions.co.in or [click here](https://asolutions.co.in/contact/) to share your concerns and suggestions.
