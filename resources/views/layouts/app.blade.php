<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="ayurgreen">
   <meta name="author" content="ayurgreen">
   <title>Ayur Green Online Shop</title>
   <!-- Favicon Icon -->
   <link rel="icon" type="image/png" href="img/favicon.png">

   @include('layouts.frontend.css')

</head>

<body>
    @include('layouts.frontend.header')




    @yield('content')


    @include('layouts.frontend.footer')

    @include('layouts.frontend.script')

</body>
</html>
