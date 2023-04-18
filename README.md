Azioni preliminari prima di avviare il sito:

1. Assicurarsi di avere una piattaforma software (XAMPP) necessaria per utilizzare i linguaggi di programmazione PHP e Perl.
2. Tramite console (cmd) scrivere i seguenti comandi:
    - composer i
    - npm i
3. Importare le tabelle presenti nella cartella "sql_tables" all'interno di mySql. Il database utilizzato è denominato window_db.
4. All'interno del vostro file .env inserire le seguenti istruzioni per far si che la chat possa funzionare in tempo reale:
    (da linea 46 a linea 52)

    PUSHER_APP_ID=1585787
    PUSHER_APP_KEY=ad7a2f78b1b8b3ce340c
    PUSHER_APP_SECRET=d7402f033d18c9bcb7ac
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=eu

    (linea 18)

    BROADCAST_DRIVER=pusher

Ulteriori informazioni per un esperienza migliore:

1. Utilizzo delle funzionalità admin:
    - email: admin@gmail.com
    - password: asdasdasd
    - accedere alla rotta /admin per poter usufruire delle sue funzionalità oppure: impostazioni -> area riservata

2. Prova la funzionalità " double click " per poter mettere il like senza dover premere direttamente sul pulsante.
Ti basterà cliccare due volte sulla foto del post.

Wichat, la piattaforma di messaggistica real time:
    - accedere con un utente (es. admin) all'interno del sito
    - aprire un altra finestra di navigazione in incognito ed accedere con un altro utente (email: perry@gmail.com password: asdasdasd)

Se dovessero risultare degli errori inserire i seguenti comandi:
    - composer require pusher/pusher-php-server
    - npm install --save-dev laravel-echo pusher-js
    - php artisan serve
    - npm run dev