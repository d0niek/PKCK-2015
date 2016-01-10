<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 6:22 PM
 */

namespace Controller;

use Entity\Record\Performer;
use Exception;
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
            $performer = new Performer();
            $performer->setName($_POST['name']);
            $performer->setType($_POST['type']);
            $performer->setMembers($_POST['members']);

            try {
                $this->getCollection()->addPerformer($performer);

                $this->getKernel()->saveCollection();

                $this->redirect($this->getBaseUrl());
            } catch (Exception $e) {
                $_SESSION['validMessage'] = $e->getMessage();
            }
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
        $performer = $this->getCollection()->findPerformerById($id);

        $form = new PerformerForm($this->getCollection());

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $form->valid($_POST)) {
            try {
                $performer->setType($_POST['type']);
                $performer->setMembers($_POST['members']);

                if ($performer->getName() !== $_POST['name'] && !$this->isPerformerNameFree($_POST['name'])) {
                    throw new Exception(
                        'Performer with name ' . $_POST['name'] . ' already is in collection'
                    );
                }

                $performer->setName($_POST['name']);

                $this->getKernel()->saveCollection();

                $this->redirect($this->getBaseUrl());
            } catch (Exception $e) {
                $_SESSION['validMessage'] = $e->getMessage();
            }
        }

        $this->render(
            'edit-performer.php',
            [
                'form' => $form,
                'types' => explode('|', 'metal|rock|rap|hip-hop|drum-and-bass|disco-polo|art-pop|sludge|indie'),
                'performer' => $performer,
            ]
        );
    }

    public function deleteAction($id)
    {
        echo 'Delete performer';
    }

    /**
     * Checks if performer name is free
     *
     * @param string $performerName
     *
     * @return bool
     */
    private function isPerformerNameFree($performerName)
    {
        foreach ($this->getCollection()->getPerformers() as $p) {
            if ($p->getName() === $performerName) {
                return false;
            }
        }

        return true;
    }
}
