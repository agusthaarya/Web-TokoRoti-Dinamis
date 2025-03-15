// Fungsi untuk animasi counter up
function counterUp(element, target, suffix) {
  let current = 0;
  const increment = target / 100; // Tentukan langkah per update (100 langkah)

  // Menggunakan setInterval untuk update angka setiap 50ms
  const interval = setInterval(() => {
    current += increment; // Menambah nilai current dengan langkah
    if (current >= target) {
      current = target; // Pastikan nilai tidak lebih dari target
      clearInterval(interval); // Hentikan interval setelah mencapai target
    }
    element.innerText = Math.floor(current) + suffix; // Update nilai pada elemen dengan menambahkan teks di belakang angka
  }, 50); // Set interval untuk setiap 50ms
}

// Menjalankan fungsi counter up pada setiap elemen setelah halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
  const ratingElements = document.querySelectorAll(".rating-section-number"); // Menyeleksi semua elemen counter

  ratingElements.forEach((el) => {
    const target = parseInt(el.getAttribute("data-target")); // Ambil target dari data-target
    const suffix = el.innerText.split(" ")[1] || ""; // Ambil teks di belakang angka (misalnya "years" atau "orders")
    if (!isNaN(target)) {
      counterUp(el, target, " " + suffix); // Panggil fungsi counterUp dengan menambahkan teks di belakang
    }
  });
});
