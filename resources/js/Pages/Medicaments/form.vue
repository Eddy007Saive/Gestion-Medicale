<template>
  <AuthenticatedLayout>
    <form method="POST" @submit.prevent="submitForm" class="p-10 rounded-lg">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border-b border-gray-900/10 pb-12">
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <!-- Nom -->
            <div class="sm:col-span-4">
              <label
                for="username"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Médicament</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    required
                    v-model="form.nom"
                    name="username"
                    id="username"
                    autocomplete="username"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Nom du médicament"
                  />
                  <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
              </div>
            </div>

            <!-- Nom -->
            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                  >Stock</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                  min="0"
                    type="number"
                    required
                    name="adress"
                    id="adress"
                    v-model="form.stock"
                    autocomplete="adress"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Stock de médicament"
                  />
                  <div v-if="form.errors.stock">
                    {{ form.errors.stock }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Nom -->
            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Priix</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="email"
                    required
                    name="adress"
                    id="adress"
                    v-model="form.prix"
                    autocomplete="Prix"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Prix"
                  />
                  <div v-if="form.errors.prix">{{ form.errors.prix }}</div>
                </div>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="country"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Forme</label
              >
              <div class="mt-2">
                <select
                  id="country"
                  required
                  name="Spécilaité"
                  autocomplete="Spécilaité-name"
                  v-model="form.specialite_id"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                >
                  <option
                    v-for="forme in formes"
                    :key="forme.id"
                    :value="forme.id"
                  >
                    {{ forme.forme }}
                  </option>
                </select>
                <div v-if="form.errors.forme">
                  {{ form.errors.forme }}
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Dosage</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    name="telephone"
                    v-model="form.dosage"
                    id="telephone"
                    autocomplete="telephone"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Dosage"
                  />
                  <div v-if="form.errors.dosage">{{ form.errors.dosage }}</div>
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Ingrédient</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                <textarea  v-model="form.ingredient" class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" cols="30" rows="10" placeholder="ingredient"></textarea>

                  <div v-if="form.errors.ingredient">{{ form.errors.ingredient }}</div>
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Date de peremption</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="date"
                    name="telephone"
                    v-model="form.date_peremption"
                    id="telephone"
                    autocomplete="telephone"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Tel"
                  />
                  <div v-if="form.errors.date_peremption">{{ form.errors.date_peremption }}</div>
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Date de fabrication</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="date"
                    name="telephone"
                    v-model="form.date_peremption"
                    id="telephone"
                    autocomplete="telephone"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Tel"
                  />
                  <div v-if="form.errors.date_peremption">{{ form.errors.date_peremption }}</div>
                </div>
              </div>
            </div>


            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Fabricant</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    name="telephone"
                    v-model="form.fabricant"
                    id="telephone"
                    autocomplete="telephone"
                    class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Fabricant du médicament"
                  />
                  <div v-if="form.errors.fabricant">{{ form.errors.fabricant }}</div>
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="about"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Description</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >

                <textarea  v-model="form.description" class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" cols="30" rows="10" placeholder="Description"></textarea>
                  <div v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
              </div>
            </div>

           
          </div>
        </div>

        <div class="">
          <div class="bg-white rounded-lg shadow">

            <div
              class="col-span-full flex bg-white flex-column justify-center items-center"
            >
              <div class="mt-2 flex items-center gap-x-3">
                <img
                  :src="image"
                  class="w-64 h-64 oject-cover rounded-lg shadow-md"
                />
              </div>
            </div>
  
            <div class="col-span-full">
              <label
                for="cover-photo"
                class="block text-sm text-center font-medium leading-6 text-gray-900"
                >Image</label
              >
              <div
                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
              >
                <div class="text-center">
                  <PhotoIcon
                    class="mx-auto h-12 w-12 text-gray-300"
                    aria-hidden="true"
                  />
                  <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label
                      for="file-upload"
                      class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                    >
                      <span>Télécharger photos</span>
                      <input
                        id="file-upload"
                        name="file-upload"
                        type="file"
                        class="sr-only"
                        @change="afficherImage"
                        @input="form.photos = $event.target.files[0]"
                      />
                      email
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs leading-5 text-gray-600">
                    PNG, JPG, GIF up to 10MB
                  </p>
                  <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress>
                  <div v-if="form.errors.photos">{{ form.errors.photos }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button
          type="button"
          class="text-sm font-semibold leading-6 text-gray-900"
        >
          Annuler
        </button>
        <button
          type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Enregistrer
        </button>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
  
  <script lang="ts" setup>
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Medicament } from "@/Interfaces/Medicament";
import { Forme } from "@/Interfaces/Forme";
import { defineProps, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
  formes: Forme[];
}>();

let image = ref();

// Initialiser le formulaire avec useForm
const form = useForm<Medicament>({
  id: null,
  nom: "",
  photos: null, 
  stock: null,
  prix: null,
  dosage: "",
  ingredient: "",
  date_peremption: "", 
  description: null, 
  fabricant: null, 
  date_fabrication: null,
  type_medicament: null,
  forme_id: null,
});

// Fonction asynchrone pour soumettre le formulaire
const submitForm = async () => {
  try {
    // Attendre la soumission du formulaire
    await form.post("/medicament/insert");

    // form.reset();
  } catch (error) {
    // Gérer les erreurs de soumission
    console.error("Erreur lors de la soumission du formulaire", error);
  }
};

//Afficher l'image à chaque Sélection
const afficherImage = async (event: any) => {
  const file = event.target.files[0];
  if (file) {
    image.value = URL.createObjectURL(file);
  }
};
</script>