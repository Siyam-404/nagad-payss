<?php
header('Content-Type: image/png');

$number = isset($_GET['number']) ? htmlspecialchars($_GET['number']) : '01986-343907';
$transactionId = isset($_GET['transaction']) ? htmlspecialchars($_GET['transaction']) : '730MGQGC';
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : '9999';
$charge = isset($_GET['charge']) ? htmlspecialchars($_GET['charge']) : '5';
$total = isset($_GET['total']) ? htmlspecialchars($_GET['total']) : '9999';

date_default_timezone_set('Asia/Dhaka');

$time = date('d F Y, h:i A');
$time = date('h:i A');
$background = imagecreatefromjpeg('ss.jpg');
$grey = imagecolorallocate($background, 128, 128, 128);
$white = imagecolorallocate($background, 255, 255, 255);  
$Sujon = __DIR__ . '/roboto.ttf';
$fontSize = 50;
$fontSizeBold = 55;
$trim = 47;
$textStyles = [
    'number' => ['x' => 1199, 'y' => 1090, 'size' => $fontSizeBold, 'font' => $Sujon, 'color' => $grey],
    'transactionId' => ['x' => 1790, 'y' => 1280, 'size' => $fontSize, 'font' => $Sujon, 'color' => $grey],
    'amount' => ['x' => 1630, 'y' => 1385, 'size' => $fontSize, 'font' => $Sujon, 'color' => $grey],
    'charge' => ['x' => 1630, 'y' => 1505, 'size' => $fontSize, 'font' => $Sujon, 'color' => $grey],
    'total' => ['x' => 1630, 'y' => 1620, 'size' => $fontSize, 'font' => $Sujon, 'color' => $grey],
    'time' => ['x' => 1790, 'y' => 1740, 'size' => $fontSize, 'font' => $Sujon, 'color' => $grey],
    'time' => ['x' => 370, 'y' => 105, 'size' => $trim, 'font' => $Sujon, 'color' => $white],  
];

function getRightAlignedX($text, $size, $font, $rightX) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $textWidth = $bbox[2] - $bbox[0];
    return $rightX - $textWidth;
}

foreach ($textStyles as $key => $style) {
    $text = $$key;
    $x = getRightAlignedX($text, $style['size'], $style['font'], $style['x']);
    imagettftext($background, $style['size'], 0, $x, $style['y'], $style['color'], $style['font'], $text);
}

imagepng($background);
imagedestroy($background);
?>
