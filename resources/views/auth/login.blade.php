<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Trang đăng nhập</h1>
    <form method="POST" action="/login">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
