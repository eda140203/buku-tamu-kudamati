      <!--Buat Favicon-->
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
      
    <!--panggil file header-->
       <?php include "header.php"; ?>

       <?php
       
       // uji jika tombol simpan diklik
       if(isset($_POST['bsimpan'])){
          $tgl = date('Y-m-d');

          //htmlspecialchars agar inputan lebih aman dari injection
          $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
          $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
          $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
          $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

          //persiapan query simpan data
          $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES('','$tgl', '$nama', '$alamat', '$tujuan', '$nope')");

          //uji jika simpan data sukses
          if ($simpan){
            echo "<script>alert('Simpan data sukses, Terima kasih..!');
                    document.location='?'</script>";
          } else {
            echo "<script>alert('Simpan data GAGAL!!!');
                    document.location='?'</script>";
          }

       }


       ?>
        <!--Head-->
        <div class="head text-center">
            <img src="assets/img/logo.png">
            <h2 class="text-white"> SISTEM INFORMASI BUKU TAMU <br>KANTOR KELURAHAN KUDAMATI</h2>
        </div>
        <!--end Head-->

        <!--Awal Row-->
        <div class="row mt-2">
            <!--col-lg--7-->
            <div class="col-lg-7 mb-3">
                <div class="card shadow bg-gradient-light">
                    <!-- card-body-->
                <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="from-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="from-group">
                                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat Pengunjung" required>
                                </div>
                                <div class="from-group">
                                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                                </div>
                                <div class="from-group">
                                </div>
                                <div class="from-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="Nomor Hp Pengunjung" required>
                                </div>


                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">SIMPAN DATA</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">By. Kantor Kelurahan Kudamati | 2023 - 2030</a>
                            </div>
                         </div>
                         <!--end card-body-->
                      </div>
                    </div>
            <!--end col-lg-7-->

             <!--col-lg--5-->
             <div class="col-lg-5 mb-3">
                <!--card-->
                <div class="card shadow">
                    <!-- card-body-->
                <div class="card-body">
                <div class="text-center">
                   <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                     </div>
                     <?php
                        // deklarasi tanggal

                        // menampilkan tanggal sekarang
                        $tgl_sekarang = date('Y_m_d');

                        // menampilkan tanggal kemarin
                        $kemarin = date('Y_m_d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                        //mendapatkan 6 hari sebelum tgl skrg
                        $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                        $sekarang = date('Y-m-d h:i:s');

                        // persiapan query tampilkan jumlah data pengunjung

                        $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"
                        ));

                        $kemarin = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"
                        ));

                        $seminggu = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"
                        ));

                        $bulan_ini = date('m');

                        $sebulan = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                            ));

                        $keseluruhan = mysqli_fetch_array(mysqli_query(
                            $koneksi,
                            "SELECT count(*) FROM ttamu"
                            ));
                            
                                
                     ?>
                     <table class="table table-bordered">

                        <tr>
                            <td><svg xmlns="http://www.w3.org/2000/svg" 
                            width="16" height="16" fill="currentColor" 
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 
                            0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 
                            4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 
                            10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                            </svg>
                                Hari ini</td>
                            <td>: <?= $tgl_sekarang[0]?></td>
                        </tr>
                        <tr>
                            <td><svg xmlns="http://www.w3.org/2000/svg" 
                            width="16" height="16" fill="currentColor" 
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 
                            1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                                Kemarin</td>
                            <td>: <?= $kemarin[0]?></td>
                        </tr>
                        <tr>
                            <td><svg xmlns="http://www.w3.org/2000/svg" 
                            width="16" height="16" fill="currentColor" 
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 
                            1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 
                            5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 
                            1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg>
                                Minggu ini</td>
                            <td>: <?= $seminggu[0]?></td>
                        </tr>
                        <tr>
                            <td><svg xmlns="http://www.w3.org/2000/svg" 
                            width="16" height="16" fill="currentColor" 
                            class="bi bi-bar-chart-line-fill" 
                            viewBox="0 0 16 16">
                            <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 
                            1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 
                             1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
                            </svg>
                                Bulan ini</td>
                            <td>: <?= $sebulan[0]?></td>
                        </tr>
                        <tr>
                            <td><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" 
                            class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 
                            3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 
                            0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 
                            5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 
                            2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                            </svg>
                                KESELURUHAN</td>
                            <td>: <?= $keseluruhan[0]?>
                        </td>
                        </tr>
                     </table>
                </div>
                  <!-- card-body-->
            </div>
            <!--end card-->
        </div>

             <!--end col-lg--5-->

        </div>
        <!-- end Row-->

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?= date ('d-m-Y') ?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Pengunjung </a>
                            <a href="pembuatansurat.php" class="btn btn-secondary mb-3"><i class="fa fa-table"></i> Syarat Pembuatan Surat </a>
                            <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i> Logout </a>
                            

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>No.hp</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>tanggal</th>
                                        <th>Nama Pengunjung</th>
                                        <th>Alamat</th>
                                        <th>Tujuan</th>
                                        <th>No.hp</th>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $tgl = date('Y-m-d'); //2023-06-09
                                            $tampil = mysqli_query($koneksi,"SELECT * FROM ttamu  where tanggal like '%$tgl%' order by id desc");
                                            $no = 1;
                                            while($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['tanggal'] ?></td>                                                                                        
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td><?= $data['tujuan'] ?></td>
                                            <td><?= $data['nope'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

<!--panggil file footer-->
<?php include "footer.php"; ?>