<?php
error_reporting(-1);
ini_set('display_errors', true);
class EventController extends ApiController
{
	public function accessRules()
	{
		return array(
			array('allow')
		);
	}

	public function actionIndex()
	{
		$event = new Events;
		$event->attributes = $_GET;

        if (!isset($_GET['content_id']))
        {
            $content = Content::model()->findByAttributes(array('slug' => Cii::get($_GET, 'uri', NULL)));
            if ($content !== NULL)
                $event->content_id = $content->id;
        }

		if ($event->save())
			Yii::app()->end();

		return $this->returnError(400, NULL, $event->getErrors());
	}
}
