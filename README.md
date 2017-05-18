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
    3. Change, site and secret keys for your own reCAPTCHA in parameters.yml
    4. Change domain for your own (eg localhost) in /app/Resources/views/final line 14
    
   
