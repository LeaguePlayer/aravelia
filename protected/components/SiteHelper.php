<?php

class SiteHelper {

	public static function translit($str) {
		$tr = array(
			"А" => "a", "Б" => "b", "В" => "v", "Г" => "g",
			"Д" => "d", "Е" => "e", "Ж" => "j", "З" => "z", "И" => "i",
			"Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
			"О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
			"У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
			"Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
			"Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
			"в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
			"з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
			"м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
			"с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
			"ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
			"ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
			" " => "_", "." => "_", "/" => "-", "(" => "", ")" => "",
		);
		return strtr($str, $tr);
	}

	public static function pluralize($n, $arr) {

		$index = $n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
		if ($arr) {
			return $n . ' ' . $arr[$index];
		} else {
			return $n;
		}
	}

	public static function scanNameModels($folderAlias = 'application.models', $parentClass = 'EActiveRecord') {
		$path = Yii::getPathOfAlias($folderAlias);
		$files = scandir($path);
		$ret = array();
		foreach ($files as $file) {
			if (($pos = strpos($file, '.php')) === false)
				continue;
			$modelClass = substr($file, 0, -4);
			try {
				if (get_parent_class($modelClass) === $parentClass) {
					$ret[] = $modelClass;
				}
			} catch (Exception $e) {
				continue;
			}
		}
		return $ret;
	}

	public static function genUniqueKey($length = 9, $salt = '') {
		$string = 'abcdefghijlklmnopqrstuvwxyzABCDEFGHIJLKLMNOPQRSTUVWXYZ1234567890';
		$result = '';
		$n = strlen($string);
		for ($i = 0; $i < $length; $i++) {
			$result .= $string[rand(0, $n)];
		}
		if ($length and $length > 0)
			return substr(md5($result . $salt . time()), 0, $length);
		else
			return substr(md5($result . time()), 0);
	}
	
	public static function russianMonth($monthNumber)
	{
		$n = (int) $monthNumber;
		switch ($n) {
			case 1:
				return 'января';
			case 2: 
				return 'февраля';
			case 3: 
				return 'марта';
			case 4: 
				return 'апреля';
			case 5: 
				return 'мая';
			case 6: 
				return 'июня';
			case 7: 
				return 'июля';
			case 8: 
				return 'августа';
			case 9: 
				return 'сентября';
			case 10: 
				return 'октября';
			case 11: 
				return 'ноября';
			case 12: 
				return 'декабря';
		}
	}

	public static function russianDate($datetime = null) {
        if (!$datetime || $datetime == 0)
            return '';
            
		if (is_numeric($datetime) ) {
			$timestamp = $datetime;
		} else if (is_string($datetime)) {
			$timestamp = strtotime($datetime);
        } else {
			$timestamp = time();
		}
		$date = explode(".", date("d.m.Y", $timestamp));
		$m = self::russianMonth($date[1]);
		return $date[0] . '&nbsp;' . $m . '&nbsp;' . $date[2];
	}

	public static function sendMail($subject,$message,$to='',$from='')
    {
        if($to=='') $to = Yii::app()->params['adminEmail'];
        if($from=='') $from = 'no-reply@torsim.ru';
        $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
        return mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }

