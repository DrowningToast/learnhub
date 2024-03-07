<x-layout>
    <div class="mx-auto flex items-center justify-center">
        <div class=" p-12 border rounded-xl flex flex-col items-start justify-start w-1/3">
            <h1 class="text-3xl font-bold mb-6">สมัครสมาชิก</h1>

            <div class="w-full">
                <form action="/register" method="POST">
                    @csrf
                    <div class="my-4">
                        <label for="name" class="block text-sm font-semibold mb-2">ชื่อ นามสกุล</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 p-2 rounded" value="{{ old('name') }}">

                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="email" class="block text-sm font-semibold mb-2">อีเมล</label>
                        <input type="email" name="email" id="email"
                            class="w-full border border-gray-300 p-2 rounded" value="{{ old('email') }}">

                        @error('email')
                            <p class="text-red-500
                            text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="password" class="block text-sm font-semibold mb-2">รหัสผ่าน</label>
                        <input type="password" name="password" id="password"
                            class="w-full border border-gray-300 p-2 rounded" value="{{ old('password') }}">

                        @error('password')
                            <p class="text-red-500
                        text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="password_confirmation"
                            class="block text-sm font-semibold mb-2">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full border border-gray-300 p-2 rounded"
                            value="{{ old('password_confirmation') }}">

                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full text-black p-2 rounded mt-6 bg-blue-300">สมัครสมาชิก</button>
                    <a href="/login" class="text-center mt-6 w-full flex justify-center underline">เข้าสู่ระบบ</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
