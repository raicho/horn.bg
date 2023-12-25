@extends('layouts.master')

@section('content')

    <form method="POST" class="form-control mt-5" action="{{ route('protector_validate_code') }}">
        <h3 class="text-center mt-3 mb-3">Example</h3>
        <div class="mb-3 row">
            <label for="code" class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-10">
                <input class="form-control" id="code" placeholder="Type code" type="text" name="code">
            </div>
        </div>
        <div id="protector"></div>
        <button type="button" class="btn btn-secondary mt-3" id="reload">New code</button>

        <button type="submit" class="btn btn-primary mt-3 float-md-end">Check code</button>
    </form>


    <style>
        #protector img {
            width: 100%;
            border-radius: 5px;
            border: 4px double #000;
        }
    </style>

    <script>
        (function () {
            let reloadButton = document.getElementById('reload');
            reloadButton.addEventListener("click", getProtectorFields);
            function getProtectorFields() {
                let url = '{{ route('protector_form') }}';
                let recaptcha = document.getElementById('protector');
                reloadButton.disabled = true;
                setTimeout(function() {
                    reloadButton.disabled = false;
                }, 1000);

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
