<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>
        Hi {{ $user->name }}, Akun anda telah dibuat
    </h4>
    <p>
        Email ini menyertakan detail akun anda
    </p>
    <table>
        <tr>
            <td>
                Email
            </td>
            <td>
                :
            </td>
            <td>
                {{ $user->email }}
            </td>
        </tr>
        <tr>
            <td>
                Password
            </td>
            <td>
                :
            </td>
            <td>
                {{ $user->password }}
            </td>
        </tr>
    </table>
    
</body>
</html>