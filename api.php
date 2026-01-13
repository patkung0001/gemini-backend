<?php
header("Content-Type: text/plain; charset=UTF-8");

$apiKey = "AIzaSyByB9PTNF9yAc6Q4_3dSoY9SN2m4FJX1FY";

if (empty($_POST["prompt"])) {
    exit("No prompt");
}

$prompt = $_POST["prompt"];

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=".$apiKey;

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result["candidates"][0]["content"]["parts"][0]["text"])) {
    echo $result["candidates"][0]["content"]["parts"][0]["text"];
} else {
    echo "AI ไม่ตอบ หรือ API KEY ผิด";
}
