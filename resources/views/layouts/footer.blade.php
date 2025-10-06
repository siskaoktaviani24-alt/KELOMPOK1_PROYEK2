<footer class="bg-dark text-light pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row gy-4">
            <!-- Tentang Kami -->
            <div class="col-md-4">
                <h5 class="text-warning mb-3 border-bottom pb-2">Tentang Kami</h5>
                <p class="text-light-50">
                    Kedai Kopi Premium menghadirkan pengalaman kopi terbaik dengan biji kopi pilihan dan suasana yang nyaman untuk bersantai atau bekerja.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-light fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light fs-5"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Kontak & Lokasi -->
            <div class="col-md-4">
                <h5 class="text-warning mb-3 border-bottom pb-2">Kontak & Lokasi</h5>
                <ul class="list-unstyled">
                    <li class="d-flex mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-warning mt-1"></i>
                        <span>Jl. Kopi Premium No. 123, Jakarta Selatan</span>
                    </li>
                    <li class="d-flex mb-2">
                        <i class="fas fa-phone me-2 text-warning mt-1"></i>
                        <span>+62 21 1234 5678</span>
                    </li>
                    <li class="d-flex mb-2">
                        <i class="fas fa-envelope me-2 text-warning mt-1"></i>
                        <span>info@kedaikopipremium.com</span>
                    </li>
                </ul>
            </div>

            <!-- Jam Operasional -->
            <div class="col-md-4">
                <h5 class="text-warning mb-3 border-bottom pb-2">Jam Operasional</h5>
                <p><strong>Senin - Jumat:</strong> 07.00 - 22.00 WIB</p>
                <p><strong>Sabtu - Minggu:</strong> 08.00 - 23.00 WIB</p>
                <a href="{{ url('/reservasi') }}" class="btn btn-warning text-dark fw-bold mt-2">
                    Reservasi Tempat
                </a>
            </div>
        </div>

        <hr class="border-secondary mt-4 mb-3">
        <div class="text-center text-secondary small">
            &copy; {{ date('Y') }} Kedai Kopi Premium. All rights reserved.
        </div>
    </div>
</footer>

<!-- Tambahkan Bootstrap & Font Awesome jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
