<template>
  <TransitionRoot as="template" :show="hiddens">
    <Dialog class="relative z-100000000" @close="closeModal">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10000000 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white  text-left shadow-xl transition-all sm:my-8 p-4" >
              <div class=" flex gap-6 bg-gray-100  p-3 rounded-lg ">
                <div v-if="doctor.photos" class="flex-shrink-0">
                  <img :src="doctor.photos" class="w-64 h-64 object-cover rounded-lg shadow-md" alt="Doctor Photo"/>
                </div>
                <div v-else class="flex-shrink-0">
                  <p class="text-sm text-gray-500">No photo available</p>
                </div>
                <div class="flex flex-col justify-center align-center gap-2">
                  <h1 class="inline-flex items-center px-3 text-xl " style="color:red">Dr.{{ doctor.name }}</h1>
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-purple-800">Médecin {{ doctor.specialite.specialite }}</span>
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-800">Matricule: {{ doctor.matricule }}</span>
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-800">Adresse: {{ doctor.address }}</span>
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-800">Téléphone: {{ doctor.phone }}</span>
                </div>
              </div>
              <div>
                <i class="fas fa-print" @click="print"></i>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>

  </TransitionRoot>

</template>

<script setup lang="ts">
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { defineProps, defineEmits,ref } from "vue";
import { Doctor } from "../../Interfaces/Doctor"
import printJS from 'print-js';

const props = defineProps({
  hiddens: {
    type: Boolean,
    default: false,
  },

  doctor: {
    type: Object as PropType<Doctor>,
    required: true,
  },
});

const emit = defineEmits(['update:hiddens']);
const isvisible=ref(false)

// Fonction pour fermer le modal
const closeModal = () => {
  emit('update:hiddens', false);
};

const print=async()=> {
  await printJS({ printable: 'printable', type: 'html', targetStyles: ['*']});
}

// Fonction pour gérer la désactivation
const deactivate = () => {
  // Logique de désactivation ici
  closeModal();
};
</script>
