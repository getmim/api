# api

Preset module untuk gate API.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api
```

## Konfigurasi

Module ini memiliki struktur response sendiri dengan bentuk seperti di bawah:

```json
{
    "error": "int",
    "message": "string",
    "data": "mixed"
}
```

Jika struktur tersebut tidak sesuai dengan kebutuhan, maka tambahkan konfigurasi
di bawah pada module/aplikasi dan buatkan class yang mengimplementasikan interface
`Api\Iface\Response` untuk membentuk struktur response.

```php
return [
    'api' => [
        'resFormat' => 'Class'
    ]
];
```

Class tersebut harus memiliki method sebagai berikut:

### static function resp($self, int $error=0, $data=null, string $message=null, array $meta=null): array

Fungsi yang akan dipanggil untuk memformat data. Fungsi ini diharapkan mengembalikan nilai array dengan
bentuk `[content::String, mime::String]`.

## Penggunaan

Module ini mendaftarkan satu gate dengan nama `api` seperti di bawah:

```php
return [
    'gates' => [
        'api' => [
            'priority' => 10000,
            'host' => [
                'value' => 'HOST'
            ],
            'path' => [
                'value' => '/api'
            ]
        ]
    ],
];
```

Semua route handler harus meng-*extends* dari `Api\Controller`.

Kontroler `Api\Controller` menambah satu method dengan nama:

### resp(int $error=0, $data=null, string $message=null, array $meta=null): void

Fungsi untuk menggenerasi response dan mengirimkan data ke user dalam bentuk
json. Nilai `200` pada parameter `$error` akan diubah menjadi `0`.

Nilai array `$meta` disejajarkan dengan response body.