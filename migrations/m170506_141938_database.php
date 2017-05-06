<?php

use yii\db\Migration;

class m170506_141938_database extends Migration
{
    public function up()
    {
        $transaction=$this->getDbConnection()->beginTransaction();
        try
        {
            $this->createTable('brands', [
                'id' => $this->primaryKey(),
                'name'=> $this->string(60)->notNull()->comment('Найменування'),
                'count'=> $this->integer(10)->null()->comment('Кількість товарів цього бренду'),
                'keywords'=>$this->string()->null()->comment('Ключові слова'),
                'description'=>$this->string()->null()->comment('Мета-опис'),
                'coment'=>$this->string()->comment('Опис')
            ]);


            $this->createTable('category', [
                'id' => $this->primaryKey(),
                'parent_id'=>$this->integer(10)->defaultValue(0)->comment('Айді батька'),
                'name'=>$this->string()->notNull()->comment('Найменування'),
                'keywords'=>$this->string()->null()->comment('Ключові слова'),
                'description'=>$this->string()->null()->comment('Опис')
            ]);

            $this->createTable('orders', [
                'id' => $this->primaryKey(),
                'created_at'=>$this->dateTime()->notNull()->comment('Дата створення'),
                'updated_at'=>$this->dateTime()->notNull()->comment('Дата оновлення'),
                'qty'=>$this->integer(10)->notNull()->comment('Загальна кількість одиниць товарів'),
                'sum'=>$this->float()->notNull()->comment('Загальна сума'),
                'shipping_cost'=>$this->float()->null()->comment('Вартість доставки'),
                'eco_tax'=>$this->float()->null()->comment('ЕКО податок'),
                'status'=>$this->char(1)->defaultValue(0)->comment('Статус замовлення'),
                'name'=>$this->string()->notNull()->comment('Ініціали замовника'),
                'email'=>$this->string()->notNull()->comment('Email адреса'),
                'phone'=>$this->string(16)->notNull()->comment('Номер телефону замовника'),
                'address'=>$this->string()->notNull()->comment('Адреса'),
                "notes"=>$this->text()->null()->comment('Нотатки до замовлення')
            ]);

            $this->createTable('order_items', [
                'id' => $this->primaryKey(),
                'order_id'=>$this->integer(10)->notNull(),
                'product_id'=>$this->integer(10)->notNull(),
                'name_product'=>$this->string()->notNull()->comment('Найменування продукту'),
                'price'=>$this->float()->notNull()->comment('Ціна'),
                'qty_item'=>$this->integer(11)->notNull()->comment('Загальна кількість одиниць товару'),
                'sum_item'=>$this->float()->notNull()->comment('Загальна сума по продукту'),
            ]);

            $this->createTable('product', [
                'id' => $this->primaryKey(),
                'category_id'=> $this->integer(10)->notNull()->comment('Категорія'),
                'brand_id'=> $this->integer(11)->null()->comment('Бренд'),
                'name'=> $this->string()->notNull()->comment('Найменування'),
                'availability_of'=>$this->char(1)->defaultValue(0)->comment('В наявності'),
                'content'=>$this->text()->null()->comment('Опис продукту'),
                'price'=>$this->float()->notNull()->comment('Ціна'),
                'keywords'=>$this->string()->null()->comment('Ключові слова'),
                'description'=>$this->string()->null()->comment('Мета-опис'),
                'img'=>$this->string()->null()->comment('Найменування картинки'),
                'hit'=>$this->char(1)->defaultValue(0)->comment('Хіт продаж'),
                'new'=>$this->char(1)->defaultValue(0)->comment('Новинка'),
                'sale'=>$this->char(1)->defaultValue(0)->comment('Розпродажа'),
                'recommended'=>$this->char(1)->defaultValue(0)->comment('Рекомендовано'),
            ]);

            $this->createTable('user', [
                'id' => $this->primaryKey(),
                'username'=> $this->string()->notNull()->comment('Нік або емаіл'),
                'password'=> $this->string()->notNull()->comment('Пароль'),
                'auth_key'=>$this->string()->null()
            ]);


            $transaction->commit();
        }
        catch(Exception $e)
        {
            echo "Exception: ".$e->getMessage()."\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('brands');
        $this->dropTable('category');
        $this->dropTable('orders');
        $this->dropTable('order_items');
        $this->dropTable('product');
        $this->dropTable('user');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
