<?php
/**
 * Created by PhpStorm.
 * User: matej
 * Date: 10/06/16
 * Time: 07:58
 */
require_once ('Image.php');
// save
$elephantPng = new Image('images/elephant.png');
$elephantPng->resizeToHeight(128);
$elephantPng->save('images/el2.jpg');
$elephantPng->save('images/el3.gif', Image::IMAGETYPE_GIF);
$elephantJpeg = new Image('images/elephant.jpg');
$elephantJpeg->resizeToHeight(128);
$elephantJpeg->save('images/el4.png', Image::IMAGETYPE_PNG);
$elephantJpeg->save('images/el5.gif', Image::IMAGETYPE_GIF);
$elephantGif = new Image('images/elephant.gif');
$elephantGif->resizeToHeight(128);
$elephantGif->save('images/el6.jpg');
$elephantGif->save('images/el7.png', Image::IMAGETYPE_PNG);

// resizeToEdge
$elephantPngThumbnail = new Image('images/elephant.png');
$elephantPngThumbnail->resizeToEdge(256);
$elephantPngThumbnail->save('images/el8.png', Image::IMAGETYPE_PNG);
$elephantJpegThumbnail = new Image('images/elephant.jpg');
$elephantJpegThumbnail->resizeToEdge(256);
$elephantJpegThumbnail->save('images/el9.jpg', Image::IMAGETYPE_JPEG);
$elephantGifThumbnail = new Image('images/elephant.gif');
$elephantGifThumbnail->resizeToEdge(256);
$elephantGifThumbnail->save('images/el10.gif', Image::IMAGETYPE_GIF);

// scale
$elephantPngThumbnail = new Image('images/elephant.png');
$elephantPngThumbnail->scale(50);
$elephantPngThumbnail->save('images/el11.jpg');
?>

<!DOCTYPE html>
<html lang="cs-cz">

<head>
    <meta charset="UTF-8">
    <title>Test knihovny Image</title>
</head>

<body style="background: #c0c0c0; text-align: center;">
<h3>Přeuložení na jiný typ</h3>
<img src="images/el2.jpg" alt="Přeuložení na jiný typ" />
<img src="images/el3.gif" alt="Přeuložení na jiný typ" />
<img src="images/el4.png" alt="Přeuložení na jiný typ" />
<img src="images/el5.gif" alt="Přeuložení na jiný typ" />
<img src="images/el6.jpg" alt="Přeuložení na jiný typ" />
<img src="images/el7.png" alt="Přeuložení na jiný typ" />

<h3>Změna velikosti na hranu</h3>
<img src="images/el8.png" alt="Změna velikosti na hranu" />
<img src="images/el9.jpg" alt="Změna velikosti na hranu" />
<img src="images/el10.gif" alt="Změna velikosti na hranu" />

<h3>Škálování</h3>
<img src="images/el11.jpg" alt="Škálování" />
</body>

</html>