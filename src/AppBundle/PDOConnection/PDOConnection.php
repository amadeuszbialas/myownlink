<?php

namespace AppBundle\PDOConnection;
use Symfony\Component\Yaml\Yaml;


class PDOConnection
{
    public $dsn;
    public $username;
    public $password;

    public function __construct()
    {
        $dir = __DIR__.'../../../../app/config/parameters.yml';
        $db_config = Yaml::parse(file_get_contents($dir));

        $this->dsn = 'mysql:host='.$db_config['parameters']['database_host'].';dbname='.$db_config['parameters']['database_name'];
        $this->username = $db_config['parameters']['database_user'];
        $this->password = $db_config['parameters']['database_password'];
    }

    public function  getPDO()
    {
        return new \PDO($this->dsn, $this->username, $this->password);
    }


}