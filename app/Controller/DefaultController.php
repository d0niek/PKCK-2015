<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 4:45 PM
 */

namespace Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->render(
            'index.php',
            [
                'records' => $this->getCollection()->getRecords(),
            ]
        );
    }
}
