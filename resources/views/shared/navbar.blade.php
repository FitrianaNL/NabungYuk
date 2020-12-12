<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('web.index') }}" class="nav-link {{ set_active(['web.*'], 'active') }}">
                            <i class="fe fe-home"></i> Dashboard
                        </a>
                    </li>
   
                    <li class="nav-item">
                            <a href="{{ route('tabungan.index') }}" class="nav-link {{ set_active(['tabungan.*'], 'active') }}">
                            <i class="fe fe-repeat"></i> Tabungan
                        </a>
                    </li>
           
              
                    <li class="nav-item">
                        <a href="{{ route('siswa.index') }}" class="nav-link {{ set_active(['siswa.*'], 'active') }}">
                            <i class="fe fe-users"></i> Mahasiswa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('kelas.index') }}" class="nav-link {{ set_active(['kelas.*'], 'active') }}">
                            <i class="fe fe-box"></i>Jurusan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('periode.index') }}" class="nav-link {{ set_active(['periode.*'], 'active') }}">
                            <i class="fe fe-box"></i> Periode
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>