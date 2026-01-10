<?php
header("Content-Type: text/plain; charset=utf-8");

$apiKey = "AIzaSyByB9PTNF9yAc6Q4_3dSoY9SN2m4FJX1FY";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

$message = $_POST["message"] ?? "";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=$apiKey";

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => $message]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
echo $result["candidates"][0]["content"]["parts"][0]["text"] ?? "ไม่สามารถตอบได้";
