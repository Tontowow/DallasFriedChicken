<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    
    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16 rounded-lg border">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Destinasi</h2>
            <form enctype="multipart/form-data" method="POST" action="{{ route('destinasi.edit', ['id' => $data->id]) }}">
                @csrf
                @method('POST')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- Destinasi Name -->
                    <div class="sm:col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destinasi Name</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Destinasi Name" value="{{ old('nama', $data->nama) }}" required>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="number" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Rp xxxx" value="{{ old('harga', $data->harga) }}" required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="{{ $data->kategori }}">{{ ucfirst($data->kategori) }}</option>
                            <option value="alam">Alam</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="hiburan">Hiburan</option>
                        </select>
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @if($data->foto)
                            <img src="{{ asset('storage/' . $data->foto) }}" alt="Current Image" class="mt-2" width="100">
                        @endif
                    </div>

                    <!-- Deskripsi -->
                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your deskripsi here">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                    </div>

                    <!-- Peta -->
                    <!-- <div class="sm:col-span-2">
                        <label for="map" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                        <div id="map" style="height: 400px; border-radius: 8px;" class="mb-2"></div>
                        <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $data->latitude) }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $data->longitude) }}">
                    </div> -->
                </div>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-green-600">
                    Simpan
                </button>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta dengan koordinat saat ini
        const map = L.map('map').setView([{{ old('latitude', $data->latitude) }}, {{ old('longitude', $data->longitude) }}], 13);

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker pada lokasi yang sudah ada
        let marker = L.marker([{{ old('latitude', $data->latitude) }}, {{ old('longitude', $data->longitude) }}], { draggable: true }).addTo(map);

        // Update input latitude dan longitude saat marker dipindahkan
        marker.on('moveend', function (e) {
            const latLng = marker.getLatLng();
            document.getElementById('latitude').value = latLng.lat;
            document.getElementById('longitude').value = latLng.lng;
        });

        // Tangkap klik di peta dan pindahkan marker
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script> -->
</body>

</html>
