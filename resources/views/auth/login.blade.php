<x-guest-layout>

<style>

body{
    background: linear-gradient(135deg,#FFF6ED,#FFE3C6);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Poppins',sans-serif;
}

/* CARD */

.glass-card{
    background:#ffffff;
    border-radius:18px;
    padding:40px;

    width:100%;
    max-width:400px;

    border:1px solid #FFE0C2;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.08);

}

/* TITLE */

.glass-card h2{
    font-weight:700;
    text-align:center;
    color:#CC4E00;
    margin-bottom:5px;
}

.glass-card p{
    text-align:center;
    font-size:14px;
    color:#777;
    margin-bottom:25px;
}

/* INPUT */

.form-control{
    background:#FFF7EF;
    border:1px solid #FFD2A6;
    padding:12px;
    border-radius:10px;
    font-size:14px;
}

.form-control:focus{
    border-color:#F79039;
    box-shadow:0 0 0 3px rgba(247,144,57,0.15);
    background:#fff;
}

/* BUTTON */

.btn-login{
    background:linear-gradient(135deg,#F79039,#FF6A00);
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
    color:white;
    transition:0.3s;
}

.btn-login:hover{
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

/* PASSWORD ICON */

.password-toggle{
    position:absolute;
    top:50%;
    right:15px;
    transform:translateY(-50%);
    cursor:pointer;
    color:#888;
}

.password-toggle:hover{
    color:#F79039;
}

</style>


<div class="glass-card">

<h2>CAIKUE</h2>
<p>Silakan login untuk mengakses sistem</p>

<form method="POST" action="{{ route('login') }}">
@csrf


<!-- EMAIL -->

<div class="mb-3">

<input type="email"
class="form-control @error('email') is-invalid @enderror"
name="email"
value="{{ old('email') }}"
placeholder="Email"
required autofocus autocomplete="username">

<x-input-error :messages="$errors->get('email')" class="mt-2 text-danger"/>

</div>


<!-- PASSWORD -->

<div class="mb-3 position-relative">

<input type="password"
id="password"
class="form-control @error('password') is-invalid @enderror"
name="password"
placeholder="Password"
required autocomplete="current-password">

<span class="password-toggle" onclick="togglePassword()">
<i id="toggleIcon" class="bi bi-eye"></i>
</span>

<x-input-error :messages="$errors->get('password')" class="mt-2 text-danger"/>

</div>


<button type="submit" class="btn btn-login w-100">
Login
</button>

</form>

</div>


<script>

function togglePassword(){

const passwordInput=document.getElementById("password");
const icon=document.getElementById("toggleIcon");

if(passwordInput.type==="password"){
passwordInput.type="text";
icon.classList.remove("bi-eye");
icon.classList.add("bi-eye-slash");
}else{
passwordInput.type="password";
icon.classList.remove("bi-eye-slash");
icon.classList.add("bi-eye");
}

}

</script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</x-guest-layout>