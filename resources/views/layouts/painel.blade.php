<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ekklesia - Login</title>

    <!-- CSS Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" type="text/css" rel="stylesheet"> <meta charset="utf-8">
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>

</head>
<body>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-6 justify-content-center flex-column">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png')}}" class="rounded" alt="Asppe">
                  </div>

                <h1 class="mb-4 mt-5 text-center">Login</h1>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="row">
        
                        <div class="col-12 mb-3 justify-content-center">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-12 mb-3 justify-content-center">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-3 pe-5">
                            <button type="submit" class="btn-padrao btn-cadastrar">Entrar</button>                
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
