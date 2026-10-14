<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Konten</title>
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

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/ckeditor.js"></script>
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/resumablejs@1/resumable.js"></script>

  <?= $this->include('layouts/sidebar_admin') ?>

  <div class="content">
    <header class="text-white flex justify-between items-center py-4 px-6 rounded-b-lg shadow-md" style="background-color: #B16B8E;">
      <div class="flex items-center space-x-4">
        <span class="text-2xl">📚</span>
        <h1 class="text-xl font-semibold tracking-wider">Educational Management</h1>
      </div>

      <div class="relative">
        <i class="fas fa-bell text-2xl"></i>
        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></span>
        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
      </div>
    </header>

    <main class="container mx-auto my-8 px-8">
      <div class="text-gray-500 text-sm mb-2">
        Pages / Educational / <span class="text-gray-800 font-semibold">Tambah Konten Edukasi</span>
      </div>
      <h2 class="text-2xl font-bold mb-6">Tambah Konten Edukasi</h2>

      <div class="bg-white shadow-lg p-8 rounded-lg">
        <form action="<?= base_url('content/store') ?>" method="post" enctype="multipart/form-data">
          <div class="mb-6">
            <label for="type" class="block text-gray-700 font-semibold mb-2">Kategori Konten <span class="text-pink-500">*</span></label>
            <select name="type" id="type" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors" required>
              <option value="">-- Pilih Kategori Konten --</option>
              <option value="Infografis">Infografis</option>
              <option value="Video">Video</option>
              <option value="Audio">Audio</option>
              <option value="Artikel">Artikel</option>
            </select>
          </div>

          <div class="mb-6">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Konten <span class="text-pink-500">*</span></label>
            <input type="text" name="title" id="title" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors" placeholder="Masukkan Judul Konten" required>
          </div>

          <div class="mb-6">
            <label for="category" class="block text-gray-700 font-semibold mb-2">Kategori Topik/Deskripsi Singkat <span class="text-pink-500">*</span></label>
            <input type="text" name="category" id="category" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors" placeholder="Masukkan Kategori Topik/Deskripsi Singkat" required>
          </div>

          <div class="mb-6">
            <label for="body" class="block text-gray-700 font-semibold mb-2">
              Content <span class="text-pink-500">*</span>
            </label>
            <div class="main-container">
              <div class="editor-container editor-container_inline-editor" id="editor-container">
                <div class="editor-container__editor">
                  <div id="editor"></div>
                </div>
              </div>
            </div>
            <textarea name="body" id="body" style="display:none"></textarea>
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

          <div class="mb-6 type-field" id="field-infografis" style="display:none;">
            <label for="infographic" class="block text-gray-700 font-semibold mb-2">Upload Infografis <span class="text-pink-500">*</span></label>
            <label class="file-upload-box block cursor-pointer relative">
              <input type="file" name="infographic" id="infographic" class="hidden" accept=".png,.jpg,.jpeg">
              <div class="flex flex-col items-center" id="infografis-upload-box">
                <i class="fas fa-cloud-upload-alt text-4xl upload-icon"></i>
                <span class="mt-2 text-gray-600">Klik untuk upload file atau drag & drop</span>
                <span class="text-sm text-gray-500">(PNG, JPG, JPEG)</span>
              </div>
              <div id="preview-infografis" class="absolute inset-0 flex items-center justify-center"></div>
            </label>
          </div>

          <div class="mb-6 type-field" id="field-audio" style="display:none;">
  <label class="block text-gray-700 font-semibold mb-2">
    Upload Audio <span class="text-pink-500">*</span>
  </label>
  <div id="audio-dropzone" class="p-4 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer relative">
    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
    <span class="mt-2 text-gray-600">Klik atau drag & drop file audio</span>
    <span class="text-sm text-gray-500">(MP3, WAV, AAC, OGG)</span>
    <input type="hidden" name="audio_path" id="audio_path">
    <div id="audio-progress" class="absolute bottom-2 left-4 text-sm text-gray-700"></div>
  </div>
