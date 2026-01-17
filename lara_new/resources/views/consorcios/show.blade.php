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


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Consorcio</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="p-6 max-w-7xl mx-auto">
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
    <section class="bg-white rounded-2xl shadow p-6 mb-10">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Gastos a Proveedores</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">+ Nuevo Gasto</button>
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
              <td class="py-2">${{ number_format($gasto->monto, 0, ',', '.') }}</td>
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

    <!-- Pagos a Proveedores -->
    <section class="bg-white rounded-2xl shadow p-6 mb-10">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Pagos a Proveedores</h2>
        <button class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">+ Registrar Pago</button>
      </div>

      <table class="w-full text-sm">
        <thead class="border-b">
          <tr>
            <th class="py-2 text-left">Proveedor</th>
            <th class="py-2 text-left">Forma de Pago</th>
            <th class="py-2 text-left">Referencia</th>
            <th class="py-2 text-left">Monto</th>
            <th class="py-2 text-left">Fecha</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
        @foreach ($consorcio->ListaPagos as $pago)

          <tr class="border-b">
            <td class="py-2">{{ $pago->idproveedor ??  'Proveedor no encontrado' }}</td>
            <td class="py-2">Transferencia</td>
            <td class="py-2">OP-00045</td>
            <td class="py-2">$ 180.000</td>
            <td class="py-2">06/01/2026</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </section>

    <!-- Gastos por Unidad Funcional -->
    <section class="bg-white rounded-2xl shadow p-6 mb-10">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Gastos por Unidad Funcional</h2>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">+ Nuevo Gasto</button>
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
          <tr class="border-b">
            <td class="py-2">UF 3B</td>
            <td class="py-2">Juan Pérez</td>
            <td class="py-2">Expensas</td>
            <td class="py-2">01/2026</td>
            <td class="py-2">$ 45.000</td>
            <td class="py-2 text-red-600">Adeuda</td>
          </tr>
          <tr class="border-b">
            <td class="py-2">UF 5A</td>
            <td class="py-2">María López</td>
            <td class="py-2">Fondo Reserva</td>
            <td class="py-2">01/2026</td>
            <td class="py-2">$ 12.000</td>
            <td class="py-2 text-green-600">Pagado</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Cobros -->
    <section class="bg-white rounded-2xl shadow p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Cobros de Expensas</h2>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded-xl hover:bg-emerald-700">+ Registrar Cobro</button>
      </div>

      <table class="w-full text-sm">
        <thead class="border-b">
          <tr>
            <th class="py-2 text-left">Unidad</th>
            <th class="py-2 text-left">Medio</th>
            <th class="py-2 text-left">Referencia</th>
            <th class="py-2 text-left">Monto</th>
            <th class="py-2 text-left">Fecha</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <tr class="border-b">
            <td class="py-2">UF 5A</td>
            <td class="py-2">Transferencia</td>
            <td class="py-2">TRX-88421</td>
            <td class="py-2">$ 12.000</td>
            <td class="py-2">07/01/2026</td>
          </tr>
        </tbody>
      </table>
    </section>

  </div>

</body>
</html>

</x-app-layout>