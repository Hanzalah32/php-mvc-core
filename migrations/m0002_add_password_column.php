<?php 


class m0002_add_password_column{

    public function up()
    {
        $db = \anzalahmvc\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE orders ADD COLUMN password VARCHAR(512) NOT NULL;");
    }

    public function down()
    {
        $db = \anzalahmvc\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE orders DROP COLUMN password;");
    }
}