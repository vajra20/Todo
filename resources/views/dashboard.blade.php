@extends('layout')
@section('content')
<body>
    {{-- <div class="container m-4"> 
    @if (Session::get('notAllowed'))
                <div class="alert alert-danger">
                    {{ Session::get('notAllowed') }}
                </div>
            @endif
    @if (Session::get('successAdd'))
                <div class="alert alert-success">
                    {{ Session::get('successAdd') }}
                </div>
            @endif
    @if (Session::get('deleted'))
                <div class="alert alert-success">
                    {{ Session::get('deleted') }}
                </div>
            @endif
    @if (Session::get('successUpdate'))
                <div class="alert alert-warning">
                    {{ Session::get('successUpdate') }}
                </div>
            @endif
    @if (Session::get('done'))
                <div class="alert alert-success">
                    {{ Session::get('done') }}
                </div>
            @endif
                
    <div class="headline d-flex justify-content-between align-items-center">
    <div class="h1"> MY TODO'S </div>
        <div class="create"> 
            <a class="link text-reset" href="/create"> + create</a>
        </div>
    </div> 
        <div class="d-inline-flex inline-flex-row pb-4 align-items-center">
            <svg class="bi bi-chat-right-fill text-muted align-items-center" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M14 0a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
        </svg>
      <div class="text-muted px-2 h6 mb-0"> {{$todos->count()}} todos </div> 
      <a href="#">complated</a>
    </div>
    <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th class="tabel text-center col-8" scope="col">List Todo</th>
            <th class="text-center" scope="col" colspan="2">Action</th>
            <th class="text-center" scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($todos as $todo)
            <tr>
            <td class="tabel">{{$todo['description']}}</td>
            <td class="button"><a href="{{route('delete', $todo->id)}}" class="btn btn-danger">DELETE</a></td>
            <td class="button"><a href="/edit/{{$todo['id']}}" class="btn btn-warning">EDIT</a></td>
            {{-- <td class="">{{$todo['status'] == 1 ? 'Complated' : 'On-Process'}}</td> --}}
            {{-- <td class="button"><a href="/dashboard/complated/{{$todo['id']}}" class="btn btn-success">SELESAI</a></td> --}}
        {{-- </tr> --}}
        {{-- @endforeach --}}
        {{-- </tbody> --}}
      {{-- </table> --}}
{{-- </div> --}}
<div class="container"> 
 <div class=" wrapper bg-white shadow fp-3 px-5">
    @if (Session::get('notAllowed'))
                <div class="alert alert-danger">
                    {{ Session::get('notAllowed') }}
                </div>
            @endif
    @if (Session::get('successAdd'))
                <div class="alert alert-success">
                    {{ Session::get('successAdd') }}
                </div>
            @endif
    @if (Session::get('successUpdate'))
                <div class="alert alert-success">
                    {{ Session::get('successUpdate') }}
                </div>
            @endif
            <div class="container bg-white">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="h5">My Todo's</div>
                        <p class="text-muted text-justify">
                            Here's a list of activities you have to do
                        </p>
                        <br>
                        <span>
                            <a href="/create" class="text-success">Create</a> 
                        </span>
                    </div> 
                     <div class="info btn ml-md-4 ml-0">
                        <span class="fas fa-info" title="Info"></span>
                    </div>
                </div> 
                 <div class="work border-bottom pt-3"> 
                     <div class="d-flex align-items-center py-2 mt-1">
                        <div>
                            <span class="text-muted fas fa-comment btn"></span>
                        </div>
                        <div class="text-muted">{{$todos->count()}} todos</div>
                        <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                            data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
                    </div>
                </div> 
     <div id="comments" class="mt-1"> 
        {{-- looping data-data dari compact 'todos' agar dapat ditampilkan per baris datanya --}}
        @foreach ($todos as $todo)    
        <div class="comment d-flex align-items-start justify-content-between">
            <div class="mr-2"></div>
            {{-- cek kalau statusnya 1 (complated), maka yang ditampilin icon biasa yang ga bisa di click --}}
            @if ($todo['status'] == 1)
                <span class="fa-solid fa-bookmark text-secondary btn"></span>
            {{-- kalau statusnya selain dari 1, baru muncul icon checklist yang bisa du click buat update ke complated --}}
            @else
                <form action="/complated/{{$todo['id']}}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="fas fa-circle-check text-primary btn"></button>
                </form>
            @endif
            <div class="d-flex flex-column"> 
                {{-- menampilkan data dinamis/data yang diambil dari database pada blade harus menggunakan {{}} --}}
                {{-- path yang {$id} dikirim data dinamis (data dari database) makanya disitu pake {{}} --}}
                 <a href="/edit/{{$todo['id']}}" class="text-justify" style="text-decoration: none; color:black">
                    {{$todo['title']}}
                </a>
                <p>{{$todo['description']}}</p> 
                {{-- konsep ternary : if column status baris ini isinya 1 bakal munculin teks 'Complated' selain dari itu akan menampilkan teks 'On-Process'--}}
                 <p class="text-muted">
                    {{$todo['status'] == 1 ? 'Complated' : 'On-Process'}} 
                    {{-- Carbon itu package laravel untuk mengelola yang berhubungan dengan data. 
                        Tadinya value column date di database kan bentuknya format 2022-11-22 nah kita pengen ubah bentuk formatnya jadi 
                        22 November, 2022 --}}
                     <span class="date">
                        {{-- kalya statusnya 1 (complated), yang ditampilin itu tanggal kapan dia selesainya yang diambil 
                            dari column date_time yang diisi pas update status nya ke complated--}}
                            @if ($todo['status'] == 1)
                        selesai pada : {{\Carbon\Carbon::parse($todo['date_time'])->format('j F, Y')}}
                        {{-- kalau statusnya masih 0 (on-progress), yang ditampilin tanggal dia dibuat (Data dari column date yang diisi 
                            dari input pilih tanggal di fitur create) --}}
                            @else
                            target selesai : {{\Carbon\Carbon::parse($todo['date'])->format('j F, Y')}}
                            @endif
                        </span>
                </p> 
                 {{-- <a href="{{route('delete', $todo->id)}}" class="btn btn-danger">  --}}
            </div>
           
            <div class="ml-md-4 ml-0">
                <a href="{{route('delete', $todo->id)}}">
                    <span class="close fas fa-close btn"></span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
@endsection