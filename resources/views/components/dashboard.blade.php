<div class="row">
    @role('admin')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $user }}</h3>
                    <p>Total Usuários</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">Ver todos <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $igrejas }}</h3>
                    <p>Total Igrejas</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-church"></i>
                </div>
                <a href="{{ route('admin.igreja.index') }}" class="small-box-footer">Ver todos <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $membros }}</h3>
                    <p>Total Membros</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>
                </div>
                <a href="{{ route('admin.membro.index') }}" class="small-box-footer">Ver todos <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $ministerios }}</h3>
                    <p>Total Ministerios</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-server"></i>
                </div>
                <a href="{{ route('admin.ministerio.index') }}" class="small-box-footer">Ver todos <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endrole
</div>
