<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:triagem::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Módulo Triagem') }}
        </h2>
    </div>

    <div class="p-5 shadow-md rounded-md bg-white text-center justify-items-center">
        <div class="w-full bg-white shadow-md rounded-md text-center">
            
            <div class="overflow-x-auto">
                <table class="table w-full">
                  <!-- head -->
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Paciente</th>
                      <th>Procedimento</th>
                      <th>Contraste</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <th>07/03/2023</th>
                      <td>Cy Ganderton</td>
                      <td>Quality Control Specialist</td>
                      <td>Blue</td>
                      <td>Apl.Contr. / Excluir</td>
                    </tr>

                  </tbody>
                </table>
              </div>

        </div>
    </div>

</body>
