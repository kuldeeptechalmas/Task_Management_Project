<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRATION USER</h1>
                </div>
                <form id="registrationform" accept="/registration" method="POST" style="margin-left: 40px;margin-right:42px;margin-top:25px">
                    @csrf

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" />
                        
                    </div>
                    @error('name')
                    <div style="color:red;">{{$message}}</div>
                @enderror

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email" />
                        
                    </div>
                    @error('email')
                    <div style="color:red;">{{$message}}</div>
                @enderror

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Password</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}" id="password" />
                        
                    </div>
                   @error('password')
                    <div style="color:red;">{{$message}}</div>
                @enderror
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4" style="width: 100%;">Sign Up</button>

                        <div class="text-center">
                    <p>Not a member? <a href="/login">Login</a></p>
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
</body>
</html>