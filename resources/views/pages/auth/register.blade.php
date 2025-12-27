@extends('layouts.auth-split')

@section('title', 'Daftar')

@section('image', 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2832&auto=format&fit=crop')

@section('left_content')
    <h1 class="text-4xl xl:text-5xl font-black leading-tight tracking-tight text-white mb-6 drop-shadow-md">
        Bergabunglah<br/>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-sky-200">Bersama Kami.</span>
    </h1>
    <p class="text-lg text-gray-100 mb-10 font-medium leading-relaxed max-w-md">
        Daftarkan diri Anda untuk mengakses layanan administrasi desa yang lebih mudah, cepat, dan transparan.
    </p>
@endsection

@section('content_header')
    <h2 class="text-3xl font-bold tracking-tight text-dark-grey dark:text-white">Buat Akun Baru</h2>
    <p class="mt-2 text-sm text-text-secondary dark:text-text-secondary-dark">
        Isi data diri Anda untuk mendaftar.
    </p>
@endsection

@section('content')
    <form action="{{ route('register.submit') }}" class="space-y-5" method="POST" id="register-form">
        @csrf
        
        <!-- Name Field -->
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="name">
                Nama Lengkap
            </label>
            <div class="relative rounded-lg shadow-sm group">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                    <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">badge</span>
                </div>
                <input class="block w-full rounded-lg border-0 py-3.5 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('name') ring-red-500 @enderror" 
                       id="name" 
                       name="name" 
                       placeholder="Nama Lengkap" 
                       type="text" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus/>
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="email">
                Alamat Email
            </label>
            <div class="relative rounded-lg shadow-sm group">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                    <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">mail</span>
                </div>
                <input class="block w-full rounded-lg border-0 py-3.5 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('email') ring-red-500 @enderror" 
                       id="email" 
                       name="email" 
                       placeholder="nama@email.com" 
                       type="email" 
                       value="{{ old('email') }}" 
                       required/>
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="password">
                Kata Sandi
            </label>
            <div class="relative rounded-lg shadow-sm group">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">lock</span>
                </div>
                <input class="block w-full rounded-lg border-0 py-3.5 pl-10 pr-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('password') ring-red-500 @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••" 
                       type="password" 
                       required/>
                <button class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-400 hover:text-dark-grey dark:text-gray-500 dark:hover:text-white transition-colors" type="button" onclick="togglePassword()">
                    <span class="material-symbols-outlined text-[20px]" id="password-icon">visibility</span>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Location Section -->
        <div class="pt-2 border-t border-gray-200 dark:border-border-dark">
            <p class="text-sm font-semibold text-dark-grey dark:text-gray-200 mb-3">Lokasi Desa</p>
            
            <!-- Province Selection -->
            <div class="space-y-2 mb-3">
                <label class="block text-xs font-medium text-text-secondary dark:text-gray-400" for="province">
                    Provinsi
                </label>
                <div class="relative rounded-lg shadow-sm group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                        <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">map</span>
                    </div>
                    <select id="province" name="province_name"
                            class="block w-full rounded-lg border-0 py-3 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white sm:text-sm sm:leading-6 transition-all">
                        <option value="">-- Pilih Provinsi --</option>
                    </select>
                </div>
            </div>

            <!-- Regency Selection -->
            <div class="space-y-2 mb-3">
                <label class="block text-xs font-medium text-text-secondary dark:text-gray-400" for="regency">
                    Kabupaten/Kota
                </label>
                <div class="relative rounded-lg shadow-sm group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                        <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">location_city</span>
                    </div>
                    <select id="regency" name="regency_name" disabled
                            class="block w-full rounded-lg border-0 py-3 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white sm:text-sm sm:leading-6 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <option value="">-- Pilih Provinsi dahulu --</option>
                    </select>
                </div>
            </div>

            <!-- District Selection -->
            <div class="space-y-2 mb-3">
                <label class="block text-xs font-medium text-text-secondary dark:text-gray-400" for="district">
                    Kecamatan
                </label>
                <div class="relative rounded-lg shadow-sm group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                        <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">domain</span>
                    </div>
                    <select id="district" name="district_name" disabled
                            class="block w-full rounded-lg border-0 py-3 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white sm:text-sm sm:leading-6 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <option value="">-- Pilih Kabupaten dahulu --</option>
                    </select>
                </div>
            </div>

            <!-- Village Selection (from database) -->
            <div class="space-y-2">
                <label class="block text-xs font-medium text-text-secondary dark:text-gray-400" for="village_id">
                    Desa
                </label>
                <div class="relative rounded-lg shadow-sm group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                        <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">location_on</span>
                    </div>
                    <select id="village_id" name="village_id" required disabled
                            class="block w-full rounded-lg border-0 py-3 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white sm:text-sm sm:leading-6 transition-all disabled:opacity-50 disabled:cursor-not-allowed @error('village_id') ring-red-500 @enderror">
                        <option value="">-- Pilih Kecamatan dahulu --</option>
                    </select>
                </div>
                @error('village_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button class="flex w-full justify-center rounded-lg bg-primary hover:bg-primary-hover px-3 py-3.5 text-sm font-bold leading-6 text-white shadow-lg shadow-primary/20 hover:shadow-primary/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all transform active:scale-[0.98]" type="submit">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-text-secondary dark:text-gray-400">
        Sudah punya akun?
        <a class="font-bold leading-6 text-sky-blue hover:text-sky-blue/80 transition-colors" href="{{ route('login') }}">Masuk disini</a>
    </p>

    <!-- Villages Data for JavaScript -->
    <script>
        // Store villages data from server
        const villagesData = @json($villages);
        
        const API_BASE = '/api/regions';
        
        // DOM Elements
        const provinceSelect = document.getElementById('province');
        const regencySelect = document.getElementById('regency');
        const districtSelect = document.getElementById('district');
        const villageSelect = document.getElementById('village_id');
        
        // Load provinces on page load
        document.addEventListener('DOMContentLoaded', async () => {
            await loadProvinces();
        });
        
        // Load provinces from API
        async function loadProvinces() {
            try {
                const response = await fetch(`${API_BASE}/provinces`);
                const provinces = await response.json();
                
                provinceSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    option.dataset.name = province.name;
                    provinceSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading provinces:', error);
            }
        }
        
        // Province change handler
        provinceSelect.addEventListener('change', async function() {
            const provinceId = this.value;
            const provinceName = this.options[this.selectedIndex].dataset.name || '';
            
            // Reset subsequent selects
            regencySelect.innerHTML = '<option value="">-- Memuat Kabupaten... --</option>';
            regencySelect.disabled = true;
            districtSelect.innerHTML = '<option value="">-- Pilih Kabupaten dahulu --</option>';
            districtSelect.disabled = true;
            villageSelect.innerHTML = '<option value="">-- Pilih Kecamatan dahulu --</option>';
            villageSelect.disabled = true;
            
            if (!provinceId) {
                regencySelect.innerHTML = '<option value="">-- Pilih Provinsi dahulu --</option>';
                return;
            }
            
            try {
                const response = await fetch(`${API_BASE}/regencies/${provinceId}`);
                const regencies = await response.json();
                
                regencySelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    option.dataset.name = regency.name;
                    regencySelect.appendChild(option);
                });
                regencySelect.disabled = false;
            } catch (error) {
                console.error('Error loading regencies:', error);
                regencySelect.innerHTML = '<option value="">-- Gagal memuat data --</option>';
            }
        });
        
        // Regency change handler
        regencySelect.addEventListener('change', async function() {
            const regencyId = this.value;
            const regencyName = this.options[this.selectedIndex].dataset.name || '';
            
            // Reset subsequent selects
            districtSelect.innerHTML = '<option value="">-- Memuat Kecamatan... --</option>';
            districtSelect.disabled = true;
            villageSelect.innerHTML = '<option value="">-- Pilih Kecamatan dahulu --</option>';
            villageSelect.disabled = true;
            
            if (!regencyId) {
                districtSelect.innerHTML = '<option value="">-- Pilih Kabupaten dahulu --</option>';
                return;
            }
            
            try {
                const response = await fetch(`${API_BASE}/districts/${regencyId}`);
                const districts = await response.json();
                
                districtSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    option.dataset.name = district.name;
                    districtSelect.appendChild(option);
                });
                districtSelect.disabled = false;
            } catch (error) {
                console.error('Error loading districts:', error);
                districtSelect.innerHTML = '<option value="">-- Gagal memuat data --</option>';
            }
        });
        
        // District change handler - Filter villages from database
        districtSelect.addEventListener('change', function() {
            const districtName = this.options[this.selectedIndex].dataset.name || '';
            const regencyName = regencySelect.options[regencySelect.selectedIndex].dataset.name || '';
            const provinceName = provinceSelect.options[provinceSelect.selectedIndex].dataset.name || '';
            
            villageSelect.innerHTML = '<option value="">-- Memuat Desa... --</option>';
            villageSelect.disabled = true;
            
            if (!districtName) {
                villageSelect.innerHTML = '<option value="">-- Pilih Kecamatan dahulu --</option>';
                return;
            }
            
            // Normalize names for comparison
            const normalizeStr = (str) => str.toUpperCase()
                .replace('KECAMATAN ', '')
                .replace('KABUPATEN ', '')
                .replace('KOTA ', '')
                .replace('PROVINSI ', '')
                .trim();
            
            const selectedRegency = normalizeStr(regencyName);
            const selectedDistrict = normalizeStr(districtName);
            
            // Try to match by regency first (more reliable)
            let filteredVillages = villagesData.filter(village => {
                const villageRegency = normalizeStr(village.regency || '');
                return villageRegency.includes(selectedRegency) || selectedRegency.includes(villageRegency);
            });
            
            // If no match by regency, try district
            if (filteredVillages.length === 0) {
                filteredVillages = villagesData.filter(village => {
                    const villageDistrict = normalizeStr(village.district || '');
                    return villageDistrict.includes(selectedDistrict) || selectedDistrict.includes(villageDistrict);
                });
            }
            
            // If still no match, show all available villages
            if (filteredVillages.length === 0) {
                filteredVillages = villagesData;
            }
            
            if (filteredVillages.length > 0) {
                villageSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                filteredVillages.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village.id;
                    option.textContent = `${village.name} - ${village.district}, ${village.regency}`;
                    villageSelect.appendChild(option);
                });
                villageSelect.disabled = false;
            } else {
                villageSelect.innerHTML = '<option value="">-- Tidak ada desa terdaftar --</option>';
            }
        });
        
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                passwordIcon.textContent = 'visibility';
            }
        }
    </script>
@endsection
