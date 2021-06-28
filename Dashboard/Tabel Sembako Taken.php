
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIY</th>
      <th scope="col">Nama</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
		<?php

			$infPengambil = array(
				
				'tanggal' => array(),

				'pengambil' => array ()
			);

			$hasil = $db->selectSembakoTaken ("add-06-2021");

			$noTaken = 0;

			while ($data = $hasil->fetch_assoc()){

				if ( $data['waktuPengambilan'] != null ){

					array_push ( $infPengambil['tanggal'] , $data['waktuPengambilan']);

					array_push ( $infPengambil['pengambil'] , $data['namaPegawai']);

				}

				$noTaken++;


		?>
	    <tr>
	      <th scope="row"><?php echo $noTaken; ?></th>

	      <td><?php echo $data['niyPegawai']; ?></td>

	      <td><?php echo $data['namaPegawai']; ?></td>

	      <td><?php echo $data['statusPengambilan']; ?></td>
	    </tr>
		<?php
			}
			echo "<pre>";
			json_encode ($infPengambil);
		?>
	</tbody>
</table>