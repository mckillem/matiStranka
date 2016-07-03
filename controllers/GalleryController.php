<?php
/**
 * Created by PhpStorm.
 * User: matej
 * Date: 09/06/16
 * Time: 15:19
 */
class GalleryController extends Controller
{
    /**
     * @param $parameters
     */
    public function compile($parameters)
    {
        header("Garie");
        $this->head['title'] = 'Galerie obrázků';
        $this->view = 'gallery';

        
    }
}