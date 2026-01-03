<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>

    <!-- Tailwind + Flowbite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Gastos
        </h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Descripción</th>
                        <th scope="col" class="px-6 py-3">Monto</th>
                        <th scope="col" class="px-6 py-3">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gastos as $gasto)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $gasto->idgasto }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $gasto->descrip }}
                        </td>
                        <td class="px-6 py-4 text-green-600 font-semibold">
                            ${{ number_format($gasto->monto, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $gasto->fecha }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
