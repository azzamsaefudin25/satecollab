<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SATE Login - Pilih Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('{{ asset("backend/img/undip.jpg") }}');
        background-size: cover; /* Agar gambar menutupi seluruh area */
        background-repeat: no-repeat; /* Agar gambar tidak diulang */
        background-position: center; /* Agar gambar berada di tengah */
    }

        .login-container {
            width: 420px;
            padding: 40px;
            border: 2px solid #dcdcdc;
            border-radius: 20px;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
        }

        .logo {
            height: 50px;
            margin-right: 10px;
        }

        h1 {
            font-size: 30px;
            font-weight: bold;
            color: #4b8a29;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .role-selection {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            text-align: center; /* Untuk mengatur agar isi select berada di tengah */
            text-align-last: center; /* Untuk mengatur teks terpilih agar berada di tengah */
            box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.2);
            background-color: #ffffff; 
            cursor: pointer; 
        }
        
        label{
            font-size: 20px;
            font-weight: 600;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
            font-size: 15px;
        }

        .btn:hover {
            background-color: #3c6e23;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <h1>SATE - Pemilihan Role</h1>
        </div>

        <div>
            <form action="{{ route('handleRoleSelection') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="role">Pilih Role Anda:</label>
                    <select class="role-selection" name="role" id="role" class="form-control" required>
                        <option value="" disabled selected>--Pilih Role--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
