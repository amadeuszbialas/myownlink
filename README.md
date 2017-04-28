myownlink created with Symfony 3
====
Link to working site:
www.myownlink.eu

Installation:

    1. Composer install(set your user, pass and name for DB)
    2. DB requirements: 
                        database: 'myownlink'
                        table:    'links'
                        columns:  'old(text), new(text), createDate(date)'
    3. You have to change site key and secret key for your own reCAPTCHA (keys in this repo are not working:p)
        site key -> app/Resources/views/main.html.twig
        secret key -> src/AppBundle/Captcha/Captcha.php
    4. Delete twig cache folder.
    
   
