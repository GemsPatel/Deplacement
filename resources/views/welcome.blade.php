@extends('layouts.app')

@section('content')
<div class="container">
  @if($errors->any())
    <div class="alert alert-danger">
      Télécharger des données valide<br><br>
      <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <div class="flex-center position-ref full-height">
      <div class="content">
          <div class="title">
              Upload sheet (Noramal, Absence, Exception) excel file
          </div>
          <form method="POST" action="{{route('upload-excel')}}" enctype="multipart/form-data">
              @csrf
              <input type="file" name="select_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
    <div class="row">
        @foreach($listes as $liste)
          <div class="col-sm-3 mt-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Liste N° {{$liste->numero}}</h5>
              <br>
              Organe ou Unité: {{$liste->organe->organe}}
              <p class="card-text">
                <br>
                Type de Déplacement:
                @foreach($liste->sousListes as $sousList)
                <ul>
                  <li>{{$sousList->statut->statut}}</li>
                </ul>
                @endforeach
              </p>
              <a href="{{route('home.liste', $liste->id)}}" class="btn btn-primary">Visualiser Liste</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
</div>
@endsection
