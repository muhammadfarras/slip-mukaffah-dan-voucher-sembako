
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
			$hasil = $db->selectSembakoNoTaken ("add-08-2021");

			$noNoTaken = 0;
			while ($data = $hasil->fetch_assoc()){
				$noNoTaken++;
		?>
	    <tr>
	      <th scope="row"><?php echo $noNoTaken; ?></th>
	      <td><?php echo $data['niyPegawai']; ?></td>
	      <td><?php echo $data['namaPegawai']; ?></td>
	      <td><?php echo $data['statusPengambilan']; ?></td>
	    </tr>
		<?php
			}
		?>
	</tbody>
</table>