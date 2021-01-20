<?php

error_reporting(~E_NOTICE);
if (!isset($_GET['f'])) {
	header('HTTP/1.1 401 Bad Request');
	echo 'Missing video parameters.';
	exit;
}

if (isset($_GET['width']))
	$width = min(max(intval($_GET['width']), 1080), 320);
else
	$width = 320;

$file = "/data/hd1/recordings/".basename($_GET['f']);
$newfile = tempnam('/tmp', 'preview_');

if (!file_exists($file)) {
	header('HTTP/1.1 404 Not Found');
	echo "Not found '$chan' '$when'";
	exit;
}

shell_exec("ffmpeg -y -i $file -t 00:01:00 -vf scale=$width:-1 -preset superfast -c:a copy -c:v h264 -f mp4 $newfile");

if (file_exists($newfile)) {
    header('Content-Description: File Transfer');
    header('Content-Type: video/mp4');
    header('Pragma: public');
    header('Content-Length: ' . filesize($newfile));
    ob_clean();
    flush();
    readfile($newfile);
    unlink($newfile);
    exit;
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo 'No output was generate when converting to MP4';
    exit;
}

?>
