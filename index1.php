htdocs/index.php

<?php
$ch = curl_init("https://example.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
