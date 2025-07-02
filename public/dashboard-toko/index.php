<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <?php 
    function curl(){ 
        $curl = curl_init(); 
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8080/api",
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_CUSTOMREQUEST => "GET", 
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: ChftAQd1aaf4ed1c7cc4ee16UFBQeoKK",
            ),
        ));
            
        $output = curl_exec($curl); 	
        
        if(curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        }
        
        curl_close($curl);      
        
        $data = json_decode($output);   
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON Error: ' . json_last_error_msg();
            echo '<br>Raw output: ' . $output;
        }
        
        return $data;
    } 

    //test webservice
    $send1 = curl();
    
    ?>
    <div class="p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Dashboard - TOKO</h1>
        <p class="fs-5 text-body-secondary"><?= date("l, d-m-Y") ?> <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></p>
    </div> 
    <hr>
    <!-- tampilkan data disini -->

    <div class="table-responsive card m-5 p-5">
        <table class="table text-center">
            <thead>
                <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">Username</th>
                <th style="width: 30%;">Alamat</th>
                <th style="width: 10%;">Total Harga</th>
                <th style="width: 10%;">Jumlah Item</th>
                <th style="width: 10%;">Ongkir</th>
                <th style="width: 10%;">Diskon</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 25%;">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Ganti URL endpoint ke /api/transaksi
                    function curlTransaksi(){ 
                        $curl = curl_init(); 
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://localhost:8080/api/transaksi",
                            CURLOPT_RETURNTRANSFER => true, 
                            CURLOPT_CUSTOMREQUEST => "GET", 
                        ));
                        $output = curl_exec($curl); 	
                        if(curl_errno($curl)) {
                            echo 'Error: ' . curl_error($curl);
                        }
                        curl_close($curl);      
                        $data = json_decode($output);   
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            echo 'JSON Error: ' . json_last_error_msg();
                            echo '<br>Raw output: ' . $output;
                        }
                        return $data;
                    } 
                    $transaksi = curlTransaksi();
                    if(!empty($transaksi)){
                        $i = 1; 
                        foreach($transaksi as $item1){ 
                ?>
                <tr>
                    <td scope="row" class="text-start"><?= $i++ ?></td>
                    <td><?= $item1->username; ?></td>
                    <td><?= $item1->alamat; ?></td>
                    <td><?= $item1->total_harga; ?></td>
                    <td><?= isset($item1->jumlah_item) ? $item1->jumlah_item : '0'; ?></td>
                    <td><?= $item1->ongkir; ?></td>
                    <td><?= isset($item1->total_diskon) ? $item1->total_diskon : '0'; ?></td>
                    <td>
                        <?php
                        if (isset($item1->status)) {
                            if ($item1->status == 1) {
                                echo "Sudah Selesai";
                            } else if ($item1->status == 0) {
                                echo "Belum Selesai";
                            } else {
                                echo $item1->status;
                            }
                        }
                        ?>
                    </td>
                    <td><?= $item1->created_at; ?></td>
                </tr> 
                <?php
                        } 
                    }
                ?> 
            </tbody>
        </table>
    </div> 

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>