@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.register.title')  }}
@endsection

@section('content')
    <form class="row g-3 mt-3" action="{{ route('register_page') }}" method="POST">
        {{ csrf_field() }}

        <div class="col-md-12">
            <label for="email" class="form-label">{{ __('forms.nameLabel') }}</label>
            <input type="text" name="name" value="{{  request('name') }}" class="form-control" id="name">
            @if(isset($errors['name']))
                @foreach($errors['name']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif
        </div>

        <div class="col-md-12">
            <label for="email" class="form-label">{{ __('forms.emailLabel') }}</label>
            <input type="text" name="email" value="{{  request('email') }}" class="form-control" id="email">

            @if(isset($errors['email']))
                @foreach($errors['email']  as $emailError)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $emailError }}</div>
                @endforeach
            @endif
        </div>


        <div class="col-md-12">
            <label for="password" class="form-label">{{ __('forms.passwordLabel') }}</label>
            <input type="password" name="password" class="form-control" id="password">
            @if(isset($errors['password']))
                @foreach($errors['password']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif
        </div>

        <div class="col-md-12">
            <label for="repeatPassword" class="form-label">{{ __('forms.repeatPasswordLabel') }}</label>
            <input type="password" name="password_confirmation" class="form-control" id="repeatPassword">
            @if(isset($errors['password_confirmation']))
                @foreach($errors['password_confirmation']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input checkbox-modal" data-target="termsOfServiceModal" data-checked="0" name="terms_of_service" type="checkbox" id="termsOfService">
                <label class="form-check-label" for="termsOfService">
                    {{  __('forms.termsOfServiceLabel')  }}
                </label>
            </div>
            @if(isset($errors['terms_of_service']))
                @foreach($errors['terms_of_service']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="col-md-2">
            <button type="button" class="btn h-100 btn-secondary float-start w-100" id="reload">New code</button>
        </div>

        <div class="col-md-3">
            <div id="protector"></div>
        </div>

        <div class="col-md-7">
            <input type="text" name="code" class="form-control h-100" id="code"
                   placeholder="Enter the code from the image here">
        </div>
        @if(isset($errors['code']))
            <div class="col-12 mb-3">
                @foreach($errors['code']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="col-md-12">
            <a class="float-md-start d-block mt-1  text-decoration-none"
               href="{{ route('user_forgot_password') }}">{{ __('pages.login.forgot_password_link_text') }}</a>
            <a class="float-md-end d-block mt-1 text-decoration-none"
               href="{{ route('login_page') }}">{{ __('pages.login.go_to_login_page_link') }}</a>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('buttons.joinNow') }}</button>
            </div>
        </div>
    </form>



    <!-- Modal -->
    <div class="modal fade" id="termsOfServiceModal" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Terms of service title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab asperiores aspernatur autem dicta
                    dolores eum ex explicabo id, ipsam libero magni molestias nesciunt obcaecati praesentium provident
                    quod suscipit totam veritatis.
                    TODO: add
                </div>
                {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

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
                setTimeout(function () {
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


