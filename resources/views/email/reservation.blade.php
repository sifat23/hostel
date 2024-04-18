<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div>
    <p>Hey user {{ $user }},</p>
    <p>You hare a Reservation in {{ $hostel }} {{ $room }} for date {{ $in }} to {{ $out }} for people of {{ $count }}</p>
    <p>Hostel Location: {{ $location }}</p>
</div>
</body>
</html>
