<?php
// ====== CORS (สำคัญมาก ไม่งั้น 403) ======
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// รับ preflight request
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

header("Content-Type: text/plain; charset=utf-8");

// ====== API KEY ======
$apiKey = "AIzaSyByB9PTNF9yAc6Q4_3dSoY9SN2m4FJX1FY";

// ====== อนุญาตเฉพาะ POST ======
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

// ====== รับข้อความ ======
$message = $_POST["message"] ?? "";
if (trim($message) === "") {
    exit("กรุณาพิมพ์ข้อความ");
}

// ====== เรียก Gemini API ======
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
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

// ====== ส่งผลลัพธ์กลับ ======
$result = json_decode($response, true);
echo $result["candidates"][0]["content"]["parts"][0]["text"]
     ?? "ขอโทษค่ะ ระบบไม่สามารถตอบได้ตอนนี้ 😅";
