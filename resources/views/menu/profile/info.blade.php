@extends('layout.app')

@section('content')
<div class="flex flex-col h-screen">
    <div class="py-2 flex justify-between mx-2 bg-white ">
        <div class="ms-1">
        <a href="/profile">
            <i class=" text-xl bi bi-arrow-left "></i>
        </a>
        </div>
        <div>
            <p class="font-bold">PROFILE</p>
        </div>
        <div class="">
            <a href="/home">
                <i class="text-xl bi bi-house"></i>
            </a>
        </div>
    </div>
    <div class="bg-white rounded-b-lg mx-1">
        <div class=" flex items-center justify-center w-full mb-2 mt-6">
            <div class="relative border-2 border-[#616060ab] rounded-full h-[130px] w-[130px]">
                @if(auth()->user()->profile_picture == null)
                <img src="{{ asset('images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                @if(auth()->user()->profile_picture != null)
                <img src="{{ asset(auth()->user()->profile_picture ? 'storage/photos/' . auth()->user()->profile_picture : 'images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                <div class="bg-[#92aff1] text-white absolute bottom-0 right-0 text-xl rounded-full size-12 flex items-center justify-center btn btn-[#92aff1] hover:bg-[#92aff1] border-none">
                    <a href="{{ route('edit-profile') }}">
                        <i class="bi bi-camera-fill"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-start">
            <div class="w-full flex flex-row shadow-md"> 
                <div class=" items-center text-2xl justify-center flex w-[50px]">
                    <i class="bi bi-person"></i>
                </div>
                <div class="my-2 px-1 w-full">
                    <p class="font-bold">Nama - <span class="text-slate-200 bg-[#92aff1] rounded-md px-1 text-center font-light ">{{auth()->user()->kategori->name_categories}}</span></p>
                    <p class="font-light text-sm text-slate-500">{{auth()->user()->name}}</p>
                </div>
            </div>
            <div class="w-full flex flex-row shadow-md">
                <div class=" items-center text-xl justify-center flex w-[50px]">
                    <i class="bi bi-telephone"></i>
                </div>
                <div class="my-2 px-1 w-full">
                    <p class="font-bold">No Telepon</p>
                    <p class="font-light text-sm text-slate-500">{{auth()->user()->phone}}</p>
                </div>
            </div>
            <div class="w-full flex flex-row shadow-md">
                <div class=" items-center text-xl justify-center flex w-[50px]">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="my-2 px-1 w-full">
                    <p class="font-bold">Email</p>
                    <p class="font-light text-sm text-slate-500">{{auth()->user()->email}}</p>
                </div>
            </div>
            <div class="w-full flex flex-row shadow-md">
                <div class=" items-center text-xl justify-center flex w-[50px]">
                    <i class="bi bi-book"></i>
                </div>
                <div class="my-2 px-1 w-full">
                    <p class="font-bold">Sekolah/ kampus</p>
                    <p class="font-light text-sm text-slate-500">{{auth()->user()->institution}}</p>
                </div>
            </div>
            <div class="w-full flex flex-row shadow-md">
                <div class=" items-center text-xl justify-center flex w-[50px]">
                    <i class="bi bi-layers"></i>
                </div>
                <div class="my-2 px-1 w-full">
                    <p class="font-bold">Devisi Magang</p>
                    <p class="font-light text-sm text-slate-500">{{auth()->user()->devisi->name_divisions}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection