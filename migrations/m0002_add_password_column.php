<?php 


class m0002_add_password_column{

    public function up()
    {
        $db = \anzalahMvc\Core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE user ADD COLUMN password VARCHAR(512) NOT NULL;");
    }

    public function down()
    {
        $db = \anzalahMvc\Core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE user DROP COLUMN password;");
    }
}