<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl overflow-hidden flex">
        
        {{-- Left side --}}
        <div class="w-1/2 bg-primary text-white p-10 flex flex-col justify-center items-center">
            <h2 class="text-3xl font-bold mb-4">Join Us!</h2>
            <p class="text-center text-lg">Create your student account</p>
            <img src="https://via.placeholder.com/150x150" alt="Logo" class="mt-8 rounded">
        </div>

        {{-- Right side --}}
        <div class="w-1/2 p-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Register</h2>
            <form action="{{ route('register') }}" method="POST" class="space-y-4 text-sm">
                @csrf

                <div>
                    <label class="block text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <button type="submit"
                    class="w-full bg-primary text-white py-2 rounded hover:bg-primary-hover transition">
                    Register
                </button>
            </form>
            <p class="mt-6 text-sm text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a>
            </p>
        </div>
    </div>

</body>
</html>
