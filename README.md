# API TRACKING UNTUK CIAS SYSTEM

### User Guide
### Cara install

Clone repo dari gitlab ```https://gitlab.att.id/mau/api-tracking.git``` 
setelah berhasil cloning project buat file ```.env``` untuk konfigurasi envirotmentnya,
bisa ambil contoh dari file ```.env.example``` untuk standard envirotment laravel
tambahkan beberapa konfigurasi pada file ```.env``` 

- ```KD_GUDANG=MAU1``` kode gudang untuk mekonfigurasi gudang aplikasi bisa MAU1,MAU2,BGD1,....dst
- ```OUTPUT_METHOD=api``` metode output nya, metode output terdapat dua metode ```local``` dan ```api``` 

    ```local``` : metode dari server lokal ke database traking di lokal juga, atau dari database yg ada di cloud dan database tracking nya di cloud juga. metode ini untuk satu flatform aplikasi cias dan traking nya.<br>
    ```api``` : metode dari data di server lokal gudang di push status tracking nya ke cloud endpoint,
- ```END_POINT=http://localhost:8000/api/``` endpoint api, jika metode api digunakan isi dengan ```null``` jika menggunakan metode ```local```
- ``TOKEN_API=d51604b0b68c6da5cd04a5ab0b14f1998795e0baf6ae09a07066bae82c0002fe`` token api jika menggunakan metode api, isi dengan ``null`` jika lokal. Token api untuk memastikan token api di endpoint sama dengan token api di client lokal
- ``NUMBER_OF_CONNECTION=2`` jika menggunakan lebih dari 1 koneksi ini harus di set, jika hanya menggunakan 1 koneksi database set ``null`` . Dalam contoh number_of_connection=2 berarti kita menggunakan 3 database koneksi, berikut contoh koneksi nya:

    ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=api_tracking
        DB_USERNAME=admin
        DB_PASSWORD=password

        DB_CONNECTION_1=rdwarehouse_jkt
        DB_HOST_1=127.0.0.1
        DB_PORT_1=3306
        DB_DATABASE_1=rdwarehouse_jkt
        DB_USERNAME_1=admin
        DB_PASSWORD_1=password

        DB_CONNECTION_2=db_tpsonline
        DB_HOST_2=127.0.0.1
        DB_PORT_2=3306
        DB_DATABASE_2=db_tpsonline
        DB_USERNAME_2=admin
        DB_PASSWORD_2=password
    ```

Setelah membuat file envirotment jalankan perintah pada directory project anda:

``php artisan install``<br>
``php artisan key-generate``<br>
``php artisan migrate``

- Jalanin crontab nya

```* * * * * cd /your-project-path && php artisan schedule:run >> /dev/null 2>&1```

- cek log 
``` http://localhost:8000/log-viewer ```
