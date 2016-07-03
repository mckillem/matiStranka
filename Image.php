<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 10/06/16
 * Time: 07:28
 */
class Image
{
    const IMAGETYPE_PNG = IMAGETYPE_PNG;
    const IMAGETYPE_GIF = IMAGETYPE_GIF;
    const IMAGETYPE_JPEG = IMAGETYPE_JPEG;

    private $image;
    private $imageType;
    private $width;
    private $height;

    public function getImageType() {
        return $this->imageType;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function __construct($filename)
    {
        $imageSize = getimagesize($filename);
        $this->width = $imageSize[0];
        $this->height = $imageSize[1];
        $this->imageType = $imageSize[2];
        if ($this->imageType == self::IMAGETYPE_JPEG)
            $this->image = imagecreatefromjpeg($filename);
        elseif ($this->imageType == self::IMAGETYPE_GIF)
        {
            // Gify načítáme vždy v true color
            $image = imagecreatefromgif($filename);
            $this->image = $this->createBackground($this->getWidth(), $this->getHeight(), true);
            imagecopy($this->image, $image, 0, 0, 0, 0, $this->getWidth(), $this->getHeight());
        }
        elseif ($this->imageType == self::IMAGETYPE_PNG)
        {
            $this->image = imagecreatefrompng($filename);
            imagealphablending($this->image, true); // Zapnutí alfakanálu
            imagesavealpha($this->image, true); // Ukládání alfakanálu
        }
    }

    private function createBackground($width, $height, $transparent = true)
    {
        $image = imagecreatetruecolor($width, $height);
        if ($transparent)
        {
            imagealphablending($image, true);
            $color = imagecolorallocatealpha($image, 0, 0, 0, 127);
        }
        else
            $color = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $color);
        if ($transparent)
            imagesavealpha($image, true);
        return $image;
    }

    public function save($filename, $imageType = self::IMAGETYPE_JPEG, $compression = 85, $transparent = true, $permissions = null)
    {
        if ($imageType == self::IMAGETYPE_JPEG)
        {
            $output = $this->createBackground($this->getWidth(), $this->getHeight(), false);
            imagecopy($output, $this->image, 0, 0, 0, 0, $this->getWidth(), $this->getHeight());
            imagejpeg($output, $filename, $compression);
        }
        elseif ($imageType == self::IMAGETYPE_GIF)
        {
            $image = $this->createBackground($this->getWidth(), $this->getHeight(), true);
            if ($transparent)
            {
                $color = imagecolorallocatealpha($image, 0, 0, 0, 127);
                imagecolortransparent($image, $color);
            }
            imagecopyresampled($image, $this->image, 0, 0, 0, 0, $this->getWidth(), $this->getHeight(), $this->getWidth(), $this->getHeight());
            imagegif($image, $filename);
        }
        elseif ($imageType == self::IMAGETYPE_PNG)
            imagepng($this->image, $filename);
        if ($permissions != null)
            chmod($filename, $permissions);
    }

    public function output($imageType = self::IMAGETYPE_JPEG, $compression = 85, $transparent = true) {
        $this->save(null, $imageType, $compression, $transparent);
    }

    public function resize($width, $height)
    {
        $image = $this->createBackground($width, $height, true);
        imagecopyresampled($image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $image;
        $this->width = $width;
        $this->height = $height;
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToEdge($edge)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();
        if (($width > $edge) || ($height > $edge))
        {
            if ($width > $height)
                $this->resizeToWidth($edge);
            else
                $this->resizeToHeight($edge);
            return true;
        }
        return false;
    }

    public function resizeToCoverEdge($edge)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();
        if (!($width == $edge && $height >= $edge) || ($height == $edge && $width >= $edge))
        {
            if ($width < $height)
                $this->resizeToWidth($edge);
            else
                $this->resizeToHeight($edge);
            return true;
        }
        return false;
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function crop($width, $height)
    {
        $image = $this->createBackground($width, $height, true);
        imagecopy($image, $this->image, 0, 0, 0, 0, $width, $height);
        $this->image = $image;
        $this->width = $width;
        $this->height = $height;
    }

    public function addWatermark($path, $offset = 8)
    {
        $watermark = imagecreatefrompng($path);
        $width = imagesx($watermark);
        $height = imagesy($watermark);
        imagecopy($this->image, $watermark, $this->getWidth() - $width - $offset, $this->getHeight() - $height - $offset, 0, 0, $width, $height);
    }

    public static function isImage($fileName)
    {
        $type = exif_imagetype($fileName);
        return ($type == self::IMAGETYPE_JPEG || $type == self::IMAGETYPE_GIF || $type == self::IMAGETYPE_PNG);
    }

    public function rotate()
    {
        $image = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        return imagerotate($image, 180, 0);
    }
}