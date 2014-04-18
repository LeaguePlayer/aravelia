<?php

class SiteController extends FrontController
{
	public $layout = '//layouts/main';

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $url = "index";
        $node = Structure::model()->findByUrl($url);
        if($node)
            $data["model"] = $node->getComponent();
        else
            throw new CHttpException(404);

        $catType = Yii::app()->config->get("index.cat");

        if($catType==="0"){
            $minId = Yii::app()->db->createCommand("SELECT	min(id) minid FROM tbl_products")->queryRow();
            $maxId = Yii::app()->db->createCommand("SELECT	max(id) maxid FROM tbl_products")->queryRow();
            $randId = array();
            for($i=0;$i<8;$i++){
                $randId[] = $this->randid($randId,array($minId["minid"],$maxId["maxid"]));
            }
            $data["products"] = Yii::app()->db->createCommand()
                                                    ->select("*")
                                                    ->from("tbl_products")
                                                    ->where(array('in', 'id', $randId))
                                                    ->queryAll();
        }
        else {
            $countProd = Yii::app()->db->createCommand("SELECT	count(id) `count` FROM tbl_products")->queryRow();
            $data["products"] = Yii::app()->db->createCommand()
                ->select("p.id, p.name, p.gllr_photos")
                ->from("tbl_products p")
                ->leftJoin("tbl_categories c", "p.category_code=c.code")
                ->where("c.type_id=:catType", array(":catType"=>$catType))
                ->limit(8,rand(0,$countProd["count"]-9))
                ->queryAll();
        }

        if ( !empty($node->seo->meta_title) )
            $this->title = $node->seo->meta_title.' | '.Yii::app()->config->get('app.name');
        else
            $this->title = $node->name . ' | ' . Yii::app()->config->get('app.name');

