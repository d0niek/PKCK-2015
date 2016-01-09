<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 6:22 PM
 */

namespace Controller;

use DateTime;
use Entity\Record\Record;
use Entity\Record\Track;
use Form\DeleteRecordForm;
use Form\RecordForm;

class RecordController extends Controller
{
    public function addAction()
    {
        $form = new RecordForm($this->getCollection());

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $form->valid($_POST)) {
            $performer = $this->getCollection()->findPerformerById($_POST['performers']);

            $record = new Record();
            $record->setTitle($_POST['title']);
            $record->setPerformer($performer);
            $record->setRelease(new DateTime($_POST['release']));
            $record->setRanking($_POST['ranking']);
            $record->setPrice($_POST['price'] . 'zł');
            $record->setTime(new DateTime('00:00:00'));

            $this->addTrack($record, $_POST);

            $this->getCollection()->addRecord($record);

            $performer->addRecord($record);

            $this->getKernel()->saveCollection();

            $this->redirect($this->getBaseUrl());
        }

        $this->render(
            'add-record.php',
            [
                'performers' => $this->getCollection()->getPerformers(),
                'form' => $form,
            ]
        );
    }

    public function editAction($id)
    {
        $record = $this->getCollection()->findRecordById($id);

        $form = new RecordForm($this->getCollection());

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $form->valid($_POST)) {
            $record->setTitle($_POST['title']);
            $record->setRelease(new DateTime($_POST['release']));
            $record->setRanking($_POST['ranking']);
            $record->setPrice($_POST['price']);
            $record->setTime(new DateTime('00:00:00'));

            $record->clearTracks();
            $this->addTrack($record, $_POST);

            $performer = $this->getCollection()->findPerformerById($_POST['performers']);

            if ($record->getPerformer()->getId() !== $performer->getId()) {
                $record->getPerformer()->deleteRecord($record);

                $record->setPerformer($performer);

                $record->getPerformer()->addRecord($record);
            }

            $this->getKernel()->saveCollection();

            $this->redirect($this->getBaseUrl());
        }

        $this->render(
            'edit-record.php',
            [
                'performers' => $this->getCollection()->getPerformers(),
                'form' => $form,
                'record' => $record,
            ]
        );
    }

    public function deleteAction($id)
    {
        $record = $this->getCollection()->findRecordById($id);

        $form = new DeleteRecordForm($this->getCollection());

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $form->valid($_POST)) {
            $this->redirect($this->getBaseUrl());
        }

        $this->render(
            'delete-record.php',
            [
                'record' => $record,
            ]
        );
    }

    /**
     * Adds tracks to record
     *
     * @param \Entity\Record\Record $record
     * @param array $post
     */
    private function addTrack(Record $record, array $post)
    {
        for ($i = 0, $j = 1; $i < 13; $i++) {
            if ($post['track_' . $i] && $post['track_length_' . $i]) {
                $track = new Track();
                $track->setNumber($j++);
                $track->setTitle($post['track_' . $i]);
                $track->setLength(new DateTime($post['track_length_' . $i]));

                $record->addTrack($track);

                $diff = (new DateTime('00:00:00'))->diff($track->getLength());

                $record->setTime($record->getTime()->add($diff));
            }
        }
    }
}