    /**
     * Обрабатываем xml из 1С
     */
    public static function parseXml($file){
        set_time_limit(300);
        $start = microtime(true);
        if(file_exists($file))
            die("Файл не найден!");

        $xml = simplexml_load_file($file);

        Yii::app()->db->createCommand()
            ->update("tbl_products", array(
                "status"=>"2",
            ));

        // обрабатываем производителей
        $query = "";
        foreach($xml->{"Производители"}->{"Производитель"} as $brand){
            $attr = $brand->attributes();
            $code = str_replace('"', "", trim($attr["Код"]));
            $name = str_replace('"', "", trim($attr["Наименование"]));
            $desc = str_replace('"', "", trim($attr["Описание"]));
            $datetime = date("Y-m-d H:i:s");
            $brand_row = Yii::app()->db->createCommand()->select("*")->from("tbl_brands")->where("code=:code", array(":code"=>$code))->queryRow();
            if($brand_row){
                if($brand_row["name"] != $name) {
                    $query .= "UPDATE tbl_brands SET name='{$name}'";

                    if(!empty($desc))
                        $query .= ", wswg_desc='{$desc}'";

                    $query .= ", update_time='{$datetime}' WHERE code='{$code}';";
                }
            }
            else {
                $query .= "INSERT INTO tbl_brands (code,name,wswg_desc, create_time, update_time) VALUES('{$code}','{$name}','{$desc}', '{$datetime}', '{$datetime}');";
            }
        }
        if(!empty($query))
            Yii::app()->db->createCommand($query)->execute();

        // обрабатываем товары
        $query = "";
        $i = 0;
        foreach($xml->{"Товары"}->{"Товар"} as $product){
            $attr = $product->attributes();
            $code = str_replace('"', "", trim($attr["Код"]));
            $article = str_replace('"', "", trim($attr["Артикул"]));
            $name = str_replace($article,"",trim($attr["Наименование"]));
            $desc = str_replace('"', "", trim($attr["Описание"]));
            $group = str_replace('"', "", trim($attr["ЦеноваяГруппа"]));
            $country = str_replace('"', "", trim($attr["Страна"]));
            $category_code = str_replace('"', "", trim($attr["КодКатегории"]));
            $brand_code = str_replace('"', "", trim($attr["КодПроизводителя"]));
            $datetime = date("Y-m-d H:i:s");
            $product_row = Yii::app()->db->createCommand()->select("*")->from("tbl_products")->where("code=:code", array(":code"=>$code))->queryRow();
            if($product_row){
                $query .= "UPDATE tbl_products SET code='{$code}', article='{$article}', `name`='{$name}', `group`='{$group}', country='{$country}', `status`=1, category_code='{$category_code}', brand_code='{$brand_code}'";
                if(!empty($desc)){
                    $query .= ", wswg_desc='{$desc}'";
                }

                $query .= ", update_time='{$datetime}' WHERE code='{$code}';";
            }
            else {
                $query .= "INSERT INTO tbl_products (code,article,name,wswg_desc,`group`,country,category_code,brand_code,create_time,update_time) VALUES('{$code}','{$article}','{$name}','{$desc}','{$group}','{$country}','{$category_code}','{$brand_code}','{$datetime}','{$datetime}');";
            }
            $i++;
            if($i>10){
                $i = 0;
                if(!empty($query)) {
                    Yii::app()->db->createCommand($query)->execute();
                    $query = "";
                }
            }
        }
        if(!empty($query))
            Yii::app()->db->createCommand($query)->execute();

        // обрабатываем категории
        $query = "";
        $i = 0;
        foreach($xml->{"Категории"}->{"Категория"} as $cat){
            $i++;
            $attr = $cat->attributes();
            $code = str_replace('"', "", trim($attr["Код"]));
            $name = str_replace('"', "", trim($attr["Наименование"]));
            $datetime = date("Y-m-d H:i:s");
            $cat_row = Yii::app()->db->createCommand("SELECT * FROM tbl_categories WHERE name='{$name}'")->queryRow();
            if($cat_row){
                $query .= "UPDATE tbl_products SET category_code='{$cat_row["code"]}', update_time='{$datetime}' WHERE category_code='{$code}';";
            }
            else {
                $cat_row2 = Yii::app()->db->createCommand("SELECT * FROM tbl_categories WHERE code='{$code}'")->queryRow();
                if(!$cat_row2)
                    $query .= "INSERT INTO tbl_categories (code,name,create_time,update_time) VALUES('{$code}','{$name}', '{$datetime}', '{$datetime}');";
            }
            if($i > 10){
                if(!empty($query)) {
                    Yii::app()->db->createCommand($query)->execute();
                    $query = "";
                    $i=0;
                }
            }
        }
        if(!empty($query))
            Yii::app()->db->createCommand($query)->execute();

        // обрабатываем характеристики
        $query = "";
        $i = 0;
        foreach($xml->{"Товары"}->{"Характеристика"} as $char){
            $attr = $char->attributes();
            $code = preg_replace('/[^0-9]/', '', trim($attr["Код"]));
            $value = str_replace('"', "", trim($attr["Значение"]));
            $value = str_replace('*', "-", $value);
            $value = str_replace('/', "-", $value);
            $value_from = preg_replace('/[^0-9-]/', '', $value);
            $values = explode("-", $value_from);
            $value_from = $values[0];
            $value_to = (count($values) > 2) ? $values[count($values)-1] : $values[1];
            $char_row = Yii::app()->db->createCommand()->select("*")->from("tbl_characteristics")->where("code=:code", array(":code"=>$code))->queryRow();
            if($char_row){
                if($char_row["value"] != $value || $char_row["value_to"] != $value_to)
                    $query .= "UPDATE tbl_characteristics SET code='{$code}',`value`='{$value}',value_from='{$value_from}',value_to='{$value_to}' WHERE code='{$code}';";
            }
            else {
                $query .= "INSERT INTO tbl_characteristics (code,`value`,value_from,value_to) VALUES('{$code}','{$value}','{$value_from}','{$value_to}');";
            }
            $i++;
            if($i>10){
                $i = 0;
                if(!empty($query)) {
                    Yii::app()->db->createCommand($query)->execute();
                    $query = "";
                }
            }
        }
        if(!empty($query))
            Yii::app()->db->createCommand($query)->execute();

        // обрабатываем остатки
        $query = "";
        foreach($xml->{"Остатки"}->{"Остаток"} as $balans){
            $attr = $balans->attributes();
            $product_code = str_replace('"', "", trim($attr["КодТовара"]));
            $char_code = preg_replace('/\s/', '', trim($attr["КодХарактеристики"]));
            $char_code = preg_replace('/[^0-9]/', '', $char_code);
            $price = preg_replace('/\s/', '', trim($attr["Цена"]));
            $count = preg_replace('/\s/', '', trim($attr["Количество"]));
            $balans_row = Yii::app()->db->createCommand()->select("*")->from("tbl_balances")->where(array("and", "product_code=:product_code", "characteristic_code=:char_code"), array(":product_code"=>$product_code,":char_code"=>$char_code))->queryRow();
            if($balans_row){
                if($balans_row["price"] != $price || $balans_row["count"] != $count) {
                    $query .= "UPDATE tbl_balances SET ";
                    if($balans_row["price"] != $price)
                        $query_arr[] = "price='{$price}'";
                    if($balans_row["count"] != $count)
                        $query_arr[] = "count='{$count}'";
                    $query .= implode(",", $query_arr);
                    unset($query_arr);
                    $query .= " WHERE product_code='{$product_code}' AND characteristic_code='{$char_code}';";
                }
            }
            else {
                $query .= "INSERT INTO tbl_balances (product_code,characteristic_code,price,`count`) VALUES('{$product_code}','{$char_code}', '{$price}', '{$count}');";
            }
        }
        if(!empty($query))
            Yii::app()->db->createCommand($query)->execute();

        echo 'Время выполнения скрипта: '.(microtime(true) - $start).' сек.<br>';
        Yii::app()->cache->flush();
    }
}