<div x-show="openVerPagoParticular" 

class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    x-cloak>
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full overflow-hidden">
        <div class="flex justify-between items-center border-b p-6">
            <h2 class="text-xl font-bold">Editar pago pendiente a proveedor </h2>
            <button type="button" @click="openVerPagoParticular = false" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <template x-if="pagoParticularSeleccionado">
            <form :action="'/pago-particular/' + pagoParticularSeleccionado.gas_par_registro" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="_token" :value="document.querySelector('meta[name=csrf-token]').content">

                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" name="gas_par_registro" x-model="pagoParticularSeleccionado.gas_par_registro">


                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">ID Proveedor</label>
                        <input type="text" name="iduf" x-model="pagoParticularSeleccionado.iduf"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Monto</label>
                        <input type="number" name="importe_total" x-model.number="pagoParticularSeleccionado.gas_par_importe" step="0.01"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descripción</label>
                    <textarea name="gas_par_descripcion" x-model="pagoParticularSeleccionado.gas_par_descripcion"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" rows="3"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Forma de Pago</label>
                        <input type="text" name="gas_par_saldo" x-model="pagoParticularSeleccionado.gas_par_saldo"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Fecha</label>
                        <input type="date" name="fecha" x-model="pagoParticularSeleccionado.gas_par_fecha"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t pt-6 mt-6">
                    <button type="button" @click="pagoParticularSeleccionado = false"
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