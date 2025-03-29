function getLocation(modalType) {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;

                let latInput = document.getElementById("latitude");
                let lonInput = document.getElementById("longitude");
                let addressText = document.getElementById(modalType === 'masuk' ? "address-text" : "address-text-keluar");

                if (latInput && lonInput && addressText) {
                    latInput.value = lat;
                    lonInput.value = lon;

                    // Panggil API Reverse Geocoding
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.display_name) {
                                addressText.innerText = data.display_name;
                            } else {
                                addressText.innerText = "Alamat tidak ditemukan";
                            }
                        })
                        .catch(error => {
                            console.error("Error mendapatkan alamat:", error);
                            addressText.innerText = "Gagal mendapatkan alamat";
                        });
                }
            },
            function (error) {
                console.error("Error mendapatkan lokasi:", error);
                document.getElementById(modalType === 'masuk' ? "address-text" : "address-text-keluar").innerText = "Gagal mendapatkan lokasi";
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    } else {
        document.getElementById(modalType === 'masuk' ? "address-text" : "address-text-keluar").innerText = "Geolocation tidak didukung di browser ini.";
    }
}

// Jalankan fungsi saat modal dibuka
document.querySelector("label[for='my_modal_absen_masuk']").addEventListener("click", function() {
    getLocation("masuk");
});

document.querySelector("label[for='my_modal_absen_keluar']").addEventListener("click", function() {
    getLocation("keluar");
});


function requestLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;
                console.log("Lokasi berhasil didapatkan:", lat, lon);
            },
            function (error) {
                if (error.code === error.PERMISSION_DENIED) {
                    alert("⚠️ Akses lokasi ditolak! Mohon aktifkan GPS di pengaturan browser.");
                } else if (error.code === error.POSITION_UNAVAILABLE) {
                    alert("⚠️ Lokasi tidak tersedia. Pastikan GPS aktif.");
                } else if (error.code === error.TIMEOUT) {
                    alert("⚠️ Waktu permintaan lokasi habis. Coba lagi.");
                } else {
                    alert("⚠️ Terjadi kesalahan mendapatkan lokasi.");
                }
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    } else {
        alert("⚠️ Browser tidak mendukung geolocation.");
    }
}

// Panggil saat halaman dimuat atau tombol ditekan
document.addEventListener("DOMContentLoaded", requestLocation);
