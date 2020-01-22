cd rezalmg6.bget.ru/
ls
cd public_html/
find . -type -f -name '*.php' -exec grep -iH 'exec-callback_calc' --color {} \;
find . -type f -name '*.php' -exec grep -iH 'exec-callback_calc' --color {} \;
find . -type f -name '*.php' -exec grep -iH 'exec-callback_calc' --color {} \;
find . -type f -name '*.php' -exec grep -iH 'mfeedback' --color {} \;
find . -type f -name '*.php' -exec grep -iH 'form_order' --color {} \;
ls
cd rezalmg6.bget.ru/public_html/
find . -type f -name '*.php' -exec grep -iH 'sro-block.php' --color {} \;
ls
cd rezalmg6.bget.ru/
ls
tar -cpzvf rezalmaz.ru_29-06-2018.tar.gz public_html/
mysqldump -hlocalhost -urezalmg6_db -p rezalmg6_db > rezalmaz.ru_29-06-2018.sql
