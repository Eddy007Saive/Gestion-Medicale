<script setup  lang="ts">
import { defineProps, Ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import {Allergie, Habitude, HistoriqueMedical, Patient} from "../../Interfaces/Patient"
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import {alert} from '@/Services/Alert'
import { error, log } from 'console';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

const open = ref(false)
const openModalHistorique=ref(false)
const openHabitude=ref(false)



// Déclaration des props acceptées par le composant
const props = defineProps<{
  patient: Patient;
}>();

 // Initialiser le formulaire avec useForm
 const form = useForm<Patient>({
    id: null,
    matricule: props.patient.matricule,
    nom: props.patient.nom,
    prenom: props.patient.prenom,
    adresse:  props.patient.adresse,
    email: props.patient.email,
    telephone: props.patient.telephone,
    dateN:  props.patient.dateN,
    photos:  props.patient.photos,
    genre:  props.patient.genre, 
    groupe_sanguin:  props.patient.groupe_sanguin,
    historique_medical:  props.patient.historique_medical,
    allergies:  props.patient.allergies,
    contact_urgence_nom:  props.patient.contact_urgence_nom,
    contact_urgence_telephone:  props.patient.contact_urgence_telephone,
    habitudes: props.patient.habitudes,
    prfs:props.patient.prfs
});

//Form pour l 'allergie '
const allergieForm=useForm<Allergie>({
  id:null,
  name: "",
  description: "",
  patient_id: props.patient.id,
})

//Forme pour l 'historique'
const historiqueForm=useForm<HistoriqueMedical>({
  id:  null,
  maladie: "" ,
  patient_id: props.patient.id,
  date: "", // Format 'YYYY-MM-DD'
  description: "",// Champ optionnel
  encours_traitement: true,
  type: 'Familiale' , // Champ optionnel
  category: 'Médicale' ,// Champ optionnel
  hereditary: true,
  medications: "",// Champ optionnel

})

const habitudeForm=useForm<Habitude>({
  id:null,
  nom: "",
  dateD: "",
  dateF: "",
  patient_id:props.patient.id
})
//Forme pour supprimer Historique médicale
const deleteHForm=useForm<Partial<HistoriqueMedical>>({
  id:  props.patient.id,
})

//Forme pour supprimer Allergie
const deleteAForm=useForm<Partial<Allergie>>({
  id:  props.patient.id,
})

//Forme pour supprimer Habitude
const deleteHaForm=useForm<Partial<Habitude>>({
  id:  props.patient.id,
})


const deleteAllergie=(allergie:Allergie)=>{
  deleteAForm.id=allergie.id
    deleteAForm.get('allergie.delete',{
      onSuccess: () => {
      alert.Success("Allergie supprimé avec succès");
      deleteAForm.reset();
      location.reload();
    },

    })
}

const deleteHistorique=(historique:HistoriqueMedical)=>{
  deleteHForm.id=historique.id
    deleteHForm.get('historique.delete',{
      onSuccess: () => {
      alert.Success("Historique supprimé avec succès");
      deleteHForm.reset();
      location.reload();
    },

    })
}

const deleteHabitude=(habitude:Habitude)=>{
  deleteHaForm.id=habitude.id
    deleteHaForm.get('habitude.delete',{
      onSuccess: () => {
      alert.Success("Mode de vie  supprimé avec succès");
      deleteHaForm.reset();
      location.reload();
    },

    })
}



// Récupérer l'image du patient
const image=form.photos

// État réactif pour gérer l'ouverture du modal de suppression
const hidden: Ref<boolean> = ref(false);

//Ajouter une allergie
const addAllergie=(e:Event)=>{
  allergieForm.post(route('allergie.insert'),{
    onSuccess: () => {
      alert.Success("Allergie ajoutée avec succès");
      allergieForm.reset();
      location.reload();
    },
  })
  
}

//Ajouter un historique
const addHistorique=(e:Event)=>{
  historiqueForm.post(route('historique.insert'),{
    onSuccess: () => {
      alert.Success("Historiqe  ajoutée avec succès");
      // historiqueForm.reset();
    },
  })
}

//Ajouter un historique
const addHabitude=(e:Event)=>{
  habitudeForm.post(route('habitude.insert'),{
    onSuccess: () => {
      alert.Success("Mode de vie  ajoutée avec succès");
      // historiqueForm.reset();
    },
  })
}





</script>
<template>
  <AuthenticatedLayout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md relative overflow-hidden">
      <!-- En-tête du Dossier -->
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
          <div class="bg-orange-500 p-4 rounded-full text-white mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.046 12.046 0 0112 2.5c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8v-.622l-4.5 2.368"></path>
            </svg>
          </div>
          <h2 class="text-2xl font-bold">Dossier du Patient</h2>
        </div>
        <img :src="image" alt="Stethoscope" class="w-20 h-20"/>
      </div>

      <!-- Carte de Patient -->
      <div class="bg-gray-100 p-4 rounded-md shadow-inner">
        <div class="flex items-center mb-4">
          <div class="w-24 h-24 bg-gray-300 rounded-full overflow-hidden mr-4">
            <img :src="image" alt="Photo" class="w-full h-full object-cover"/>
          </div>
          <div>
            <h3 class="text-xl font-bold">{{ form.nom }} {{ form.prenom }}</h3>
            <p class="text-gray-700">{{ form.matricule }}</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Matricule</label>
            <p class="mt-1 text-gray-900">{{ form.matricule }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <p class="mt-1 text-gray-900">{{ form.nom }} {{ form.prenom }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Adresse</label>
            <p class="mt-1 text-gray-900">{{ form.adresse }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <p class="mt-1 text-gray-900">{{ form.email }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
            <p class="mt-1 text-gray-900">{{ form.telephone }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Date de Naissance</label>
            <p class="mt-1 text-gray-900">{{ form.dateN }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Genre</label>
            <p class="mt-1 text-gray-900">{{ form.genre }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Groupe Sanguin</label>
            <p class="mt-1 text-gray-900">{{ form.groupe_sanguin }}</p>
          </div>
          <!-- Contact d'Urgence -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Nom du Contact d'Urgence</label>
            <p class="mt-1 text-gray-900">{{ form.contact_urgence_nom }}</p>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700">Téléphone du Contact d'Urgence</label>
            <p class="mt-1 text-gray-900">{{ form.contact_urgence_telephone }}</p>
          </div>
          <!-- Historique Médical -->
          <div class="col-span-2">
            <div class="flex flex-column items-center justify-between bg-blue-50 p-4 rounded-md shadow mb-4">
              <div class="flex  items-center justify-between mb-2  w-100 ">
                <label class="block text-sm font-medium text-gray-700">Historique Médical</label>
                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600" @click="openModalHistorique=true" >
                  <i class="fas fa-plus"></i>
                </button>

              </div>
              <table class="min-w-full rounded-lg overflow-hidden text-center shadow-lg">
                <thead class="bg-gray-50">
                  <tr>
                    <th>Maladie</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Catégorie</th>
                    <th>Héréditaire</th>
                    <th>Traiter</th>
                    <th>Détails</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(historique, index) in form.historique_medical" :key="index">
                    <td>{{ historique.maladie }}</td>
                    <td>{{ historique.date }}</td>
                    <td>{{ historique.type }}</td>
                    <td>{{ historique.category }}</td>
                    <td>
                      <span v-if="historique.hereditary">Oui</span>
                      <span v-else>Non</span>

                    </td>
                    <td><span v-if="historique.encours_traitement">Oui</span>
                      <span v-else>Non</span></td>

                    <td>{{ historique.description }}</td>
                    <td class="flex justify-center gap-2">
                      <i @click="deleteHistorique(historique)" class="fas fa-trash text-red-200 hover:text-green-700 cursor-pointer"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Allergies -->
          <div class="col-span-2">
            <div class="flex flex-column  bg-red-50 p-4 rounded-md shadow mb-4">
              <div class="flex  items-center justify-between mb-2 ">
                <label class="block text-sm font-medium text-gray-700">Allergies</label>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600"  @click="open=true">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <table class="min-w-full rounded-lg overflow-hidden text-center shadow-lg">
                <thead class="bg-gray-50">
                  <tr>
                    <th>Allergie</th>
                    <th>Détails</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(allergie, index) in form.allergies" :key="index">
                    <td>{{ allergie.name }}</td>
                    <td>{{ allergie.description }}</td>
                    <td class="flex justify-center gap-2">
                      <i @click="deleteAllergie(allergie)" class="fas fa-eye text-green-500 hover:text-green-700 cursor-pointer"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Habitude -->
          <div class="col-span-2">
            <div class="flex flex-column  bg-red-50 p-4 rounded-md shadow mb-4">
              <div class="flex  items-center justify-between mb-2 ">
                <label class="block text-sm font-medium text-gray-700">Mode de vie</label>
                <button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600"  @click="openHabitude=true">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <table class="min-w-full rounded-lg overflow-hidden text-center shadow-lg">
                <thead class="bg-gray-50">
                  <tr>
                    <th>Nom</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(habitude, index) in form.habitudes" :key="index">
                    <td>{{ habitude.nom }}</td>
                    <td>{{ habitude.dateD }}</td>
                    <td>{{ habitude.dateF }}</td>
                    <td class="flex justify-center gap-2">
                      <i @click="deleteHabitude(habitude)" class="fas fa-eye text-green-500 hover:text-green-700 cursor-pointer"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

       
        </div>
      </div>
    </div>

      <!-- Modale pour allergie -->
          <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-100000" @close="open = false">
              <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
              </TransitionChild>
        
              <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                  <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                      <h1 class="font-bold text-xl text-center p-3 ">Ajouter allergie</h1>
                      <hr>
                      <form  class="p-4 "  @submit.prevent="addAllergie">
                              <!-- allergie -->
                        <div class="sm:col-span-4 mb-3 ">
                          <label
                            for="nom"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Nom</label
                          >
                          <div class="mt-2">
                            <div
                              class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                            >
                              <input
                                type="text"
                                required
                                v-model="allergieForm.name"
                                name="nom"
                                id="nom"
                                autocomplete="nom"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                placeholder="Nom"
                              />
                              <div v-if="allergieForm.errors.name">{{ allergieForm.errors.name }}</div>
                            </div>
                          </div>
                        </div>

                        <!-- Nom -->
                  <div class="sm:col-span-4">
                    <label
                      for="nom"
                      class="block text-sm font-medium leading-6 text-gray-900"
                      >Description</label
                    >
                    <div class="mt-2">
                      <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                      >
                        <textarea
                        v-model="allergieForm.description"
                        :name="'allergies_description_'"
                        rows="1"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Décrivez les symptômes et la gravité ici"
                      ></textarea>
                        <div v-if="allergieForm.errors.description">{{ allergieForm.errors.description }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <input type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto" />
                    <button type="button" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="openModalHistorique = false" ref="cancelButtonRef">Fermer</button>
                  </div>
                      </form>
                    </DialogPanel>
                  </TransitionChild>
                </div>
              </div>
            </Dialog>
          </TransitionRoot>

      <!-- Modale pour allergie -->
      <TransitionRoot as="template" :show="openHabitude">
        <Dialog class="relative z-100000" @close="open = false">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
          </TransitionChild>
    
          <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
              <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                  <h1 class="font-bold text-xl text-center p-3 ">Ajouter Mode de vie</h1>
                  <hr>
                  <form  class="p-4 "  @submit.prevent="addHabitude">
                          <!-- allergie -->
                    <div class="sm:col-span-4 mb-3 ">
                      <label
                        for="nom"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Nom</label
                      >
                      <div class="mt-2">
                        <div
                          class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                        >
                          <input
                            type="text"
                            required
                            v-model="habitudeForm.nom"
                            name="nom"
                            id="nom"
                            autocomplete="nom"
                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Nom"
                          />
                          <div v-if="habitudeForm.errors.nom">{{ habitudeForm.errors.nom }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Nom -->
              <div class="sm:col-span-4">
                <label
                  for="nom"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Date de début</label
                >
                <div class="mt-2">
                  <div
                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                  >
                  <input
                  type="date"
                  required
                  v-model="habitudeForm.dateD"
                  name="nom"
                  id="nom"
                  autocomplete="nom"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Date de Début"
                />
              </div>
              <div v-if="habitudeForm.errors.nom">{{ habitudeForm.errors.nom }}</div>
                  <div v-if="allergieForm.errors.description">{{ allergieForm.errors.description }}</div>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label
                  for="nom"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Date de Fin</label
                >
                <div class="mt-2">
                  <div
                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                  >
                  <input
                  type="date"
                  required
                  v-model="habitudeForm.dateF"
                  name="nom"
                  id="nom"
                  autocomplete="nom"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Date de Fin"
                />
              </div>
              <div v-if="habitudeForm.errors.dateF">{{ habitudeForm.errors.dateF }}</div>
                  <div v-if="allergieForm.errors.dateF">{{ allergieForm.errors.dateF }}</div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <input type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto" />
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="openHabitude = false" ref="cancelButtonRef">Fermer</button>
              </div>
                  </form>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>

      <!-- Modale pour Historique -->
      <TransitionRoot as="template" :show="openModalHistorique">
        <Dialog class="relative z-100000" @close="open = false">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
          </TransitionChild>

          <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
              <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                  <h1 class="font-bold text-xl text-center p-3 ">Ajouter Historique Médical</h1>
                  <hr>
                  <form  class="p-4 "  @submit.prevent="addHistorique">
                    <fieldset >
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-green-300 p-4  ">
                        
                       <div>
                           <!--Maladie  -->
                           <div>
                            <label
                              for="'historique_medical_condition_'"
                              class="block text-sm font-medium leading-6 text-gray-900"
                              >Maladie</label
                            >
                            <div class="mt-2">
                              <input
                                v-model="historiqueForm.maladie"
                                name="'historique_medical_condition_'"
                                id="'historique_medical_condition_'"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="Nom de la condition médicale"
                              />
                            </div>
                          </div>
              
                        <!-- Type -->
                        <div>
                          <label
                            for="'historique_medical_date_'"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Type d'Antécédant</label
                          >
                          <div class="mt-2">
                            <select
                              v-model="historiqueForm.type"
                              name="'historique_medical_date_' + index"
                              id="'historique_medical_date_' + index"
                              type="date"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            >
                            <option value="Familiale">Familiale</option>
                            <option value="Personnelle">Personnelle</option>
                          </select>
              
                          </div>
                        </div>
              
                        <!-- Catégorie -->
                        <div>
                          <label
                            for="'historique_medical_date_'"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Catégorie d'Antécédant</label
                          >
                          <div class="mt-2">
                            <select
                              v-model="historiqueForm.category"
                              name="'historique_medical_date_'"
                              id="'historique_medical_date_'"
                              type="date"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            >
                            <option value="Médicale">Médicale</option>
                            <option value="chirurgicale">chirurgicale</option>
                            <option value="Ginéco-Opstétrique">Ginéco-Opstétrique</option>
              
                          </select>
              
                          </div>
                        </div>
              
                         <!-- Diagnostic -->
                         <div>
                          <label
                            for="'historique_medical_date_'"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Date de Diagnostic</label
                          >
                          <div class="mt-2">
                            <input
                              v-model="historiqueForm.date"
                              name="'historique_medical_date_'"
                              id="'historique_medical_date_'"
                              type="date"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                          </div>
                        </div>
                       </div>
              
                  <div>
                     <!-- Hérédité -->
                     <div>
                      <label
                        for="'historique_medical_date_'"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Est -ce Héréditaire ?</label
                      >
                      <div class="mt-2">
                        <select
                          v-model="historiqueForm.hereditary"
                          name="'historique_medical_date_'"
                          id="'historique_medical_date_'"
                          type="date"
                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                        <option value=1>Oui</option>
                        <option value=0>Non</option>
          
                      </select>
          
                      </div>
                    </div>
          
                     <!-- Traitement en cours -->
                     <div>
                      <label
                        for="'historique_medical_date_'"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Le traitement est-il déja terminé ?</label
                      >
                      <div class="mt-2">
                        <select
                          v-model="historiqueForm.encours_traitement"
                          name="'historique_medical_date_'"
                          id="'historique_medical_date_'"
                          type="date"
                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                        <option value=1>Oui</option>
                        <option value=0>Non</option>
          
                      </select>
          
                      </div>
                    </div>
                                      
          
                      <div>
                        <label
                          for="'historique_medical_description_'"
                          class="block text-sm font-medium leading-6 text-gray-900"
                          >Description</label
                        >
                        <div class="flex gap-3 mt-2">
                          <textarea
                            v-model="historiqueForm.description"
                            name="'historique_medical_description_'"
                            id="'historique_medical_description_'"
                            rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Décrivez les détails de l'historique médical ici"
                          ></textarea>
                        </div>
                      </div> 

                      <!-- Liste des medicament -->
                      <div>
                        <label
                          :for="'historique_medical_description_'"
                          class="block text-sm font-medium leading-6 text-gray-900"
                          >Medication</label
                        >
                        <div class="flex gap-3 mt-2">
                          <textarea
                            v-model="historiqueForm.medications"
                            name="'historique_medical_description_' "
                            id="'historique_medical_description_'"
                            rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Décrivez les détails de l'historique médical ici"
                          ></textarea>
                        </div>
                      </div>
                  </div>
              
                        
              
              
                          
                        </div>
                    </fieldset>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <input type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto" />
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="openModalHistorique = false" ref="cancelButtonRef">Fermer</button>
              </div>
                  </form>

                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>


  </AuthenticatedLayout>
</template>

  <style scoped>
  .doctor-list {
    padding: 20px;
  }
  
  h2 {
    margin-bottom: 20px;
  }
  
  .doctor-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
  
  .doctor-info {
    display: flex;
    align-items: center;
  }
  
  .doctor-info i {
    margin-right: 10px;
  }
  
  .doctor-name {
    font-size: 1.2em;
  }
  
  .doctor-actions {
    display: flex;
    gap: 10px;
  }
  
  .action-button {
    background: none;
    border: none;
    cursor: pointer;
    color: #007bff;
    font-size: 1.1em;
  }
  
  .action-button:hover {
    color: #0056b3;
  }
  </style>
  