<a href="?page=petugas&action=create">Create New</a>

<table border="1">
	<tr>
		<td>Nama</td>
		<td>Alamat</td>
		<td>Umur</td>
		<td>Telepon</td>
		<td>Aksi</td>
	</tr>
	<?php foreach ($response as $value): ?>
		<tr>
			<td><?php echo $value['name'] ?></td>
			<td><?php echo $value['address'] ?></td>
			<td><?php echo $value['age'] ?></td>
			<td><?php echo $value['phone'] ?></td>
			<td>
				<a href="?page=petugas&action=edit&id=<?php echo $value['id'] ?>">Edit</a> |
				<a href="?page=petugas&action=delete&id=<?php echo $value['id'] ?>">Delete</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>