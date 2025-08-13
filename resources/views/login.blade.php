<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
         
</head>

<body>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">LOGIN USER</h1>
            </div>
            <form id="loginform" style="margin-left: 40px;margin-right:42px;margin-top:25px" method="POST"
                action="/login">
                @csrf

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" />

                </div>
                @error('email')
                    <div style="color:red;">{{$message}}</div>
                @enderror

                <div data-mdb-input-init class="form-outline mb-4">

                    <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" class="form-control" value="{{old('password')}}" id="password"
                        name="password" />
                </div>
                @error('password')
                    <div style="color:red;">{{$message}}</div>
                @enderror
                
                <br>
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>


                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
                    style="width: 100%;">Sign in</button>


                <div class="text-center">
                    <p>Not a member? <a href="/registration">Register</a></p>
                    <p>or sign up with:</p>
                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if (session('error'))
    <script>
        toastr.error('User not found');
    </script>
@endif
</body>

</html>