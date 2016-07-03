<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 09/06/16
 * Time: 16:53
 */
class UploadController extends Controller
{
    public function compile($parameters)
    {
        header("Upload");
        $this->head['title'] = 'Nahrát';

        if ($_FILES)
        {
            try
            {
                $this->verifyUser();
                $uploadManager = new UploadManager();
                $uploadManager->upload();
                $this->addMessage('Obrázek byl úspěšně nahrán.');
                $this->redirect('upload');
            }
            catch (UserError $error)
            {
                $this->addMessage($error->getMessage());
            }
        }
        $this->view = 'upload';
    }
}