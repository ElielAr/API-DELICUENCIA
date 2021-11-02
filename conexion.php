<?php
    class Conexion extends PDO{
        private $hostdb = 'bb5qhugqsxd6s6cdpq8o-mysql.services.clever-cloud.com';
        private $nombredb = 'bb5qhugqsxd6s6cdpq8o';
        private $usuariodb = 'uwlgicigirwdtk4t';
        private $contrasenadb = 'bItFpC8WdhRGKPv3TxG4';
        public function __construct()
        {
            try {
                parent::__construct(
                    'mysql:host='.$this->hostdb.';dbname='.$this->nombredb.';charset=utf8'
                    ,$this->usuariodb,$this->contrasenadb,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
                );
            } catch (Exception $e) {
                echo 'error: '.$e->getMessage();
            }
        }
    }
 ?>