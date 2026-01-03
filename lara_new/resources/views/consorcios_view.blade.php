<!DOCTYPE html>
<html lang="en">
<head>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administración de Consorcios') }}
            </h2>
            <a href="#" class="bg-black-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded text-sm">
                + Nuevo Consorcio
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Direccion</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($consorcios as $consorcio)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $consorcio->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 italic">{{ $consorcio->direccion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/gastos/{{ $consorcio->idcons }}" class="text-indigo-600 hover:text-indigo-900">Ver Gastos</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

</body>
</html>