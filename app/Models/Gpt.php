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
                        'content' => 'Analizas perfiles psicológicos de personas a partir de sus tweets.
             Eres el mejor en lo que haces, y analizas en profundidad los tweets, eres capaz de entender si una persona tiene buenas o malas intenciones, si es buena gente, mala o manipuladora, etc.
             Entiendes la psique humana y das reportes extensos y detallados. Genera informe de minimo 300 palabras.'
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
