Cara Instalasi

1.git clone [link-github]
2.cd [nama folder cloningan]
2.composer install 
3.jalankan "cp .env.example .env", lalu DB_DATABASE= menjadi kasir_laravel.
4.php artisan key:generate
5.php artisan migrate
6.php artisan serve 