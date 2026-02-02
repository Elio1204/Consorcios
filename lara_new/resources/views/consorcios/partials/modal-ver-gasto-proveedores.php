<div x-show="openVerGastoProveedores"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    x-cloak>
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full overflow-hidden">
        <div class="flex justify-between items-center border-b p-6">
            <h2 class="text-xl font-bold">Editar Gasto de Proveedor</h2>
            <button type="button" @click="openVerGastoProveedores = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <template x-if="gastoproveSeleccionado">
            <form :action="'/gastos-proveedores/' + gastoproveSeleccionado.idgasto" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="_token" :value="document.querySelector('meta[name=csrf-token]').content">

                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" name="idgasto" x-model="gastoproveSeleccionado.idgasto">


                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">ID Proveedor</label>
                        <input type="text" name="idproveedor" x-model="gastoproveSeleccionado.idproveedor"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Monto</label>
                        <input type="number" name="monto" x-model.number="gastoproveSeleccionado.monto" step="0.01"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descripción</label>
                    <textarea name="descrip" x-model="gastoproveSeleccionado.descrip"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" rows="3"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Forma de Pago</label>
                        <input type="text" name="medio_pago" x-model="gastoproveSeleccionado.medio_pago"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Fecha</label>
                        <input type="date" name="fecha" x-model="gastoproveSeleccionado.fecha"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t pt-6 mt-6">
                    <button type="button" @click="openVerGastoProveedores = false"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>