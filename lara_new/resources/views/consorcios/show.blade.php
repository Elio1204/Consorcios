<style>
    [x-cloak] { display: none !important; }
</style>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Detalle del Consorcio: {{ $consorcio->nombre }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 shadow sm:rounded-lg">
        <p><strong>ID:</strong> {{ $consorcio->idcons }}</p>
        <!-- <p><strong>Base de datos:</strong> {{ $consorcio->base }}</p> -->
        <hr class="my-4">
        <a href="{{ route('dashboard') }}" class="text-blue-500">Volver al listado</a>
      </div>
    </div>
  </div>

  <div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-3xl font-semibold mb-8">Dashboard del Consorcio</h1>

      <!-- KPIs -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-2xl shadow p-5">
          <p class="text-sm text-gray-500">Unidades Funcionales</p>
          <p class="text-3xl font-bold"> {{ $consorcio->unidadesFuncionales->count() }} </p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
          <p class="text-sm text-gray-500">Proveedores</p>
          <p class="text-3xl font-bold">{{ $consorcio->proveedoresPropios->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
          <p class="text-sm text-gray-500">Gastos pendientes</p>
          <p class="text-3xl font-bold">{{ $consorcio->gastos->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
          <p class="text-sm text-gray-500">Saldo en Caja</p>
          <p class="text-3xl font-bold text-green-600">$ {{ number_format($consorcio->cajas->sum('importe'), 2, ',', '.') }}</p>
        </div>
      </div>

      <!-- Gastos a Proveedores -->
      <section class="bg-white rounded-2xl shadow p-6 mb-10" x-data="{ openModal: false }">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Gastos a Proveedores</h2>
          <button type="button" x-on:click="openModal = true" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">+ Registrar Gasto</button>
        </div>

        <!-- Modal Gasto -->
        <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-on:click="openModal = false">
          <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4" @click.stop>
            <form action="{{ route('proveedore.store') }}" method="POST">
              @csrf
              <input type="hidden" name="idcons" value="{{ $consorcio->idcons }}">

              <!-- Header -->
              <div class="flex justify-between items-center border-b p-6">
                <h3 class="text-lg font-semibold">Registrar Gasto</h3>
                <button type="button" x-on:click="openModal = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
              </div>

              <!-- Body -->
              <div class="p-6 space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-2">Proveedor</label>

                  <input type="text" name="idproveedor" list="prov-list" class="w-full ..." placeholder="Seleccione Proveedor" required>

                  <datalist id="prov-list">
                    @foreach ($consorcio->proveedoresPropios as $prov)
                    <!-- Primer parametro es el objeto, segundo es el campo a mostrar -->
                    <option value="{{ $prov->idproveedor }}">
                      {{ $prov->proveedor->proveedor }}
                    </option>
                    @endforeach
                  </datalist>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Monto</label>
                  <input type="number" name="monto" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Control</label>

                  <input type="text" name="control" list="control-list" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Seleccionar control" required>
                  <datalist id="control-list">
                    @foreach ($consorcio->gastos as $gasto)

                    @if($gasto->controlesInfo)
                    @foreach ($gasto->controlesInfo as $ctr)

                    @if(is_object($ctr))
                    <option value="{{ $ctr->idcontrol }}">
                      {{ $ctr->con_descripcion }}
                    </option>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                  </datalist>

                </div>

                <div>
                  <label class="block text-sm font-medium mb-2">Fecha </label>
                  <input type="date" name="fecha" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
              </div>

              <!-- Footer -->
              <div class="flex justify-end gap-3 border-t p-6">
                <button type="button" x-on:click="openModal = false" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Guardar</button>
              </div>
            </form>
          </div>
        </div>

        <table class="w-full text-sm">
          <thead class="border-b">
            <tr>
              <th class="py-2 text-left">Proveedor</th>
              <!-- <th class="py-2 text-left">Rubro</th> -->
              <th class="py-2 text-left">Control</th>
              <th class="py-2 text-left">Monto</th>
              <th class="py-2 text-left">Estado</th>
              <th class="py-2 text-left">Fecha</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @foreach ($consorcio->gastos as $gasto)
            <tr class="border-b">
              <td class="py-2">{{ $gasto->proveedoresPropios->proveedor ?? 'Proveedor no encontrado' }}</td>
              <!-- <td class="py-2">{{ $gasto->rubro }}</td> -->
              <td class="py-2">{{ $gasto->controlesInfo->con_descripcion ?? 'Control no encontrado' }}</td>
              <td class="py-2">${{ number_format($gasto->monto, 2, ',', '.') }}</td>
              @if ($gasto->liquidado === 's')
              <td class="py-2 text-green-600">Pagado</td>
              @else
              <td class="py-2 text-yellow-600">Pendiente</td>
              @endif
              <td class="py-2">{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </section>










      <!-- Pagos pendientes a Proveedores -->
      <section class="bg-white rounded-2xl shadow p-6 mb-10" x-data="{ openModal: false, openVerPago: false }">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Pagos pendientes a Proveedores</h2>
          <button type="button" x-on:click="openModal = true" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">+ Registrar Pago</button>
        </div>

        <!-- Modal Pago Proveedor -->
        <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-on:click="openModal = false">
          <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4" @click.stop>
            <form action="{{ route('pagos.store') }}" method="POST">
              @csrf
              <input type="hidden" name="idcons" value="{{ $consorcio->idcons }}">

              <!-- Header -->
              <div class="flex justify-between items-center border-b p-6">
                <h3 class="text-lg font-semibold">Registrar Pago a Proveedor</h3>
                <button type="button" x-on:click="openModal = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
              </div>

              <!-- Body -->
              <div class="p-6 space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-2">Proveedor</label>
                  <input type="text" name="idproveedor" list="pago-prov-list" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Seleccione Proveedor" required>
                  <datalist id="pago-prov-list">
                    @foreach ($consorcio->proveedoresPropios as $prov)
                    <option value="{{ $prov->idproveedor }}">
                      {{ $prov->proveedor->proveedor }}
                    </option>
                    @endforeach
                  </datalist>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Monto</label>
                  <input type="number" name="importe_total" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Forma de Pago</label>
                  <input type="text" name="medio_pago" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Ej: Transferencia, Cheque" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Número de Pago</label>
                  <input type="text" name="nro_pago" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Número de referencia" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Fecha</label>
                  <input type="date" name="fecha" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                </div>



              </div>

              <!-- Footer -->
              <div class="flex justify-end gap-3 border-t p-6">
                <button type="button" x-on:click="openModal = false" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Guardar</button>
              </div>
            </form>
          </div>
        </div>

        <table class="w-full text-sm">
          <thead class="border-b">
            <tr>
              <th class="py-2 text-left">Proveedor</th>
              <th class="py-2 text-left">Forma de Pago</th>
              <th class="py-2 text-left">Referencia</th>
              <th class="py-2 text-left">Monto</th>
              <th class="py-2 text-left">Fecha</th>
              <th class="py-2 text-left">Acciones</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @forelse ($consorcio->ListaPagos as $pago)
            <tr class="border-b">
              <td class="py-2">{{ $pago->proveedoresPropios->proveedor ??  'Proveedor no encontrado' }}</td>
              <td class="py-2"> {{ $pago->medio_pago }} </td>
              <td class="py-2"> {{ $pago->nro_pago }}</td>
              <td class="py-2">$ {{ number_format($pago->importe_total, 2, ',', '.') }}</td>
              <td class="py-2"> {{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }} </td>

              <td class="py-2">
                <button @click="openVerPago = true" class="text-blue-600 hover:underline">
                  Ver
                </button>
              </td>

            </tr>
            @empty
            <tr>
              <td colspan="5" class="py-4 text-center text-gray-500 italic">
                No se encontraron pagos registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>

        @include('consorcios.partials.modal-ver-pago')
      </section>










      <!-- Gastos particulares de unidades funcionales -->
      <section class="bg-white rounded-2xl shadow p-6 mb-10" x-data="{ openModal: false }">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Gastos particulares de unidades funcionales</h2>
          <button type="button" x-on:click="openModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">+ Nuevo Gasto</button>
        </div>

        <!-- Modal Gasto Particular -->
        <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-on:click="openModal = false">
          <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4" @click.stop>
            <form action="{{ route('gastos.store') }}" method="POST">
              @csrf
              <input type="hidden" name="idcons" value="{{ $consorcio->idcons }}">

              <!-- Header -->
              <div class="flex justify-between items-center border-b p-6">
                <h3 class="text-lg font-semibold">Nuevo Gasto Particular</h3>
                <button type="button" x-on:click="openModal = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
              </div>

              <!-- Body -->
              <div class="p-6 space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-2">Unidad Funcional</label>
                  <input type="text" name="iduf" list="unidades-particulares-list" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Seleccionar unidad" required>
                  <datalist id="unidades-particulares-list">
                    @foreach ($consorcio->unidadesFuncionales as $unidad)
                    <option value="{{ $unidad->iduf }}">
                      @endforeach
                  </datalist>
                </div>
                <!-- <div>
                  <label class="block text-sm font-medium mb-2">Concepto</label>
                  <input type="text" name="gas_par_descripcion" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Descripción del gasto" required>
                </div> -->
                <div>
                  <label class="block text-sm font-medium mb-2">Monto</label>
                  <input type="number" name="gas_par_importe" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Saldo</label>
                  <input type="number" name="gas_par_saldo" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
              </div>

              <!-- Footer -->
              <div class="flex justify-end gap-3 border-t p-6">
                <button type="button" x-on:click="openModal = false" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Guardar</button>
              </div>
            </form>
          </div>
        </div>

        <table class="w-full text-sm">
          <thead class="border-b">
            <tr>
              <th class="py-2 text-left">Unidad</th>
              <th class="py-2 text-left">Propietario</th>
              <th class="py-2 text-left">Concepto</th>
              <th class="py-2 text-left">Periodo</th>
              <th class="py-2 text-left">Monto</th>
              <th class="py-2 text-left">Estado</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @forelse ($consorcio->gastosParticular as $gasPar)
            <tr class="border-b">
              <td class="py-2">{{ $gasPar->unidadesFuncionales->uf ?? 'N/D' }}</td>
              <td class="py-2">{{ $gasPar->unidadesFuncionales->titular ?? 'N/D' }}</td>
              <td class="py-2">{{ $gasPar->gas_par_descripcion }}</td>
              <td class="py-2">{{ $gasPar->gas_par_fecha }}</td>
              <td class="py-2">$ {{ number_format($gasPar->gas_par_importe, 2, ',', '.') }}</td>
              <td class="py-2 text-red-600">Adeuda</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="py-4 text-center text-gray-500 italic">
                No se encontraron gastos particulares registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </section>

      <!-- Pagos de expensas -->
      <section class="bg-white rounded-2xl shadow p-6 mb-10" x-data="{ openModal: false }">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Pagos de expensas</h2>
          <button type="button" x-on:click="openModal = true" class="bg-emerald-600 text-white px-4 py-2 rounded-xl hover:bg-emerald-700">+ Registrar Cobro</button>
        </div>

        <!-- Modal Cobro -->
        <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-on:click="openModal = false">
          <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4" @click.stop>
            <form action="{{ route('gastos.store') }}" method="POST">
              @csrf
              <input type="hidden" name="idcons" value="{{ $consorcio->idcons }}">

              <!-- Header -->
              <div class="flex justify-between items-center border-b p-6">
                <h3 class="text-lg font-semibold">Registrar Cobro</h3>
                <button type="button" x-on:click="openModal = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
              </div>

              <!-- Body -->
              <div class="p-6 space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-2">Unidad Funcional</label>
                  <input type="text" name="iduf" list="unidades-cobros-list" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Seleccionar unidad" required>
                  <datalist id="unidades-cobros-list">
                    @foreach ($consorcio->unidadesFuncionales as $unidad)
                    <option value="{{ $unidad->iduf }}">{{ $unidad->uf }}</option>
                    @endforeach
                  </datalist>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Monto</label>
                  <input type="number" name="importe_total" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0.00" required>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-2">Número de Pago</label>
                  <input type="text" name="nro_pago" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Número de pago" required>
                </div>
              </div>

              <!-- Footer -->
              <div class="flex justify-end gap-3 border-t p-6">
                <button type="button" x-on:click="openModal = false" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Guardar</button>
              </div>
            </form>
          </div>
        </div>

        <table class="w-full text-sm">
          <thead class="border-b">
            <tr>
              <th class="py-2 text-left">Unidad</th>
              <th class="py-2 text-left">NRO PAGO</th>
              <th class="py-2 text-left">Referencia</th>
              <th class="py-2 text-left">Monto</th>
              <th class="py-2 text-left">Fecha</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @forelse ($consorcio->pagosUnidades as $pago)
            <tr class="border-b">
              <td class="py-2"> {{ $pago->unidadesFuncionales->titular ?? 'Sin identificar' }}</td>
              <td class="py-2"> {{ $pago->nro_pago }}</td>
              <td class="py-2"> Sin Referencia</td>
              <td class="py-2">$ {{ number_format($pago->importe_total, 2, ',', '.') }}</td>
              <td class="py-2"> {{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }} </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="py-4 text-center text-gray-500 italic">
                No se encontraron pagos registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </section>

    </div>
  </div>
</x-app-layout>