<div class="overflow-x-auto">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>Data</th>
          <th>Nome</th>
          <th>Convênio</th>
          <th>Usuário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result as $resultado)

        <tr>
          <th>{{$resultado->exam_date}}</th>
          <td>{{$resultado->paciente_name ?? '?'}}</td>
          <td>{{$resultado->convenio ?? '?'}}</td>
          <td>{{$resultado->created_by ?? '?'}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>