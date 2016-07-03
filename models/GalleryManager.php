<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 09/06/16
 * Time: 18:48
 */
class GalleryManager
{
    private $folder;
    private $columns;
    private $files = array();

    public function __construct($folder, $columns)
    {
        $this->folder = $folder;
        $this->columns = $columns;
    }

    public function rename()
    {
        $folder = dir($this->folder);

        while ($item = $folder->read())
        {
            if (is_file($this->folder . '/' . $item) && !strpos($item, '_nahled.') && !strpos($item, 'DS'))
            {
                $newName = mb_strstr($item, '.', true) . '_nahled.JPG';
                
                copy($this->folder . '/' . $item, $this->folder . '/' . $newName);
            }
        }
        $folder->close();
    }

    public function resizePreview()
    {
        $folder = dir($this->folder);

        while ($item = $folder->read())
        {
            if (is_file($this->folder . '/' . $item) && strpos($item, '_nahled.'))
            {
                require_once ('../Image.php');
                $resize = new Image($this->folder . '/' . $item);
                $resize->resizeToWidth(300);
                $resize->save($this->folder . '/' . $item);
            }
        }
        $folder->close();
    }

    public function resizeOriginal()
    {
        $folder = dir($this->folder);

        while ($item = $folder->read())
        {
            if (is_file($this->folder . '/' . $item) && strpos($item, '_nahled.') === false)
            {
                require_once ('../Image.php');
                $resize = new Image($this->folder . '/' . $item);
                $resize->resizeToWidth(1024);
                $resize->save($this->folder . '/' . $item);
            }
        }
        $folder->close();
    }

    public function rotate()
    {
        $folder = dir($this->folder);

        while ($item = $folder->read())
        {
            if (is_file($this->folder . '/' . $item))
            {
                require_once ('../Image.php');
                $rotate = new Image($this->folder . '/' . $item);
                $rotate->rotate();
            }
        }
        $folder->close();
    }

    public function resize()
    {
        $this->resizePreview();
        $this->resizeOriginal();
    }

    public function load()
    {
        $folder = dir($this->folder);

        while ($item = $folder->read())
        {
            if (is_file($this->folder . '/' . $item) && strpos($item, '_nahled.'))
            {
                $this->files[] = $item;
            }
        }
        $folder->close();
    }


    public function publish()
    {
        echo('<table id="gallery"><tr>');
        $column = 0;
        foreach ($this->files as $file)
        {
            $preview = $this->folder . '/' . $file;
            $picture = $this->folder . '/' . str_replace('_nahled.', '.', $file) ;
            echo('<td><a href="' . htmlspecialchars($picture) . '" rel="lightbox[gallery]"><img src="' . htmlspecialchars($preview) . '" alt=""></a></td>');
            $column++;
            if ($column >= $this->columns)
            {
                echo('</tr><tr>');
                $column = 0;
            }
        }
        echo('</tr></table>');
    }


}