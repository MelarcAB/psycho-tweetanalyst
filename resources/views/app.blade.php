<!DOCTYPE html>
<html>

<head>
    <title>Twitter analizar per</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-iBB6Y7felpm1Hr1GLRk6lDSam3zvH/2j5+3e3/6P7KASt9500pph/TPYIppoZZw+c" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <x-navbar />



    <div id="app">
        <div class="flex flex-wrap h-screen overflow-hidden bg-blue-200 ">
            <div id="tweets-container"class="w-full md:w-1/2 overflow-auto p-4 h-5/6">
                <!-- Contenido del primer div -->
            </div>
            <div id="gpt-container" class="w-full md:w-1/2  overflow-auto p-4 h-5/6">
                <!-- Contenido del segundo div -->
            </div>
        </div>

    </div>
</body>

</html>
