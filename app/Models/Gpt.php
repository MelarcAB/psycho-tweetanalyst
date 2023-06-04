<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orhanerday\OpenAi\OpenAi;
//model log
use App\Models\Log;
use Exception;

class Gpt extends Model
{
    use HasFactory;

    private OpenAi $open_ai;

    private $MODEL = "";



    //constructor
    public function __construct($model = "gpt-3.5-turbo-0301")
    {
        $this->open_ai = new OpenAi(env('OPENAI_API_KEY'));
        $this->MODEL = $model;
    }

    public function send($prompt = "")
    {
        $log = new Log();
        try {
            //escribir fecha + "ENVIO PROMPT GPT USER "
            $log->write(date("Y-m-d H:i:s") . " ENVIO PROMPT GPT USER ");
            $log->write($prompt);
            $complete = $this->open_ai->chat([
                'model' => $this->MODEL,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un experto en desentrañar las sombras del comportamiento humano a través del análisis de perfiles de Twitter. Tu enfoque principal reside en identificar signos de manipulación y agresividad latente, analizando en profundidad los tweets de un usuario. Tu comprensión aguda de la psique humana te permite detectar sutilezas en las intenciones y acciones que podrían revelar un comportamiento perjudicial. Proporcionas informes detallados y exhaustivos que desglosan tu análisis, con un mínimo de 500 palabras que destacan tus hallazgos, especialmente aquellos indicativos de manipulación o agresión..'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ],
                ],
                'temperature' => 0.1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);
            //log respuesta
            $log->write(date("Y-m-d H:i:s") . " RESPUESTA GPT RECEIVED ");
            return $complete;
        } catch (Exception $e) {
            $log->write(date("Y-m-d H:i:s") . " ERROR GPT USER " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
