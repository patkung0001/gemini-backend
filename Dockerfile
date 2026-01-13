htdocs/index.php

<?php
$ch = curl_init("https://example.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
echo $data;

# คัดลอกไฟล์ทั้งหมดเข้า Apache
COPY . /var/www/html/

EXPOSE 80
