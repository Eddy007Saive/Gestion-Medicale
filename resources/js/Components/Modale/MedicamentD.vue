<template>
  <TransitionRoot as="template" :show="hiddens">
    <Dialog class="relative z-100000000" @close="closeModal">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity " />
      </TransitionChild>

      <div class="fixed inset-0 z-10000000 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="">
              <div class="bg-white flex-columns gap-6 p-10 rounded-lg ">
                <div class="mb-2">
                    <h1 class="text-bold">Details</h1>
                    <hr>
                </div>
                <div class="flex justify-between p-4  "> 
                  <!-- Photos -->
                  <div v-if="medicament.photos" class="flex-shrink-0">
                    <img :src="medicament.photos" class="w-64 h-64 oject-cover rounded-lg shadow-md" alt="Doctor Photo"/>
                  </div>
                  <div v-else class="flex-shrink-0">
                    <p class="text-sm text-gray-500">No photo available</p>
                  </div>
  
                  <!-- Details -->
                  <div class="flex flex-col justify-center align-center gap-2">
                    <h1 class="inline-flex items-center px-3 py-0.5 rounded-full text-xl font-medium ">{{ medicament.nom }}</h1>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Date de fabrication: {{ medicament.date_fabrication }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Date de Péremption: {{ medicament.date_peremption }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Dosage: {{ medicament.dosage }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Description: {{ medicament.description }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Ingredient: {{ medicament.ingredient }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Fabricant: {{ medicament.fabricant }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Stock dispo: {{ medicament.stock }}</span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium  text-gray-500">Forme :
                      <ul>
                        <li class="text-black" v-for="forme in medicament.formes " :key="forme"> {{ forme.forme }} </li>
                      </ul>
                    </span>
                  </div>
                </div>

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
import { defineProps, defineEmits } from "vue";
import { Medicament } from "../../Interfaces/Medicament"

const props = defineProps({
  hiddens: {
    type: Boolean,
    default: false,
  },

  medicament: {
    type: Object as PropType<Medicament>,
    required: true,
  },
});

const emit = defineEmits(['update:hiddens']);

// Fonction pour fermer le modal
const closeModal = () => {
  emit('update:hiddens', false);
};

// Fonction pour gérer la désactivation
const deactivate = () => {
  // Logique de désactivation ici
  closeModal();
};
</script>
