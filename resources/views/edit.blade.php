@extends('layout')
@section('content')
<div class="container content">  
    <form action="/update/{{$todo['id']}}" method="POST" id="create-form">
        {{-- mengambil dan mengirim data input ke controller yang nantinya diambil oleh Request $request --}}
        {{-- fungsi csrf mengambil dan mengirim data input ke controller yang nantinya diambil oleh Request $request --}}
        @csrf
        {{-- karena di route nya pake method patch sedangkan attribute method di form cuman bisa post/get.
        jadi yang post nya ditimpa --}}
        @method('PATCH')
        @if ($errors->any())
                            <div class="alert alert-danger p-2 ">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        <h3>Edit Todo</h3>
      <fieldset>
          <label for="">Title</label>
          {{-- attribute value fungsinya untuk memasukkan data ke input --}}
          {{-- kenapa datanya harus disimpan di input? karena ini kan fitur edit. kalau
            fitur edit belum tentu semua data column diubah. jadi untuk mengantisipasi
            hal itu tampilin dlu semua data di inputnya baru nantinya pengguna yang
            menentukan data input mana yang mau diubah --}}
          <input value="{{$todo['title']}}" name="title" placeholder="title of todo" type="text">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input value="{{$todo['date']}}" name="date" placeholder="Target Date" type="date">
      </fieldset>
      <fieldset>
        {{-- textarea tidak termasuk input, jadi untuk menampilkan valuenya simpan di tengah tag nya aja --}}
          <label for="">Description</label>
          <textarea name="description" placeholder="Type your descriptions here..." tabindex="5">{{$todo['description']}}</textarea>
      </fieldset>
      <fieldset>
          <button type="submit" id="contactus-submit">Submit</button>
      </fieldset>
      <fieldset>
          <a href="/dashboard/" class="btn-cancel btn-lg btn">Cancel</a>
      </fieldset>
    
    </form>
  </div>
@endsection