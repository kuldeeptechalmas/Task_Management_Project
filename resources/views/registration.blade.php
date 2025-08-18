<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRATION USER</h1>
            </div>
            <form id="registrationform" accept="/registration" method="POST"
                style="margin-left: 40px;margin-right:42px;margin-top:25px">
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

                <div data-mdb-input-init class="form-outline mb-4" style="position: relative;">
                    <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" class="form-control" id='password' name="password"
                        value="{{old('password')}}" id="password" />
                    <i class="fa-solid fa-eye" id="show" style="position: absolute;top: 44px;right: 10px;"
                        onclick="passwordshow()"></i>
                    <i class="fa-solid fa-eye-slash" hidden id="hidden"
                        style="position: absolute;top: 44px;right: 10px;" onclick="passwordhidden()"></i>
                </div>
                @error('password')
                    <div style="color:red;">{{$message}}</div>
                @enderror
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
                    style="width: 100%;">Sign Up</button>

                <div class="text-center">
                    <p>You are already Registed? <a href="/login">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        function passwordhidden() {
            $("#show").removeAttr("hidden");
            $("#hidden").attr("hidden", true);
            document.getElementById("password").type = "password";

        }
        function passwordshow() {
            $("#hidden").removeAttr("hidden");
            $("#show").attr("hidden", true);
            document.getElementById("password").type = "text";
        }
    </script>
</body>

</html>