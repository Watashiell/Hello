<?php
	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "customer";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_POST['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE monitor set
											 	Nama = '$_POST[Nama]',
											 	Alamat = '$_POST[Alamat]',
												Kategori = '$_POST[Kategori]',
											 	Durasi = '$_POST[Durasi]'
												Total = '$_POST[Total]' 
											 WHERE Nama = '$_GET[Nama]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO monitor (Nama, Alamat, Kategori, Durasi, Total)
										  VALUES ('$_POST[Nama]', 
										  		 '$_POST[Alamat]', 
										  		 '$_POST[Kategori]', 
										  		 '$_POST[Durasi]',
												 '$_POST[Total]'  
												  )
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$tampil = mysqli_query($koneksi, "SELECT * FROM monitor WHERE Nama = '$_GET[Nama]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vnama = $data['Nama'];
				$valamat = $data['Alamat'];
				$vkategori = $data['Kategori'];
				$vdurasi = $data['Durasi'];
				$vtotal = $data['Total']; 
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM monitor WHERE Nama = '$_GET[Nama]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='index.php';
				     </script>";
			}

		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>HALAMAN ADMIN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

	<h1 class="text-center">HALAMAN ADMIN</h1>
	<h2 class="text-center"> Tim Kewirausahaan PSDKU SIDOARJO</h2>

	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Customer
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>Nama</label>
	    		<input type="text" name="Nama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama anda disini!" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Alamat</label>
	    		<input type="text" name="Alamat" value="<?=@$valamat?>" class="form-control" placeholder="Input alamat anda disini!" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Kategori</label>
				<select class="form-control" name="Kategori">
	    			<option value="<?=@$vkategori?>"><?=@$vkategori?></option>
	    			<option value="Pasar">Pasar</option>
	    			<option value="Toko">Toko</option>
	    			<option value="Supermarket">Supermarket</option>
	    		</select>
	    		
	    	</div>
	    	<div class="form-group">
	    		<label>Durasi</label>
	    		<select class="form-control" name="Durasi">
	    			<option value="<?=@$vdurasi?>"><?=@$vdurasi?></option>
	    			<option value="1">1</option>
	    			<option value="7">7</option>
	    			<option value="30">30</option>
	    		</select>
	    	</div>
			<div class="form-group">
			<label>Total</label>
	    		<input type="text" name="Total" value="<?=@$vtotal?>" class="form-control" placeholder="Total Harga" required>
			</div>
	    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Customer
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>No.</th>
	    		<th>Nama</th>
	    		<th>Alamat</th>
	    		<th>kategori</th>
	    		<th>Durasi</th>
	    		<th>Total</th>
	    	</tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from monitor order by Nama desc");
	    		while($data = mysqli_fetch_array($tampil)) :

	    	?>
	    	<tr>
	    		<td><?=$no++;?></td>
	    		<td><?=$data['Nama']?></td>
	    		<td><?=$data['Alamat']?></td>
	    		<td><?=$data['Kategori']?></td>
	    		<td><?=$data['Durasi']?></td>
				<td><?=$data['Total']?></td>
	    		<td>
	    			<a href="index.php?hal=edit&id=<?=$data['Nama']?>" class="btn btn-warning"> Edit </a>
	    			<a href="index.php?hal=hapus&id=<?=$data['Nama']?>" 
	    			   onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
	    		</td>
	    	</tr>
	    <?php endwhile; //penutup perulangan while ?>
	    </table>

	  </div>
	</div>
	<!-- Akhir Card Tabel -->

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>