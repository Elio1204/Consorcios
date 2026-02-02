<div x-show="openVerGastoProveedores" 
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     x-cloak>
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full">
        <!-- Header -->
        <div class="flex justify-between items-center border-b p-6">
            <h2 class="text-xl font-bold">Editar gasto proveedores</h2>
            <button type="button" @click="openVerGastoProveedores = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <!-- Body -->
        <template x-if="gastoproveSeleccionado">
            <form @submit.prevent="guardarGastoProveedor" class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Proveedor</label>
                        <input type="text" 
                               x-model="gastoproveSeleccionado.idproveedor" 
                               list="pago-prov-list" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Monto</label>
                        <input type="number" 
                               x-model.number="gastoproveSeleccionado.monto" 
                               step="0.01" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" 
                               placeholder="0.00" 
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descripción</label>
                    <textarea x-model="gastoproveSeleccionado.descrip" 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 rows-3" 
                              rows="3"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Forma de Pago</label>
                        <input type="text" 
                               x-model="gastoproveSeleccionado.medio_pago" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" 
                               placeholder="Ej: Transferencia, Cheque" 
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Archivo</label>
                        <input type="text" 
                               x-model="gastoproveSeleccionado.archivo" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" 
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Fecha</label>
                    <input type="date" 
                           x-model="gastoproveSeleccionado.fecha" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2" 
                           required>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 border-t pt-6 mt-6">
                    <button type="button" 
                            @click="openVerGastoProveedores = false" 
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Guardar
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>