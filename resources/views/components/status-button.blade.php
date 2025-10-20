<div class="col-9 bloco-ativo d-flex mb-3">
    <h5>Status</h5>     
       
    @if ($resume->jobs()->exists())
        {{-- {{dd($resume)}} --}}
        <div class="row">
            <div class="col d-flex">
                <button type="button" class="example-popover btn status-{{ $status }} me-2" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title="Candidato Associado a Vaga" data-bs-content="Para mudar o status é necessário desassociar o candidato da vaga!">
                            {{ ucfirst($status) }}
                </button>
                @if ($resume->status !== 'contratado')
                    <x-button-desassociar-vaga :resume="$resume"/>     
                    
                @endif

            </div>
        </div>
        
    @else   
        <form id="statusForm" action="{{ route($route, $id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="status" id="statusInput" value="{{ $status }}">
            
            <div class="btn-group">

                <!-- Botão principal -->
                <button type="button" class="btn status-{{ $status }}">
                    {{ ucfirst($status) }}
                </button>
                
                <!-- Botão dropdown -->
                <button type="button" class="btn status-{{ $status }} dropdown-toggle dropdown-toggle-split" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                    <svg style="width: 13px;{{ $status == 'processo' ? 'fill:#000' : 'fill:#fff' }}" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 386.257 386.257" style="enable-background:new 0 0 386.257 386.257;" xml:space="preserve">
                        <polygon points="0,96.879 193.129,289.379 386.257,96.879 "></polygon>
                    </svg>
                </button>
                
                <!-- Itens do dropdown -->
                <ul class="dropdown-menu">
                    @foreach($statusOptions as $value => $label)                    
                        <li>
                            <a class="dropdown-item @if($status == $value) active status-{{ $value }} @endif" 
                            href="#" onclick="updateStatus('{{ $value }}')">
                            {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </form>
        
    @endif 
    
</div>

<script>
    function updateStatus(newStatus) {
        document.getElementById('statusInput').value = newStatus;
        document.getElementById('statusForm').submit();
    }

    var popover = new bootstrap.Popover(document.querySelector('.example-popover'), {
        container: 'body'
    })
</script>

<style>
    
.status-ativo,
.status-ativo:hover{
color: #fff;    
background-color: gray !important;
}

.status-ativo.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(94, 94, 94) !important;
}



.status-processo,
.status-processo:hover {
    color: #000; 
background-color: yellow !important;
}
.status-processo.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(228, 228, 0) !important;
}

.status-contratado,
.status-contratado:hover{
    color: #fff; 
background-color: green !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(0, 105, 0) !important;
}


.status-inativo,
.status-inativo:hover{
    color: #fff; 
    background-color: red !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(225, 0, 0) !important;
}


.dropdown-menu.show{
    z-index: 9999;
}
</style>