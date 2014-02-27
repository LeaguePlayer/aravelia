<?php
/**
 * Миграция m140224_081118_create_products_table
 *
 * @property string $prefix
 */
 
class m140224_081118_create_products_table extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{products}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{products}}', array(
            'id' => 'pk', // auto increment
			'code' => "varchar(20) not null unique key COMMENT 'Код в 1С'",
			'article' => "varchar(100) not null COMMENT 'Артикул'",
			'name' => "varchar(255) not null COMMENT 'Название'",
			'wswg_desc' => "text COMMENT 'Описание'",
			'country' => "varchar(255) COMMENT 'Страна'",
			'group' => "varchar(100) not null COMMENT 'Группа'",
			'gllr_photos' => "int COMMENT 'Галерея фоток'",
			'category_code' => "varchar(20) COMMENT 'Связь с таблицей категорий'",
			'brand_code' => "varchar(20) COMMENT 'Связь с таблицей брендов'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}