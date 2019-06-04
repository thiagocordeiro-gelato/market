## Supermarket Challenge

Supermarket challenge simulates a user scanning products and according to product/offer rules the value may change

### How to run
First of all, it's necessary to install project dependencies

    composer install

Then it can be executed in 2 different ways:

**via console**

    bin/console scan C,D,B,A

**via browser** - *http://localhost:8000?skus=C,D,B,A*

    php -S localhost:8000 -t public/
