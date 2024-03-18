<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wrong 404</title>
    <style>
        body {
            background-color: #f1f1f1;
        }

        .vertical-center {
            min-height: 100%;
            min-height: 100vh;

            display: flex;
            align-items: center;
        }
        
    </style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="vertical-center">
        <div class="container">
            <div id="notfound" class="text-center ">
                <h1>😮</h1>
                <h2>Oops! Page Not Be Found</h2>
                <p>Sorry but the page you are looking for does not exist.</p>
                <a href="{{route('login')}}">Back to homepage</a>
            </div>
        </div>
    </div>
</body>

</html>
