<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi kehadiran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css ">
    <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/assets/theme/images/logo1.png"
        />
    
    <link rel="stylesheet" href="/build/assets/app-DwFqlTgz.css">
    <script src="/build/assets/app-CqflisoM.js"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="assetFrontend/jquery.dataTables.min.css">
    <script src="assetFrontend/jquery-3.6.0.min.js"></script>
    <script src="assetFrontend/jquery.dataTables.min.js"></script>
    <script defer src="assetFrontend/cdn.min.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
body {
    font-family: 'Inter', sans-serif;
}

    /* Style Pagination DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 2px 10px;
    margin: 2px;
    border-radius: 4px;
    background-color: #007bff;
    color: white !important;
    border: none;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #0056b3;
}

.dataTables_length label {
    float: left ;
    margin-bottom: 5px;
}
/* Style Dropdown Show Entries */
.dataTables_length select {
    padding: 6px;
    border-radius: 6px;
    border: 1px solid #ddd;
}



#attendanceTable tbody tr{
    background-color: #ededed !important;
    border-bottom: 1px solid #ddd;
}

#attendanceTable tbody tr:hover {
    background-color: #ddd !important;
}

.bg-pos{
    background-image: url('{{ asset("images/pos.jpg") }}');
    background-size: cover;  /* Membuat gambar menutupi seluruh elemen */
    background-position: center; /* Memastikan gambar berada di tengah */
    background-repeat: no-repeat; /* Mencegah gambar berulang */
}
</style>


</head>
<body>


<div class="md:flex md:justify-center md:relative bg-pos">
<div class="md:absolute md:inset-0 md:bg-black/20 md:backdrop-blur-sm"></div>
    <div class="relative md:w-[540px] bg-[white] sm:w-full">
        @if(Auth::check() && Auth::user()->role === 'intern')
        <div id="container-home" class="h-[100vh] w-[100%]">
            @yield('content')        
        </div>
        @endif
        </div>
</div>
   

</body>
</html>