 <!--start header-->
 <header class="top-header">
   <nav class="navbar navbar-expand align-items-center gap-4">
     <div class="btn-toggle">
       <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
     </div>
     <ul class="navbar-nav gap-1 nav-right-links align-items-center ms-auto">
       <li class="nav-item dropdown">
         <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
           <img src="{{ URL::asset('build/images/user.png') }}" class="rounded-circle p-1 border" width="45" height="45" alt="">
         </a>
         <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
           <a class="dropdown-item  gap-2 py-2" href="javascript:;">
             <div class="text-center">
               <img src="{{ URL::asset('build/images/user.png') }}" class="rounded-circle p-1 shadow mb-3" width="90" height="90" alt="">
               <h6 class="user-name mb-0 fw-bold">Selamat Datang,</h6>
               <h5 class="user-name mb-0 fw-bold">{{ Auth::user()->name }}</h5>
             </div>
           </a>
           <hr class="dropdown-divider">
           <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit()"><i class="material-icons-outlined">power_settings_new</i>Logout</a>
           <form action="{{ route('logout') }}" method="POST" id="logout-form">
             @csrf
           </form>
         </div>
       </li>
     </ul>

   </nav>
 </header>
 <!--end top header-->