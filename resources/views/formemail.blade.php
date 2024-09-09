<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Auth::user()->username}}</title>
    @notifyCss
     <style>
           .notify {
    color: white; /* Warna teks */
    padding: 20px 30px; /* Perbesar padding */
    border-radius: 10px; /* Lebih melengkungkan sudut */
    font-size: 1.2rem; /* Ukuran teks lebih besar */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Perbesar bayangan */
      
   
    }
        </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


</head>

<body>

 <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Kirim Email</h3>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="/kirim">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukkan nama lengkap Anda">
                        </div>
                        <div class="form-group mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input class="form-control" id="website" type="text" name="website" placeholder="Masukkan URL website Anda">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input class="form-control" id="email" type="email" name="email" placeholder="Masukkan alamat email Anda">
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">⬅ Back To Dashboard</a>
                            <button type="submit" class="btn btn-primary btn-sm">Kirim Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





      <x-notify::notify />
        @notifyJs
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</body>



</html>
