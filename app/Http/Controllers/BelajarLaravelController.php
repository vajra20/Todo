<?php

namespace App\Http\Controllers;

use App\Models\BelajarLaravel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BelajarLaravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function logout()
    // {
    //     //menghapus history login
    //     Auth::logout();
    //     //mengarahkan ke halaman login lagi
    //     return redirect('/');
    // }

    public function dashboard()
    {
        //ambil data dari table todos dengan model todo
        //all() fungsinya untuk mengambil semua data di table
        //get()-> ambil data
        //filter data di database -> where('column', 'perbandingan', 'value')
        //filter data di table todos yang isi column user_id nya sama dengan 
        //data history login bagian id
        $todos = BelajarLaravel::where('user_id', Auth::user()->id)->get();
        //kirim data yang sudah diambil ke file blade / ke file yang menampilkan halaman
        //kirim melalui compact()
        //isi compact sesuaikan dengan nama variable
        return view("dashboard", compact('todos'), [
            'title' => 'dashboard'
        ]);
    }
    
    public function register()
    {
        return view("register", [
            'title' => 'register'
        ]);
    }
    
    public function index()
    {
        return view("login", [
            'title' => 'login',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function registerAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email'=>'required|email:dns',
            'username'=>'required|min:4|max:8',
            'password'=>'required|min:4',
            'name'=>'required|min:3',
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            //membuat password di database tidak terlihat
            'password' => Hash::make($request->password), 
        ]);

        //redirect kemana setelah berhasil tambah data + dikirim pemberitahuan
        return redirect('/')->with('success','Berhasil menambahkan akun! Silahkan login');
    }
    
    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exists' => 'usernamenya gantilah',
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi',
        ]);

        $user = $request->only('username','password');
        if(Auth::attempt($user)){
            return redirect('/dashboard');
        }else{
            return redirect()->back()->with('error','Gagal login, silahkan cek dan coba lagi!');
        }
    }
    
    public function create()
    {
        return view('create',[
            'title' => 'create',
        ]);
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        //validasi data
        $request->validate([
            'title'=>'required|min:3',
            'date'=>'required',
            'description'=>'required|min:5',
        ],[
            'title.required'=>'titlenya diisi lah',
            'date.required'=>'datenya diisi lah',
            'description.required'=>'descriptionnya diisi lah'
        ]);
        
        //mengirim data ke database table todos dengan model todo
        //'' = nama column di table database
        //$request-> = value attribute name pada input
        //kenapa yang dikirim 5 data? karena table pada database todos membutuhkan 6 column input
        //salah satunya column 'done_time' yang tipenya nullable, karena nullable jadi ga perlu dikirim nilai
        //'user_id' untuk memberitahu data todo ini milik siapa, diambil nelalui fitur Auth
        //'status' tipenya boolean, 0 = belum dikerjakan, 1 = sudah dikerjakan (todonya)
        BelajarLaravel::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        //kalau berhasil diarahin ke halaman todo awal dengan pemberitahuan
        return redirect('/dashboard')->with('successAdd','Berhasil menambahkan data Todo!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BelajarLaravel  $belajarLaravel
     * @return \Illuminate\Http\Response
     */
    public function show(BelajarLaravel $belajarLaravel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BelajarLaravel  $belajarLaravel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampikan halaman input form edit
        //mengambil data satu baris dengan column id sama dengan id dari parameter route
        $todo = BelajarLaravel::where('id', $id)-> first();
        //kirim data yang diambil ke file blade dengan compact
        return view('edit', compact('todo'),[
            'title' => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BelajarLaravel  $belajarLaravel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mengubah data di database
        //validasi
        $request->validate([
            'title'=>'required|min:3',
            'date'=>'required',
            'description'=>'required|min:5',
        ]);
        //cari baris data yang punya id sama dengan data id yang dikirim ke parameter route
        // kalau udah ketemu, update column-column datanya
        BelajarLaravel::where('id',$id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'date'=> $request->date,
            'user_id'=> Auth::user()->id,
            'status'=> 0,
        ]);
        //kalau berhasil, halaman bakal di redirect ulang ke halaman awal todo dengan pesan pemberitahuan
        return redirect('/dashboard/')->with('successUpdate', 'Data todo berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BelajarLaravel  $belajarLaravel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BelajarLaravel $belajarLaravel, $id)
    {
        $todo = BelajarLaravel::findOrfail($id);
        $todo->delete();
        return redirect('/dashboard')->with('successUpdate', 'Data todo berhasil diperbarui');
    }

    public function updateComplated($id)
    {
        //cari data yang mau diubah statusnya jadi 'complated' dan column 'done_time'
        //yang tadinya nullm diisi dengan tanggal sekarang (tanggal ketika data todo di ubah statusnya)
        //karena status boolean, dan 0 itu untuk kondisi todo on-progression, jadi 1 nya untuk kondisi todo complated
        BelajarLaravel::where('id','=', $id)->update([
            'status' => 1,
            'date_time' => \Carbon\Carbon::now(),
        ]);  
        //apabila berhasil, akan dikembalikan ke halaman awal dengan pemberitahuan
        return redirect()->back()->with('done','Todo telah selesai dikerjakan');
    }
}
