<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 6:22 PM
 */

namespace Controller;

class RecordController extends Controller
{
    public function addAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $this->validForm($_POST)) {
            $this->redirect($this->getBaseUrl());
        }

        $this->render(
            'add-record.php',
            [
                'performers' => $this->getCollection()->getPerformers(),
            ]
        );
    }

    public function editAction($id)
    {
        echo 'Edit record ' . $id;
    }

    public function deleteAction()
    {
        echo 'Delete record';
    }
}
