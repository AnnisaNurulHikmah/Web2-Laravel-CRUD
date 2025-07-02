

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Tombol Trigger Modal Tambah -->
    <a href="#" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Mahasiswa
    </a>
    <!-- Tombol Cari -->
    <form action="<?php echo e(route('mahasiswa.index')); ?>" method="GET" class="d-flex" style="max-width: 300px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari NIM / Nama..." value="<?php echo e(request('search')); ?>">
        <button class="btn btn-outline-primary">Cari</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered shadow-sm rounded" style="background-color: #ffffff;">
        <thead class="table-light">
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col"style="width: 150px;">NIM</th>
                <th scope="col"style="width: 250px;">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Telepon</th>
                <th scope="col" style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($m->nim); ?></td>
                <td><?php echo e($m->nama); ?></td>
                <td><?php echo e($m->email); ?></td>
                <td><?php echo e($m->telepon); ?></td>
                <td class="text-center">
                    <!-- Tombol Modal Show -->
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow<?php echo e($m->id); ?>">
                        Detail
                    </button>

                    <!-- Tombol Modal Edit -->
                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo e($m->id); ?>">
                        Ubah
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="<?php echo e(route('mahasiswa.destroy', $m->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin data akan dihapus?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-outline-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Show -->
            <div class="modal fade" id="modalShow<?php echo e($m->id); ?>" tabindex="-1" aria-labelledby="modalShowLabel<?php echo e($m->id); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalShowLabel<?php echo e($m->id); ?>">Detail Mahasiswa</h5>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>NIM:</strong> <?php echo e($m->nim); ?></li>
                                <li class="list-group-item"><strong>Nama:</strong> <?php echo e($m->nama); ?></li>
                                <li class="list-group-item"><strong>Email:</strong> <?php echo e($m->email); ?></li>
                                <li class="list-group-item"><strong>Telepon:</strong> <?php echo e($m->telepon); ?></li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> <?php echo e($m->jenis_kelamin); ?></li>
                                <li class="list-group-item"><strong>Agama:</strong> <?php echo e($m->agama); ?></li>
                                <li class="list-group-item"><strong>Alamat:</strong> <?php echo e($m->alamat); ?></li>
                                <?php if($m->foto): ?>
                                <li class="list-group-item">
                                    <strong>Foto:</strong><br>
                                    <img src="<?php echo e(asset('storage/' . $m->foto)); ?>" alt="Foto" width="120">
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit<?php echo e($m->id); ?>" tabindex="-1" aria-labelledby="modalEditLabel<?php echo e($m->id); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <form action="<?php echo e(route('mahasiswa.update', $m->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel<?php echo e($m->id); ?>">Edit Mahasiswa</h5>
                            </div>
                            <div class="modal-body">
                                <?php echo $__env->make('mahasiswa.form', ['mahasiswa' => $m], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // Tangkap semua form edit berdasarkan class
                document.querySelectorAll('.form-edit-mahasiswa').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const konfirmasi = confirm('Yakin ingin mengubah data mahasiswa ini?');
                        if (!konfirmasi) {
                            e.preventDefault(); // Batalkan submit jika pilih Batal
                        }
                    });
                });
            </script>

            <?php if($mahasiswas->isEmpty()): ?>
            <tr>
                <td colspan="7" class="text-center">Data mahasiswa tidak ditemukan.</td>
            </tr>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-3">
    <?php echo e($mahasiswas->links()); ?>

</div>

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Tambah Mahasiswa</h5>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('mahasiswa.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-mahasiswa\resources\views/mahasiswa/index.blade.php ENDPATH**/ ?>