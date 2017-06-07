<?php

namespace shop\entities\behaviors;

use League\Flysystem\Filesystem;
use PHPThumb\GD;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class FlySystemImageUploadBehavior extends ImageUploadBehavior
{
    private $filesystem;

    public function __construct(Filesystem $filesystem, $config = [])
    {
        parent::__construct($config);
        $this->filesystem = $filesystem;
    }

    public function cleanFiles(): void
    {
        $this->filesystem->delete($this->resolvePath($this->filePath));
        foreach (array_keys($this->thumbs) as $profile) {
            $this->filesystem->delete($this->getThumbFilePath($this->attribute, $profile));
        }
    }

    public function afterSave(): void
    {
        if ($this->file instanceof UploadedFile) {
            $path = $this->getUploadedFilePath($this->attribute);
            $this->filesystem->createDir(pathinfo($path, PATHINFO_DIRNAME));
            $this->filesystem->put($path, file_get_contents($this->file->tempName));
            $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
        }
    }

    public function createThumbs(): void
    {
        $path = $this->getUploadedFilePath($this->attribute);
        foreach ($this->thumbs as $profile => $config) {
            $thumbPath = static::getThumbFilePath($this->attribute, $profile);
            if ($this->filesystem->has($path) && !$this->filesystem->has($thumbPath)) {

                // setup image processor function
                if (isset($config['processor']) && is_callable($config['processor'])) {
                    $processor = $config['processor'];
                    unset($config['processor']);
                } else {
                    $processor = function (GD $thumb) use ($config) {
                        $thumb->adaptiveResize($config['width'], $config['height']);
                    };
                }

                $tmpPath = $this->getTempPath($thumbPath);
                FileHelper::createDirectory(pathinfo($tmpPath, PATHINFO_DIRNAME), 0775, true);
                file_put_contents($tmpPath, $this->filesystem->get($path));
                $thumb = new GD($tmpPath, $config);
                call_user_func($processor, $thumb, $this->attribute);
                FileHelper::createDirectory(pathinfo($thumbPath, PATHINFO_DIRNAME), 0775, true);
                $thumb->save($tmpPath);
                $this->filesystem->createDir(pathinfo($thumbPath, PATHINFO_DIRNAME));
                $this->filesystem->put($thumbPath, file_get_contents($tmpPath));
            }
        }
    }

    /**
     * @param $path
     * @return string
     */
    private function getTempPath($path): string
    {
        return sys_get_temp_dir() . $path;
    }
}