		$this->render('index', $data);
	}

    public function actionXml($key){
        if($key=="98Zou10EvXq6cCI"){
            $file = __DIR__."/../../exchange_data/data.xml";
            if(file_exists(__DIR__."/../../exchange_data/data.xml")){
                SiteHelper::parseXml($file);
                Yii::app()->cache->flush();
                rename(__DIR__."/../../exchange_data/data.xml",__DIR__."/../../exchange_data/data0.xml");
                for($i=5;$i>=0;$i--){
                    if(file_exists(__DIR__."/../../exchange_data/data6.xml") && $i==5){
                        unlink(__DIR__."/../../exchange_data/data6.xml");
                    }
                    if(file_exists(__DIR__."/../../exchange_data/data{$i}.xml")){
                        $num = $i+1;
                        rename(__DIR__."/../../exchange_data/data{$i}.xml",__DIR__."/../../exchange_data/data{$num}.xml");
                    }
                    continue;
                }
            }
            else {
                die("Файл не найден!.");
            }
        }
        else
            throw new CHttpException(404);
    }

    public function actionSertificats(){
        if(isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["address"])){
            $model = new Order;

            $name = htmlspecialchars($_POST["name"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $address = nl2br(htmlspecialchars($_POST["address"]));

            $model->type = Order::getType("sertificat");
            $model->name = $name;
            $model->phone = $phone;
            $model->address = $address;

            if($model->save()){
                header('Content-Type:application/json;charset=utf-8');

                $send_mail = Config::model()->findByAttributes(array("param"=>"notifyemail"));

                $message = "{$name} оформил заказ на получение сертфиката<br />";
                $message .= "Телефон: {$phone}<br />";
                $message .= "Адрес: {$address}<br />";

                $mail = new YiiMailer();
                $mail->clearLayout();//if layout is already set in config
                $mail->setFrom($send_mail->value, $name);
                $mail->setTo($send_mail->value);
                $mail->setSubject("Заказ сертификатов");
                $mail->setBody($message);
                $mail->send();

                echo json_encode(array(
                    "success"=>true,
                    "message"=>"Заказ сохранен",
                ));
                return;
            }
        }

        $node = Structure::model()->findByPk(5);
        if($node)
            $data["model"] = $node->getComponent();
        else
            throw new CHttpException(404);

        $data["sertificats"] = Certificate::model()->findAll();
        $data["address"] = explode("\n", Yii::app()->config->get("sert.address"));

        if ( !empty($node->seo->meta_title) )
            $this->title = $node->seo->meta_title.' | '.Yii::app()->config->get('app.name');
        else
            $this->title = $node->name . ' | ' . Yii::app()->config->get('app.name');

        $this->render('sertificats', $data);
    }

    public function actionFeedback(){
        if(isset($_POST)){
            $send_mail = Config::model()->findByAttributes(array("param"=>"notifyemail"));
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $message = nl2br(htmlspecialchars($_POST["message"]));

            $mail = new YiiMailer();
            $mail->clearLayout();//if layout is already set in config
            $mail->setFrom($email, $name);
            $mail->setTo($send_mail->value);
            $mail->setSubject("Сообщение от пользователя Aravelia");
            $mail->setBody($message);
            $mail->send();

            echo "true";
            return true;
        }

        echo "false";
    }

    public function actionMobile(){
        header('Content-Type:application/json;charset=utf-8');

        if(isset($_POST)){
            $model = new Order;
            $model->attributes = $_POST;
            $model->comment = $_POST["messages"];
            $model->type = Order::getType("mobile");
            $model->create_time = date("Y-m-d H:i:s");
            if($model->save()){

                $send_mail = Config::model()->findByAttributes(array("param"=>"notifyemail"));
                $name = $model->name;
                $email = ($model->email) ? $model->email : $send_mail->value;
                $message = $model->name." оставил заказ на сайте<br />";
                $message .= "Телефон: {$model->phone}<br />";
                if($model->email)
                    $message .= "Email: <a href='mailto: {$model->email}'>{$model->email}</a><br />";
                if($model->address)
                    $message .= "Адрес: {$model->address}<br />";
                if($model->comment)
                    $message .= "Комментарий: {$model->comment}<br />";

                $mail = new YiiMailer();
                $mail->clearLayout();//if layout is already set in config
                $mail->setFrom($email, $name);
                $mail->setTo($send_mail->value);
                $mail->setSubject("Поступил заказ на мобильного продавца");
                $mail->setBody($message);
                $mail->send();

                echo json_encode(array(
                    "success"=>true,
                    "message"=>"Заказ сохранен",
                ));
                return;
            }
        }

        echo json_encode(array(
            "success"=>false,
            "message"=>"Нет данныех",
            "errno"=>"406"
        ));
    }

    public function actionOrder(){
        header('Content-Type:application/json;charset=utf-8');

        if(isset($_POST)){
            $model = new Order;
            $model->attributes = $_POST;
            $model->comment = $_POST["messages"];
            $model->type = Order::getType("product");
            if(isset($_POST["mobile"]) && $_POST["mobile"]=="true")
                $model->type = Order::getType("mobile");
            $model->create_time = date("Y-m-d H:i:s");
            if($model->save()){

                $send_mail = Config::model()->findByAttributes(array("param"=>"notifyemail"));
                $name = $model->name;
                $email = ($model->email) ? $model->email : $send_mail->value;
                $message = $model->name." оставил заказ на сайте<br />";
                $message .= "Телефон: {$model->phone}<br />";
                if($model->email)
                    $message .= "Email: <a href='mailto: {$model->email}'>{$model->email}</a><br />";
                if($model->address)
                    $message .= "Адрес: {$model->address}<br />";
                if($model->delivery)
                    $message .= "Тип доставки: {$model->delivery}<br />";
                if($model->payment)
                    $message .= "Вариант оплаты: {$model->payment}<br />";
                if($model->comment)
                    $message .= "Комментарий: {$model->comment}<br />";

                $mail = new YiiMailer();
                $mail->clearLayout();//if layout is already set in config
                $mail->setFrom($email, $name);
                $mail->setTo($send_mail->value);
                $mail->setSubject("Поступил заказ");
                $mail->setBody($message);
                $mail->send();

                echo json_encode(array(
                    "success"=>true,
                    "message"=>"Заказ сохранен",
                ));
                return;
            }
        }

        echo json_encode(array(
            "success"=>false,
            "message"=>"Нет данныех",
            "errno"=>"406"
        ));
    }

    public function actionGetclub(){
        header('Content-Type:application/json;charset=utf-8');

        if(isset($_POST)){
            $model = new Club;
            $model->attributes = $_POST;
            $model->status = 1;
            $model->create_time = date("Y-m-d H:i:s");
            if($model->save()){
                $send_mail = Config::model()->findByAttributes(array("param"=>"notifyemail"));
                $name = $model->name;
                $email = ($model->email) ? $model->email : $send_mail->value;
                $message = $model->name." оставил заявку на сайте<br />";
                $message .= "Телефон: {$model->phone}<br />";
                if($model->email)
                    $message .= "Email: <a href='mailto: {$model->email}'>{$model->email}</a><br />";

                $mail = new YiiMailer();
                $mail->clearLayout();//if layout is already set in config
                $mail->setFrom($email, $name);
                $mail->setTo($send_mail->value);
                $mail->setSubject("Поступила заявка в клуб");
                $mail->setBody($message);
                $mail->send();

                echo json_encode(array(
                    "success"=>true,
                    "message"=>"Заказ сохранен",
                ));
                return;
            }
            else {
                echo json_encode(array(
                    "success"=>false,
                    "message"=>"Ошибка при сохранении",
                    "errors"=>$model->getErrors()
                ));
                return;
            }
        }
        echo json_encode(array(
            "success"=>false,
            "message"=>"Нет данных"
        ));
        return;
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function randid($arrayId,$arrayMinMax){
        $randId = rand($arrayMinMax[0],$arrayMinMax[1]);
        if(array_search($randId,$arrayId))
            return $this->randid($arrayId,$arrayMinMax);
        else
            return $randId;
    }
}