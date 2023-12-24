@extends('layouts.master')

@section('content')
    <form method="post" action="{{ route('protector_validate_code') }}">
        <BR>Code: <input type="text" name="code">
        <div id="protector"></div>
        <button type="button" id="reload" onclick="getProtectorFields()">Reload code</button>
        <input type="submit" value="send">
    </form>
    <script>
        (function () {
            let reloadButton = document.getElementById('reload');
            reloadButton.addEventListener("click", getProtectorFields);
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
        })();
    </script>
@endsection
