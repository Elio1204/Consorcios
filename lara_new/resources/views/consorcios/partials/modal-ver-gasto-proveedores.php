<div x-show="openVerGastoProveedores" 
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     x-cloak>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Detalle gasto proveedores</h2>
         
        <template x-if="gastoproveSeleccionado" >
            <div class="space-y-2">
                <p><strong>Monto</strong> $<span x-text="gastoproveSeleccionado.monto"></span> </p>

            </div>
        </template>
        
        <button @click="openVerGastoProveedores = false" 
                class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">
            Cerrar
        </button>
    </div>
</div>