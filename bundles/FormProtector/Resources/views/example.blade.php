<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome view</title>
</head>
<body>


<form method="post" action="{{ route('protector_validate_code') }}">
    <BR>Code: <input type="text" name="code">
    <div id="protector"></div>
    <button type="button" id="reload" onclick="getProtectorFields()">Reload code</button>
    <input type="submit" value="send">
</form>

</body>
</html>


<script>
    function getProtectorFields() {
        let url = '{{ route('protector_form') }}';
        let recaptcha = document.getElementById('protector');
        fetch(url)
            .then(response => response.text())
            .then(data => {
                recaptcha.innerHTML = data;
            })
            .catch(error => {
                console.error('Грешка:', error);
            });
    }
    getProtectorFields();
</script>
