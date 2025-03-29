@extends('layout.app')

@section('content')
<div class="h-screen">
    <div class="py-2 bg-white flex justify-between mx-2">
        <div>
            <a href="/home">
                <i class=" text-xl bi bi-arrow-left "></i>
            </a>
        </div>
        <div>
            <p class="font-bold">PENGATURAN</p>
        </div>
        <div class="">
            <a href="/home">
                <i class="text-xl bi bi-house"></i>
            </a>
        </div>
    </div>
    <div class="flex justify-between px-2 py-3 bg-white items-center shadow-md shadow-slate-400/50">
        <div class="flex justify-around gap-2">
            <div>
                <div class="rounded-full border border-slate-700 h-[50px] w-[50px]">
                @if(auth()->user()->profile_picture == null)
                <img src="{{ asset('images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                @if(auth()->user()->profile_picture != null)
                <img src="{{ asset(auth()->user()->profile_picture ? 'storage/photos/' . auth()->user()->profile_picture : 'images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                </div>
            </div>
            <div class="text-black whitespace-nowrap">
                <p class="font-bold">{{auth()->user()->name}}</p>
                <p class="font-light text-sm text-[#2b2b2bdd] ">{{auth()->user()->kategori->name_categories}}</span></p>
            </div>
        </div>
        <div class="text-2xl text-white">
            <!-- The button to open modal -->
             <a href="{{ route('edit-profile') }}"> 
                 <label for="btn"><i class="bi bi-pencil-square text-[#537FE7] cursor-pointer "></i></label>
             </a>
        </div>
    </div>
    <div class="mt-2">
        <div class="py-4 font-bold text-slate-700 bg-white shadow-md shadow-slate-400/50  px-5">
            <a href="/info-profile">
                <p><i class="me-3 bi bi-person-circle"></i><span> Profile</span></p>
            </a>
        </div>
        <div class="py-4 font-bold text-slate-700 bg-white shadow-md shadow-slate-400/50  px-5">
            <a href="{{ route('attendance.history') }}">
                <p><i class="me-3 bi bi-clock-history"></i><span> Riwayat</span></p>
            </a>
        </div>
        <div class="py-4 font-bold text-slate-700 bg-white shadow-md shadow-slate-400/50  px-5">
            <a href="/change-pw"><i class="me-3 bi bi-key"></i><span> Ganti Sandi</span></a>
        </div>
        <!-- <div class="py-4 font-bold text-slate-700 bg-white shadow-md shadow-slate-400/50  px-5">
            <a href=""><i class="me-3 bi bi-file-earmark-text   "></i><span> Izin</span></a>
        </div> -->
    </div>
    <div class="mt-auto p-4">
        <label for="my_modal_logout" class="btn btn-error w-full text-white">Keluar</label>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_logout" class="modal-toggle" />
    <div class="modal" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hello!</h3>
        <p class="py-4">apakah anda yakin ingin keluar</p>
        <div class="modal-action text-sm">
        <label for="my_modal_logout" class="btn">batal</label>
        <a href="/logout"><button class="btn btn-error">keluar</button></a>
        </div>
    </div>
    </div>
    <!-- end modal logout -->
</div>
@endsection