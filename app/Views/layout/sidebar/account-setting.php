<div x-data="{ 
        avatar: null, 
        updateAvatar(event) { 
            const file = event.target.files[0]; 
            if (file) { 
                const reader = new FileReader(); 
                reader.onload = (e) => { this.avatar = e.target.result; }; 
                reader.readAsDataURL(file); 
            } 
        } 
    }"
    class="space-y-4">
    <!-- Avatar -->
    <div class="flex justify-center mx-auto">
        <div class="relative">
            <!-- Vòng ngoài của avatar -->
            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-300 shadow-md flex items-center justify-center bg-gray-100">
                <!-- Hiển thị icon Font Awesome nếu chưa có ảnh -->
                <template x-if="!avatar">
                    <i class="fas fa-user text-gray-400 text-6xl"></i>
                </template>
                <!-- Hiển thị ảnh nếu đã chọn -->
                <template x-if="avatar">
                    <img :src="avatar" alt="Avatar" class="w-full h-full object-cover">
                </template>
            </div>
            <!-- Nút tải ảnh -->
            <label for="upload-avatar"
                class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </label>
            <input
                type="file"
                id="upload-avatar"
                class="hidden"
                accept="image/*"
                @change="updateAvatar">
        </div>
    </div>

    <!-- Chọn ảnh -->
    <div class="w-full">
        <label class="block text-sm mx-auto font-medium text-gray-700 text-center">Chọn Ảnh</label>
        <input
            type="file"
            class="mt-2 block w-full text-gray-700"
            accept="image/*"
            @change="updateAvatar">
        <p class="text-gray-500 text-sm mt-2">Dung lượng file tối đa 1 MB. Định dạng: JPEG, PNG</p>
    </div>
</div>