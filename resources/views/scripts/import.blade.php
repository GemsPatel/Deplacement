<script type="text/javascript">
  function statut(input) {

    id = $(input).val();
    deplacementID = input.id;
    data = {_token: '{{csrf_token()}}', deplacement: deplacementID}

    console.log(data);
    $.ajax({
        url : '{{url('statut')}}/'+id,
        data : data,
        type : 'PUT',
        success : function(xhr) {
          console.log(xhr);
        }
    });
  }

  function dateDepart(input) {

    depart = $(input).val();
    id = $(input).data('id');
    data = {_token: '{{csrf_token()}}', date: depart, id: id};

    $.ajax({
        url : '{{route('deplacement.depart')}}',
        data : data,
        type : 'POST',
        success : function(xhr) {
          console.log(xhr);
        }
    });
  }

  function dateArrivee(input) {

    arrivee = $(input).val();
    id = $(input).data('id');
    data = {_token: '{{csrf_token()}}', date: arrivee, id: id};

    $.ajax({
        url : '{{route('deplacement.arrivee')}}',
        data : data,
        type : 'POST',
        success : function(xhr) {
          console.log(xhr);
        }
    });
  }
</script>
