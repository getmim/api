# api

Preset module untuk gate API.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api
```

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