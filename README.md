myownlink created with Symfony 3
====
Link to working site:
www.myownlink.eu

Installation:

    1. Composer install
    2. DB config in parameters.yml user, password, db name
    3. DB requirements: 
                        database: 'myownlink'
                        table:    'links'
                        columns:  'old(text), new(text), createDate(date)'
    4. You have to change site key and secret key for your own reCAPTCHA
        site key -> app/Resources/views/main.html.twig
        secret key -> src/AppBundle/Captcha/Captcha.php
    5. Delete twig cache folder.
    
   
