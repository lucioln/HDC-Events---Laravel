@extends('layouts.main')
@section('title', 'HDC events')
@section('content')

<div id="event-create-container" class="col col-md-6 offset-md-3">
    <h1>Crie seu Evento</h1>
    <form action="/events" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" class="form-control-file " id="image" name="image" placeholder="Exemplo: Curso de Laravel">
        </div>

        <div class="form-group">
            <label for="title">Titulo do Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Exemplo: Curso de Laravel">
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>

        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Exemplo: São Luís - MA">
        </div>

        <div class="form-group">
            <label for="items">Itens de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open-food"> Open-food
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>

        <div class="form-group">
            <label for="private">Evento Privado:</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection
