<nav>
    <i class='bx bx-menu'></i>
    <a href="#" class="nav-link">Categories</a>
    <form action="#"   style="visibility: hidden;"  >
        <div class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
    </form>

    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>
                                
    
    <a href="/DoctorProfile" class="profile" >
        <img   alt="Doctor Image"
        src="{{ asset('DoctorImages') }}/{{ session('doctor_login')->doc_image }}" >
    </a>

</nav>
