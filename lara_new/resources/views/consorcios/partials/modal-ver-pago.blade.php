<div x-show="openVerPago" 
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     x-cloak>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Detalle del Pago</h2>
        <p>Si ves esto, el archivo separado está funcionando correctamente.</p>
        
        <button @click="openVerPago = false" 
                class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">
            Cerrar
        </button>
    </div>
</div>