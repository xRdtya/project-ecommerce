<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="./assets/css/main.css">
    </head>
    <body>
        <div class="auth-container">
            @if (session()->has('loginError'))
                <script>
                    function showToast(message) {
                        // Hapus toast lama jika ada
                        const oldToast = document.querySelector(".toast");
                        if (oldToast) oldToast.remove();

                        const toast = document.createElement("div");
                        toast.className = "toast";
                        toast.textContent = message;
                        document.body.appendChild(toast);

                        // Styling toast
                        toast.style.cssText = `
                            position: fixed;
                            bottom: 20px;
                            left: 50%;
                            transform: translateX(-50%);
                            background: #ea868f;
                            color: white;
                            padding: 12px 24px;
                            border-radius: 8px;
                            z-index: 9999;
                            font-weight: 500;
                            animation: fadeInUp 0.3s, fadeOutDown 0.3s 2.7s;
                        `;

                        // Animasi keyframes
                        const style = document.createElement("style");
                        style.textContent = `
                            @keyframes fadeInUp {
                                from { opacity: 0; transform: translate(-50%, 20px); }
                                to { opacity: 1; transform: translate(-50%, 0); }
                            }
                            @keyframes fadeOutDown {
                                from { opacity: 1; transform: translate(-50%, 0); }
                                to { opacity: 0; transform: translate(-50%, 20px); }
                            }
                        `;
                        document.head.appendChild(style);

                        setTimeout(() => {
                            toast.remove();
                            style.remove();
                        }, 3000);
                    }
                    showToast(`{{ session('loginError') }}`)
                </script>
            @endif
            <h2>Login</h2>

            <form action="http://127.0.0.1:8000/login" method="POST" class="auth-form">
                @csrf
                <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror" placeholder="Email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" placeholder="Password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="auth-switch">
                Belum punya akun? <a href="/register">Daftar</a>
            </div>
        </div>
    </body>
</html>