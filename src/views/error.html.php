<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $statusCode.' - '.$statusText;?></title>
	<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 600px;
        }
        h1 {
            font-size: 80px;
            font-weight: bold;
            margin: 0;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        p {
            font-size: 16px;
            color: #666;
        }
	</style>
</head>
<body>
<div class="container">
	<h1><?php echo $statusCode;?></h1>
	<h2><?php echo $statusText;?></h2>
	<p>An internal server error has occurred.</p>
</div>
</body>
</html>
