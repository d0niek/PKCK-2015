<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 6:22 PM
 */

namespace Controller;

use Form\PerformerForm;

class PerformerController extends Controller
{
    public function indexAction()
    {
        $this->render(
            'performers.php',
            [
                'performers' => $this->getCollection()->getPerformers(),
            ]
        );
    }

    public function addAction()
    {
        $form = new PerformerForm($this->getCollection());

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $form->valid($_POST)) {
            $this->redirect($this->getBaseUrl());
        }

        $this->render(
            'add-performer.php',
            [
                'form' => $form,
                'types' => explode('|', 'metal|rock|rap|hip-hop|drum-and-bass|disco-polo|art-pop|sludge|indie'),
            ]
        );
    }

    public function editAction($id)
    {
        echo 'Edit performer';
    }

    public function deleteAction($id)
    {
        echo 'Delete performer';
    }
}
