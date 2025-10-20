<form action="{{ route('interviews.desassociarVaga') }}" method="POST" style="display:inline;" 
      onsubmit="return confirm('Tem certeza que deseja desassociar este currículo?')">
    @csrf    
    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
    <button type="submit" class="btn btn-danger btn-sm" style="height: 100%">Desassociar</button>
</form>