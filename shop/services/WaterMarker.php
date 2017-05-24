<?php

namespace shop\services;

use PHPThumb\GD;
use Yii;

class WaterMarker
{
    private $width;
    private $height;
    private $watermark;

    public function __construct($width, $height, $watermark)
    {
        $this->width = $width;
        $this->height = $height;
        $this->watermark = $watermark;
    }

    public function process(GD $thumb): void
    {
        $watermark = new GD(Yii::getAlias($this->watermark));
        $source = $watermark->getOldImage();

        if (!empty($this->width) || !empty($this->height)) {
            $thumb->adaptiveResize($this->width, $this->height);
        }

        $originalSize = $thumb->getCurrentDimensions();
        $watermarkSize = $watermark->getCurrentDimensions();

        $destinationX = $originalSize['width'] - $watermarkSize['width'] - 10;
        $destinationY = $originalSize['height'] - $watermarkSize['height'] - 10;

        $destination = $thumb->getOldImage();

        imagealphablending($source, true);
        imagealphablending($destination, true);

        imagecopy(
            $destination,
            $source,
            $destinationX, $destinationY,
            0, 0,
            $watermarkSize['width'], $watermarkSize['height']
        );

        $thumb->setOldImage($destination);
        $thumb->setWorkingImage($destination);
    }
} 