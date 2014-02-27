<?php
/**
 * Миграция m140224_091817_create_actions_table
 *
 * @property string $prefix
 */
 
class m140224_091817_create_actions_table extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{actions}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{actions}}', array(
            'id' => 'pk', // auto increment
			'name' => "varchar(255) not null COMMENT 'Название'",
			'wswg_desc' => "text not null COMMENT 'Описание'",
			'wswg_concurs_desc' => "text COMMENT 'Описание конкурса'",
			'img_photo' => "varchar(255) COMMENT 'Изображение'",
			'video' => "varchar(512) COMMENT 'Видео'",
            'gllr_photos' => "int COMMENT 'Галерея фоток события'",
            'gllr_concurs' => "int COMMENT 'Галерея конкурсных работ'",
			'dt_date' => "datetime COMMENT 'Дата проведения'",
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