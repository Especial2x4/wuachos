<?php

    class Conexion{

        public static function connect(){

            try{
                
                $connect = new PDO('mysql:host=localhost; dbname=game', 'unity', 'admin');

                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $connect->exec("SET CHARACTER SET UTF8");


            }catch(Exception $e){

                die("error " . $e->getMessage());

                echo "Linea del error " . $e->getLine();

            }

            return $connect;

        }


    }


?>