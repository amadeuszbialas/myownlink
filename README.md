myownlink created with Symfony 3
====
Installation:

    1. Composer install
    2. DB requirements: 
                        database: 'myownlink'
                        table:    'links'
                        columns:  'old(text), new(text), createDate(date)'
    3. You have to change site key and secret key for reCAPTCHA
        site key -> app/Resources/views/main.html.twig
        secret key -> src/AppBundle/Captcha/Captcha.php
    4. Delete twig cache folder.
