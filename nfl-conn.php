<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://tank01-nfl-live-in-game-real-time-statistics-nfl.p.rapidapi.com/getNFLTeamRoster?teamID=6&teamAbv=PHI&getStats=true&fantasyPoints=true",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: tank01-nfl-live-in-game-real-time-statistics-nfl.p.rapidapi.com",
		"x-rapidapi-key: 7cf2f28f6bmshfe62be90baf349dp1ff22ejsn9c417698c539"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

?>
