<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 6:22 PM
 */

namespace Controller;

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
        echo 'Add performer';
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
