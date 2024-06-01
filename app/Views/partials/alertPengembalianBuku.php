<!-- Loop through regular peminjaman -->
    <?php foreach ($peminjaman as $peminjam): ?>
        <!-- Display peminjaman information -->
        <!-- ... your existing code ... -->
    <?php endforeach; ?>

    <!-- Display overdue returns warning -->
    <?php if (!empty($overdueReturns)): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Peringatan!</strong> Buku harus dikembalikan hari ini juga, jika telat anda akan diberi denda setiap keterlambatan pengembalian buku!
        </div>
    <?php endif; ?>