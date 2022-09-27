<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LczziwiAAAAAOLf2YBjJTsKe4v-M-jyph_1FksE"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LczziwiAAAAAOLf2YBjJTsKe4v-M-jyph_1FksE', {action: 'submit'}).then(function(token) {
                document.getElementById('g-recaptcha-reponse').value = token;
                console.log(token);
            });
        });
    </script>
</head>
<body>
<form method="get" action="{{route('test1')}}">
    Tên
    <input type="text" name="name" id="">
    <br>
    Sđt
    <input type="phone" name="phone" id="">
    <br>
    <input type="text" name="g-recaptcha-reponse" id="g-recaptcha-reponse">
    <input type="submit" value="Submit">
</form>
</body>
</html>
