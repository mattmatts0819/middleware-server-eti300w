<?php
// index.php (or your middleware script)

// 1) Grab the team abbreviation from the query string
$teamAbv = isset($_GET['team']) && trim($_GET['team']) !== ''
    ? strtoupper(trim($_GET['team']))
    : 'CHI'; // default to CHI

// 2) Build the RapidAPI URL dynamically
$rapidApiUrl = sprintf(
    'https://tank01-nfl-live-in-game-real-time-statistics-nfl.p.rapidapi.com/getNFLTeamRoster?teamAbv=%s&getStats=true&fantasyPoints=true',
    urlencode($teamAbv)
);

// 3) Initialize cURL
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL            => $rapidApiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => "",
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => "GET",
    CURLOPT_HTTPHEADER     => [
        "x-rapidapi-host: tank01-nfl-live-in-game-real-time-statistics-nfl.p.rapidapi.com",
        "x-rapidapi-key: 7cf2f28f6bmshfe62be90baf349dp1ff22ejsn9c417698c539"
    ],
]);

// 4) Execute & handle errors
$response = curl_exec($curl);
$err      = curl_error($curl);
curl_close($curl);

if ($err) {
    http_response_code(500);
    echo json_encode([
        'error'   => 'cURL Error',
        'message' => $err
    ]);
    exit;
}

// 5) Return the JSON payload directly
header('Content-Type: application/json');
echo $response;
?>
