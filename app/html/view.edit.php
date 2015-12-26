<form action="?page=petugas&action=update" method="POST">
	<pre>
		<input type="hidden" name="_id" value="<?php echo $response['id'] ?>">

		<input type="text" name="_name" placeholder="Nama" value="<?php echo $response['name'] ?>" required>

		<input type="text" name="_address" placeholder="Alamat" value="<?php echo $response['address'] ?>" required>

		<input type="text" name="_age" placeholder="Umur" value="<?php echo $response['age'] ?>" required>

		<input type="text" name="_phone" placeholder="Telepon" value="<?php echo $response['phone'] ?>" required>

		<input type="submit" value="Create">
	</pre>
</form>