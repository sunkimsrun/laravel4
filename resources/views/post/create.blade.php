<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px 30px;
            max-width: 400px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #0066cc;
            outline: none;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #004999;
        }
        p.success {
            color: green;
            text-align: center;
            font-weight: bold;
        }
        div.errors {
            background-color: #ffe6e6;
            border: 1px solid #ff5c5c;
            color: #b70000;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        div.errors ul {
            margin: 0;
            padding-left: 20px;
        }
        #tittle {
            text-align: center;
            color: #333;
            font-size: 58px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1 id="tittle">Screen Validation</h1>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/post') }}">
        @csrf

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
