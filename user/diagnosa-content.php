<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Diagnosa</h5>
        </div>
        <div class="card-body">
            <form id="formDiagnosa" action="diagnosa.php?aksi=diagnosa" method="POST">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Gejala</th>
                            <th>Pilih</th>
                        </tr>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_gejala ORDER BY id_gejala");
                        $i = 0;
                        while ($a = mysqli_fetch_array($data)) {
                            $i++;
                            $id_gejala = $a['id_gejala'];
                            echo "
                            <tr>
                                <td class='text-center'>$i</td>
                                <td class='text-center'>Apakah Sapi Anda mengalami gejala <b>$a[nama_gejala]</b>?</td>
                                <td>
                                    <select class='form-control gejala-select' name='kondisi[$id_gejala]'>
                                        <option value='' selected disabled>Pilih Kondisi</option>
                                        <option value='0.0'>Tidak</option>
                                        <option value='0.2'>Tidak Mungkin</option>
                                        <option value='0.4'>Mungkin</option>
                                        <option value='0.6'>Kemungkinan Besar</option>
                                        <option value='0.8'>Yakin</option>
                                        <option value='1.0'>Sangat Yakin</option>
                                    </select>
                                </td>
                            </tr>";
                        }
                        ?>
                    </table>
                </div>
                <input type="hidden" name="id_akun" value="<?= $_SESSION['id_akun']; ?>">
                <button type="button" class="btn btn-secondary" id="btnBatal" disabled>Batal</button>
                <input type="submit" value="Proses Diagnosa" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<style>
/* Untuk men-disable sidebar */
.disabled-sidebar {
    pointer-events: none !important;
    opacity: 0.6;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('formDiagnosa');
    const selects = document.querySelectorAll('.gejala-select');
    const sidebarItems = document.querySelectorAll('.nav-item');
    const btnBatal = document.getElementById('btnBatal');

    function toggleSidebarLock(lock) {
        sidebarItems.forEach(el => {
            if (lock) {
                el.classList.add('disabled-sidebar');
            } else {
                el.classList.remove('disabled-sidebar');
            }
        });
    }

    function checkSelections() {
        let hasSelection = false;
        selects.forEach(select => {
            if (select.value !== '') {
                hasSelection = true;
            }
        });

        toggleSidebarLock(hasSelection);
        btnBatal.disabled = !hasSelection;
    }

    // Deteksi perubahan setiap dropdown
    selects.forEach(select => {
        select.addEventListener('change', checkSelections);
    });

    // Tombol Batal untuk reset dropdown
    btnBatal.addEventListener('click', function () {
        selects.forEach(select => {
            select.selectedIndex = 0;
        });
        checkSelections(); // Update UI setelah reset
    });

    // Validasi saat submit
    form.addEventListener('submit', function (e) {
        let valid = false;
        selects.forEach(select => {
            if (select.value !== '') {
                valid = true;
            }
        });

        if (!valid) {
            e.preventDefault();
            alert('Silakan Pilih Gejala Sebelum Melanjutkan Proses Diagnosa.');
        }
    });

    // Inisialisasi awal
    checkSelections();
});
</script>