</div>


          <input type="hidden" name="video_path" id="video_path">

          <div class="mb-6 type-field" id="field-video">
            <label class="block text-gray-700 font-semibold mb-2">
              Upload Video <span class="text-pink-500">*</span>
            </label>
            <div id="video-dropzone" class="p-4 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer relative">
              <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
              <span class="mt-2 text-gray-600">Klik atau drag & drop file video</span>
              <span class="text-sm text-gray-500">(MP4, MOV, AVI, WMV)</span>
              <div id="video-progress" class="absolute bottom-2 left-4 text-sm text-gray-700"></div>
            </div>
          </div>

          <div class="mb-6">
            <label for="thumbnail-input" class="block text-gray-700 font-semibold mb-2">Thumbnail</label>
            <label for="thumbnail-input" class="file-upload-box relative flex items-center justify-center p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-pointer" style="min-height:180px;">
              <div id="thumbnail-upload-box" class="flex flex-col items-center">
                <span id="thumbnail-filename" class="text-gray-500 mb-2">Upload Gambar (PNG, JPG, JPEG)</span>
                <i class="fas fa-upload text-xl"></i>
              </div>
              <input type="file" name="thumbnail" id="thumbnail-input" class="hidden" accept=".png,.jpg,.jpeg">
              <div id="preview-thumbnail" class="absolute inset-0 flex items-center justify-center"></div>
            </label>
          </div>

          <div id="loading-spinner" style="display:none;">
            <i class="fas fa-spinner fa-spin"></i> Uploading...
          </div>

          <div id="video-loading" style="display:none; text-align:center; margin-bottom:16px;">
            <div class="loader"></div>
          </div>
          <style>
            .loader {
              border: 6px solid #f3f3f3;
              border-top: 6px solid #3498db;
              border-radius: 50%;
              width: 36px;
              height: 36px;
              animation: spin 1s linear infinite;
              display: inline-block;
              margin-bottom: 8px;
            }

            @keyframes spin {
              0% {
                transform: rotate(0deg);
              }

              100% {
                transform: rotate(360deg);
              }
            }
          </style>

          <div class="flex justify-end space-x-4 mt-8">
            <a href="<?= base_url('content-management') ?>" class="btn px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors">Batal</a>
            <button type="submit" name="status" value="Draft" class="btn px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition-colors">Save as Draft</button>
            <button type="submit" name="status" value="Published" id="submit-btn" class="btn px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors">Simpan</button>
          </div>
        </form>
      </div>
    </main>
  </div>
  </div>

  <script src="<?= base_url('assets/ckeditor5-builder-46.0.3/main.js') ?>"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {

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
    document.addEventListener("DOMContentLoaded", function() {
      if (document.getElementById('video-dropzone')) {
        var r = new Resumable({
          target: "<?= base_url('upload_chunk') ?>", // URL controller
          chunkSize: 10 * 1024 * 1024, // 10MB per chunk
          simultaneousUploads: 3,
          testChunks: false,
          query: {
            type: 'video'
          },
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        r.assignDrop(document.getElementById('video-dropzone'));
        r.assignBrowse(document.getElementById('video-dropzone'));

        r.on('fileAdded', function(file) {
          r.upload();
        });

        r.on('fileProgress', function(file) {
          var progress = Math.floor(file.progress() * 100);
          document.getElementById('video-progress').innerText = "Progress: " + progress + "%";
        });

        r.on('fileSuccess', function(file, response) {
          // Pastikan response dari server dalam bentuk JSON
          let res = {};
          try {
            res = JSON.parse(response);
          } catch (e) {
            console.error("Response bukan JSON:", response);
            return;
          }

          if (res.file_path) {
            // Simpan ke hidden input biar terkirim ke backend
            document.getElementById('video_path').value = res.file_path;
            document.getElementById('video-progress').innerText = "Upload Selesai!";
          }
        });

        r.on('fileError', function(file, message) {
          document.getElementById('video-progress').innerText = "Error: " + message;
        });
      }
    });
    console.log("Video path:", document.getElementById('video_path'));
  </script>

  <!-- audio -->
   <script>
    if (document.getElementById('audio-dropzone')) {
  var audioUploader = new Resumable({
    target: "<?= base_url('upload_chunk') ?>", // URL controller untuk handle chunk audio
    chunkSize: 10 * 1024 * 1024, // 10MB
    simultaneousUploads: 3,
    testChunks: false,
    query: { type: 'audio' },
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  });

  audioUploader.assignDrop(document.getElementById('audio-dropzone'));
  audioUploader.assignBrowse(document.getElementById('audio-dropzone'));

  audioUploader.on('fileAdded', function(file) {
    audioUploader.upload();
  });

  audioUploader.on('fileProgress', function(file) {
    var progress = Math.floor(file.progress() * 100);
    document.getElementById('audio-progress').innerText = "Progress: " + progress + "%";
  });

  audioUploader.on('fileSuccess', function(file, response) {
    let res = {};
    try {
      res = JSON.parse(response);
    } catch (e) {
      console.error("Response bukan JSON:", response);
      return;
    }
    if (res.file_path) {
      document.getElementById('audio_path').value = res.file_path;
      document.getElementById('audio-progress').innerText = "Upload Audio Selesai!";
    }
  });

  audioUploader.on('fileError', function(file, message) {
    document.getElementById('audio-progress').innerText = "Error: " + message;
  });
}

   </script>

</body>

</html>