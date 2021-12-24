@extends('layouts.app')

@section('content')
    <div class="justify-content-center">
        <div class="col-md-12">
            <br/>
            <h3 align="center">Importer la liste des militaires déplacés</h3>
            <br/>
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

            @if($message = Session::get('success'))
              <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>{{ $message }}</strong>
              </div>
            @endif

            @if($message = Session::get('error'))
              <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>{{ $message }}</strong>
              </div>
            @endif

            <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
            {{ csrf_field() }}
            <div class="form-group">
             <table class="table">
              <tr>
               <td width="40%" align="right"><label>Veuillez choisir le fichier à télécharger</label></td>
               <td width="30">
                <input type="file" name="select_file" />
               </td>
               <td width="30%" align="left">
                <input type="submit" name="upload" class="btn btn-primary" value="Télécharger">
               </td>
              </tr>
              <tr>
               <td width="40%" align="right"></td>
               <td width="30"><span class="text-muted">.xls, .xslx</span></td>
               <td width="30%" align="left"></td>
              </tr>
             </table>
            </div>
            </form>

            <br/>
            <div class="panel panel-default">
            <div class="panel-heading">
             <h3 class="panel-title">Liste N° @if(isset($liste)) {{ $liste->numero }} @endif</h3>
            </div>
            <div class="panel-body"></div>

            @if(isset($liste))
            <form class="" action="{{route('deplacement.store')}}" method="post">
              @csrf()
              <input type="hidden" name="liste" value="{{$liste->id}}">
              @foreach($liste->sousListes as $key => $sousList)
                  <h4 class="d-flex justify-content-center">Demande d'autorisation pour un déplacement "{{ $sousList->statut->statut }}"</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped">
                      <tr>
                       <th>Prénom</th>
                       <th>Nom</th>
                       <th>Grade</th>
                       <th>CNE</th>
                       <th>Mle</th>
                       <th>S.F</th>
                       <th>Du</th>
                       <th>Au</th>
                       <th>Object de la mission</th>
                       <th>Référence</th>
                       <th>Statut</th>
                      </tr>
                        @foreach($sousList->deplacements as $deplacement)
                          <tr>
                           <td>{{ $deplacement->militaire->prenom }}</td>
                           <td>{{ $deplacement->militaire->nom }}</td>
                           <td>{{ $deplacement->militaire->grade->grade }}</td>
                           <td>{{ $deplacement->militaire->cne }}</td>
                           <td>{{ $deplacement->militaire->matricule }}</td>
                           <td>{{ $deplacement->militaire->marie ? 'M' : 'C' }}</td>
                           <td>{!! Form::dateTime('depart['.$deplacement->id.']', $deplacement->depart(), ['class' => 'form-control', 'onchange' => 'dateDepart(this)', 'data-id' => $deplacement->id]) !!}</td>
                           <td>{!! Form::dateTime('arrivee['.$deplacement->id.']', $deplacement->arrivee(), ['class' => 'form-control', 'onchange' => 'dateArrivee(this)']) !!}</td>
                           <td>{{ $deplacement->mission }}</td>
                           <td>{{ $deplacement->reference }}</td>
                           <td>
                             <select class="form-control" name="statut_id[{{$deplacement->id}}]" id="{{$deplacement->id}}" onchange="statut(this)">
                               @foreach($statuts as $statut)
                                 <option value="{{$statut->id}}">{{$statut->statut}}</option>
                               @endforeach
                             </select>
                           </td>
                          </tr>
                        </div>
                        @endforeach
                </div>
              </table>
            </div>
        @endforeach
        <button class="btn btn-primary pull-right" type="submit">Terminer</button>
      </form>
      @endif
    </div>
  </div>
</div>
@endsection

@include('scripts.import')
