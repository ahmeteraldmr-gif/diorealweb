<?php
try {
    \ = new PDO('sqlite:c:/Users/ahmet/Desktop/dioreal yedek/database/database.sqlite');
    \->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    \ = \->query('SELECT * FROM journals');
    \ = \->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(\, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch(Exception \) {
    echo 'HATA: ' . \->getMessage();
}
