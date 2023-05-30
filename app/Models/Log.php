<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//este modelo escribira en un archivo de texto los logs de las peticiones
class Log extends Model
{
    use HasFactory;

    //filename default log.txt
    private $filename = "log.txt";
    public function __construct($filename = "log.txt")
    {
        $this->filename = $filename;
    }


    public function write($text)
    {
        //verificar si existe el archivo, si no existe crearlo
        if (!file_exists($this->filename)) {
            $myfile = fopen($this->filename, "w");
            fclose($myfile);
        }

        //abrir el archivo
        $myfile = fopen($this->filename, "a");
        //escribir el texto al final del archivo
        fwrite($myfile, $text . "\n");
        //cerrar el archivo
        fclose($myfile);
    }


    public function clear()
    {
        //abrir el archivo
        $myfile = fopen($this->filename, "w");
        //escribir el texto
        fwrite($myfile, "");
        //cerrar el archivo
        fclose($myfile);
    }
}
