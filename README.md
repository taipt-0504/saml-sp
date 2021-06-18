# SAML SP

- This is saml sp for test idp purpose.

# How to use.

- Clone project and install project by *composer install*
- Copy file .env.example to .env
- Change .env DB_CONNECTION to sqlite (we using sqlite for simple test purpose).
- Change .env DB_DATABASE to where you store .sqlite file (for example: /var/www/html/saml-sp/database/saml.sqlite).
- Change .env SAML2_TEST_IDP_HOST to idp saml hanle url.
- Change .env SAML2_TEST_IDP_x509 to idp x509 cert key.
- Run *php artisan key:generate*
- Run *php artisan migrate*
- Config nginx or apache to expose website. (in local we can use *php artisan serve*).

# How to test idp.

- Go to url *(hostname)/*
- Click SAML login
- Check result or error.