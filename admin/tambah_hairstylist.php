<form action="proses_hairstylist.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Nama Hairstylist" required class="border p-2 w-full mb-3">

  <input type="text" name="title" placeholder="Jabatan (Senior / Master)" class="border p-2 w-full mb-3">

  <input type="file" name="photo" accept="image/*" required class="mb-3">

  <button class="bg-pink-600 text-white px-4 py-2 rounded">
    Simpan
  </button>
</form>
