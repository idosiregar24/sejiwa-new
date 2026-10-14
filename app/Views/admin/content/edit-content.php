<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-management.css') ?>">
		<link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/96x96.png" sizes="96x96">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/120x120.png" sizes="120x120">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/152x152.png" sizes="152x152">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/167x167.png" sizes="167x167">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/180x180.png" sizes="180x180">
		<link rel="stylesheet" href="./style.css">
		<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.0.3/ckeditor5.css" crossorigin>

  <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-form.css') ?>">

   <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/ckeditor.js"></script>
    <!-- CSS terpisah -->
    <link rel="stylesheet" href="styles.css">

</head>
<body>

  <!-- Sidebar -->
  <?= $this->include('layouts/sidebar_admin') ?>

  <div class="content">
    <!-- Header -->
    <header class="text-white flex justify-between items-center py-4 px-6 rounded-b-lg shadow-md" style="background-color: #B16B8E;">
        <!-- Kotak kiri dengan icon dan judul -->
        <div class="flex items-center space-x-4">
            <span class="text-2xl">📚</span>
            <h1 class="text-xl font-semibold tracking-wider">Educational Management</h1>
        </div>

        <!-- Kotak kanan dengan icon notifikasi -->
        <div class="relative">
            <i class="fas fa-bell text-2xl"></i>
            <!-- Lingkaran kecil notifikasi -->
            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></span>
            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
        </div>
    </header>

    <main class="container mx-auto my-8 px-6">
  <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 mb-4">
      Pages / Educational / <span class="text-gray-800 font-semibold">Edit Konten Edukasi</span>
    </div>

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
      ✏️ <span class="ml-2">Edit Konten Edukasi</span>
    </h2>

    <form action="<?= base_url('content/update/'.$content['id']) ?>" method="post" enctype="multipart/form-data">

      <!-- Kategori -->
      <div class="mb-6">
        <label for="type" class="block text-gray-700 font-semibold mb-2">Kategori Konten <span class="text-pink-500">*</span></label>
        <select name="type" id="type"
          class="form-select w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-pink-400">
          <option value="Infografis" <?= $content['type']=='Infografis'?'selected':'' ?>>Infografis</option>
          <option value="Video" <?= $content['type']=='Video'?'selected':'' ?>>Video</option>
          <option value="Audio" <?= $content['type']=='Audio'?'selected':'' ?>>Audio</option>
          <option value="Artikel" <?= $content['type']=='Artikel'?'selected':'' ?>>Artikel</option>
        </select>
      </div>

      <!-- Judul -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Judul Konten <span class="text-pink-500">*</span></label>
        <input type="text" name="title" value="<?= esc($content['title']) ?>"
          class="form-control rounded-lg border-gray-300 focus:ring-2 focus:ring-pink-400">
      </div>

      <!-- Deskripsi -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Kategori Topik/Deskripsi Singkat</label>
        <input type="text" name="category" value="<?= esc($content['category']) ?>"
          class="form-control rounded-lg border-gray-300 focus:ring-2 focus:ring-pink-400">
      </div>

      <!-- CKEditor -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Content <span class="text-pink-500">*</span></label>
        <div id="editor" class="border rounded-lg"></div>
        <textarea name="body" id="body" class="hidden"><?= esc($content['body']) ?></textarea>
      </div>
      <script src="https://cdn.ckeditor.com/ckeditor5/46.0.3/ckeditor5.umd.js" crossorigin></script>
                    <script>
                    let editorInstance;
                    ClassicEditor.create(document.querySelector('#editor'))
                      .then(editor => {
                        editorInstance = editor;
                      });

                    document.querySelector('form').addEventListener('submit', function(e) {
                      if (editorInstance) {
                        document.getElementById('body').value = editorInstance.getData();
                      }
                    });
        </script>


      <!-- Thumbnail -->
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Thumbnail</label>
        <?php if(!empty($content['thumbnail'])): ?>
          <div class="mb-3">
            <img src="<?= base_url('uploads/thumbnail/'.$content['thumbnail']) ?>"
                 class="rounded-lg shadow-md max-h-40">
          </div>
        <?php endif; ?>
        <input type="file" name="thumbnail"
          class="form-control border-gray-300 rounded-lg">
      </div>

      

      <!-- Tombol -->
      <div class="flex justify-end space-x-4 mt-6">
        <a href="<?= base_url('content-management') ?>"
           class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
          Batal
        </a>
        <button type="submit" name="status" value="Draft"
           class="px-5 py-2.5 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
          Simpan Draft
        </button>
        <button type="submit" name="status" value="Published"
           class="px-5 py-2.5 bg-pink-500 text-white rounded-lg hover:bg-pink-600 shadow">
          Publish
        </button>
      </div>
    </form>
  </div>
