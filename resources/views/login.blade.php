<x-layout>
    <div class="mx-auto flex items-center justify-center">
        <div class=" p-12 border rounded-xl flex flex-col items-start justify-start w-1/3">
            <h1 class="text-3xl font-bold mb-6">เข้าสู่ระบบ</h1>

            <div class="w-full">
                <form action="/login" method="POST">
                    @csrf
                    <div class="my-4">
                        <label for="email" class="block text-sm font-semibold mb-2">อีเมล</label>
                        <input type="email" name="email" id="email"
                            class="w-full border border-gray-300 p-2 rounded" value="{{ old('email') }}">

                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="password" class="block text-sm font-semibold mb-2">รหัสผ่าน</label>
                        <input type="password" name="password" id="password"
                            class="w-full border border-gray-300 p-2 rounded">

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full text-black p-2 rounded mt-6 bg-blue-300">เข้าสู่ระบบ</button>
                    <a href="/register" class="text-center mt-6 w-full flex justify-center underline">สมัครสมาชิก</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
