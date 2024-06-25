<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Property Dekho BD</title>
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">

          <p style="font-size:1.1em">Client Name : {{ $mailData['name'] }}</p>
          <p>Client Phone :  {{ $mailData['phone'] }}</p>
          <p>Client Email : {{ $mailData['email'] }}</p>
          <p>Client Message : {{ $mailData['message'] }}</p>
        </div>
      </div>
</body>

</html>