</main>

    </div>
  </div>

<script src="<?= base_url('assets/ckeditor5-builder-46.0.3/main.js') ?>"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  // Toggle upload field sesuai kategori konten
  const typeSelect = document.getElementById("type");
  const fields = document.querySelectorAll(".type-field");

  function toggleFields() {
  fields.forEach(field => field.style.display = "none");
  const selected = typeSelect.value.toLowerCase();
  if (selected === "infografis") {
    document.getElementById("field-infografis").style.display = "block";
  } else if (selected === "video") {
    document.getElementById("field-video").style.display = "block";
  } else if (selected === "audio") {
    document.getElementById("field-audio").style.display = "block";
  }
}

  typeSelect.addEventListener("change", toggleFields);
  toggleFields();


  // Preview Infografis
const infografisInput = document.getElementById('infographic');
const previewInfografis = document.getElementById('preview-infografis');
const infografisBox = document.getElementById('infografis-upload-box');
if (infografisInput) {
  infografisInput.addEventListener('change', function(e) {
    previewInfografis.innerHTML = '';
    infografisBox.style.opacity = '1';
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        previewInfografis.innerHTML = `
          <img src="${ev.target.result}" class="preview-img" />
          <button type="button" class="remove-preview" title="Hapus" onclick="removePreview('infographic', 'preview-infografis', 'infografis-upload-box')">&times;</button>
        `;
        infografisBox.style.opacity = '0.2';
      }
      reader.readAsDataURL(file);
    }
  });
}

// Preview Thumbnail
const thumbnailInput = document.getElementById('thumbnail-input');
const previewThumbnail = document.getElementById('preview-thumbnail');
if (thumbnailInput) {
  thumbnailInput.addEventListener('change', function(e) {
    previewThumbnail.innerHTML = '';
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        previewThumbnail.innerHTML = `
          <img src="${ev.target.result}" class="preview-img" />
          <button type="button" class="remove-preview" title="Hapus" onclick="removePreview('thumbnail-input', 'preview-thumbnail')">&times;</button>
        `;
      }
      reader.readAsDataURL(file);
    }
  });
}

// Fungsi hapus preview
window.removePreview = function(inputId, previewId, boxId) {
  document.getElementById(inputId).value = '';
  document.getElementById(previewId).innerHTML = '';
  if (boxId) document.getElementById(boxId).style.opacity = '1';
}
});

//Fungsi Loader
document.querySelector('form').addEventListener('submit', function(e) {
  const type = document.getElementById('type').value;
  if (type === 'Video') {
    document.getElementById('video-loading').style.display = 'block';
  }
});

</script>
<script>
document.getElementById('video-upload-label').addEventListener('click', function(e) {
    if (e.target.id !== 'video') {
        document.getElementById('video').click();
    }
});
const videoInput = document.getElementById('video');
const previewVideo = document.getElementById('preview-video');
const videoBox = document.getElementById('video-upload-box');
if (videoInput) {
  videoInput.addEventListener('change', function(e) {
    previewVideo.innerHTML = '';
    videoBox.style.opacity = '1';
    const file = e.target.files[0];
    if (file && file.type.startsWith('video/')) {
      const url = URL.createObjectURL(file);
      previewVideo.innerHTML = `
        <video src="${url}" controls class="preview-video" style="max-width:100%;max-height:120px;"></video>
        <button type="button" class="remove-preview" title="Hapus" onclick="removePreview('video', 'preview-video', 'video-upload-box')">&times;</button>
      `;
      videoBox.style.opacity = '0.2';
    }
  });
}
</script>

</body>

</html>
