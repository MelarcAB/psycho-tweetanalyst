# Psycho-TweetAnalyst

Psycho-TweetAnalyst es una aplicación construida con Laravel que utiliza la API de Twitter y el modelo de lenguaje GPT-4 de OpenAI para analizar tweets y proporcionar un informe psicológico del usuario.

## Configuración

Antes de comenzar, es necesario configurar algunas variables de entorno en tu archivo `.env` para permitir la integración con Twitter y OpenAI.

Asegúrate de tener los siguientes valores establecidos:

TWITTER_CONSUMER_KEY=TuClaveAqui
TWITTER_CONSUMER_SECRET=TuClaveAqui
TWITTER_ACCESS_TOKEN=TuTokenAqui
TWITTER_ACCESS_TOKEN_SECRET=TuTokenAqui
OPENAI_API_KEY=TuClaveAqui


Las claves y tokens para Twitter se pueden obtener creando una aplicación en el [portal de desarrolladores de Twitter](https://developer.twitter.com/en/apps). La clave de la API de OpenAI se puede obtener en el [sitio web de OpenAI](https://beta.openai.com/signup/).

## Instalación

1. Clona el repositorio.
2. Ejecuta `composer install` para instalar las dependencias.
3. Copia `.env.example` a `.env` y configura tus variables de entorno como se describió anteriormente.
4. Ejecuta `php artisan key:generate` para generar la clave de la aplicación.
5. Ejecuta `php artisan serve` para iniciar el servidor de desarrollo.

## Uso

Describe brevemente cómo se usa la aplicación aquí.

## Contribución

Las contribuciones son bienvenidas. Por favor, abre un 'issue' para discutir lo que te gustaría cambiar o añadir.

## Licencia

El código en este repositorio está bajo la licencia MIT. Por favor, consulta el archivo LICENSE para más detalles.
