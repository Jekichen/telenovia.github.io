<div class="container">
	<div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Penyakit Sapi</h5>
        </div>
        <div class="card-body">
            <?php
                function formatSolusi($text) {
                    // Pisahkan berdasarkan pola a. b. c. dst.
                    $pattern = '/([a-z])\.\s/';
                    $parts = preg_split($pattern, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

                    $output = "<ol type='a'>";
                    for ($i = 0; $i < count($parts); $i += 2) {
                        if (isset($parts[$i+1])) {
                            $output .= "<li>" . trim($parts[$i+1]) . "</li>";
                        }
                    }
                    $output .= "</ol>";
                    return $output;
                }
            ?>
          <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Penyakit</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Solusi</th>
                    <th class="text-center">Gambar</th>
                </tr>
                <?php
                $penyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
                $no = 1;
                while($a = mysqli_fetch_array($penyakit)){
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-justify"><?= $a['nama_penyakit'] ?></td>
                    <td class="text-justify"><?= $a['keterangan'] ?></td>
                    <td class="text-justify">
                        <?= nl2br(formatSolusi($a['solusi'])) ?>
                    </td>
                    <td class="text-center">
                        <?php if (!empty($a['gambar'])): ?>
                            <img src="../assets/image/penyakit/<?= $a['gambar'] ?>" alt="Gambar Penyakit" width="100" height="100">
                        <?php else: ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php }
                ?>
            </table>
          </div>
        </div>
    </div>
</div>