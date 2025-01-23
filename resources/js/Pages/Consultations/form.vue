<template>
  <AuthenticatedLayout>
    <form method="POST" @submit.prevent="submitForm" >

     <!-- Header -->
     <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h1 class="text-2xl font-semibold mb-4">Consultation Médicale</h1>
       <!-- Patient Information Form -->
       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="dateCons">
            <i class="fas fa-calendar-alt"></i> Date de Consultation
          </label>
          <input type="date" id="dateCons" v-model="form.dateCons" class="w-full p-2 border rounded-md" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="matricule">Matricule</label>
          <input type="text" id="matricule" v-model="patient.matricule" readonly class="w-full p-2 border rounded-md" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="age">Âge</label>
          <input type="text" id="age" v-model="age" readonly class="w-full p-2 border rounded-md" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="gender">Sexe</label>
          <input type="text" id="gender" v-model="patient.genre" readonly class="w-full p-2 border rounded-md" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="motifs">
            <i class="fas fa-stethoscope"></i> Motif de consultation
          </label>
          <select id="motifs" required class="w-full p-2 border rounded-md" v-model="form.motifs">
            <option value="routine">Visite de routine</option>
            <option value="follow-up">Suivi</option>
            <option value="emergency">Urgence</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="resume">Résumé</label>
          <input type="text" id="resume" v-model="form.raison" class="w-full p-2 border rounded-md" placeholder="Maladie" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2" for="resume">Type</label>
          <select id="motifs" required class="w-full p-2 border rounded-md" v-model="form.type">
            <option  value="Médicale">Médicale</option>
            <option  value="chirurgicale">chirurgicale</option>
            <option  value="Ginéco-Opstétrique">Ginéco-Opstétrique</option>
          </select>
        </div>
      </div>
    </div>

           <!-- Health Metrics and History -->
           <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Allergies Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
              <h2 class="text-xl font-semibold mb-4 flex items-center gap-2"><i class="fas fa-virus text-gray-500"></i> Allergies</h2>
              <ul class="space-y-3">
                <li v-for="(allergie, index) in patient.allergies" :key="index" class="flex justify-between items-center">
                  <span>{{ allergie.name }}</span>
                  <i class="fas fa-file-alt text-gray-500"></i>
                </li>
              </ul>
            </div>
    
            <!-- Lifestyle Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
              <h2 class="text-xl font-semibold mb-4">Mode de vie</h2>
              <ul class="space-y-3">
                <li v-for="(habitude, index) in patient.habitudes" :key="index" class="flex justify-between items-center">
                  <span>{{ habitude.nom }}</span>
                  <i class="fas fa-file-alt text-gray-500"></i>
                </li>
              </ul>
            </div>
          </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-sm">
      <!-- Health Metrics -->
      <div class="bg-blue-50 shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6 text-blue-800">Examen du patient</h2>
        <div class="space-y-5">
          <!-- Poids -->
          <div class="flex items-center">
            <i class="fas fa-weight fa-lg text-blue-500 mr-3"></i>
            <div class="flex-grow">
              <label class="block text-gray-700 font-semibold" for="poids">Poids:</label>
              <input type="number" min="0" v-model="form.poids" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-300" placeholder="Entrez le poids" />
              <span class="ml-2 text-gray-500">Kg</span>
              <span v-if="form.errors.poids" class="text-red-500 text-xs">{{ form.errors.poids }}</span>
            </div>
          </div>
  
          <!-- Température -->
          <div class="flex items-center">
            <i class="fas fa-thermometer-half fa-lg text-blue-500 mr-3"></i>
            <div class="flex-grow">
              <label class="block text-gray-700 font-semibold" for="temperature">Température:</label>
              <input type="number" v-model="form.temperature" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-300" placeholder="Entrez la température" />
              <span class="ml-2 text-gray-500">°C</span>
              <span v-if="form.errors.temperature" class="text-red-500 text-xs">{{ form.errors.temperature }}</span>
            </div>
          </div>
  
          <!-- Taille -->
          <div class="flex items-center">
            <i class="fas fa-arrows-alt fa-lg text-blue-500 mr-3"></i>
            <div class="flex-grow">
              <label class="block text-gray-700 font-semibold" for="taille">Taille:</label>
              <input type="number" v-model="form.taille" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-300" placeholder="Entrez la taille" />
              <span class="ml-2 text-gray-500">cm</span>
              <span v-if="form.errors.taille" class="text-red-500 text-xs">{{ form.errors.taille }}</span>
            </div>
          </div>
  
          <!-- Fréquence cardiaque -->
          <div class="flex items-center">
            <i class="fas fa-heartbeat fa-lg text-blue-500 mr-3"></i>
            <div class="flex-grow">
              <label class="block text-gray-700 font-semibold" for="frequence_cardiaque">Fréquence cardiaque:</label>
              <input type="number" min="0" v-model="form.frequence_cardiaque" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-300" placeholder="Entrez la fréquence" />
              <span class="ml-2 text-gray-500">BPM</span>
              <span v-if="form.errors.frequence_cardiaque" class="text-red-500 text-xs">{{ form.errors.frequence_cardiaque }}</span>
            </div>
          </div>
  
          <!-- Glycémie -->
          <div class="flex items-center">
            <i class="fas fa-syringe fa-lg text-blue-500 mr-3"></i>
            <div class="flex-grow">
              <label class="block text-gray-700 font-semibold" for="glycemie">Glycémie:</label>
              <input type="number" v-model="form.glycemie" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-300" placeholder="Entrez la glycémie" />
              <span class="ml-2 text-gray-500">mg/dL</span>
              <span v-if="form.errors.glycemie" class="text-red-500 text-xs">{{ form.errors.glycemie }}</span>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Medical History / Observations -->
      <div class="bg-red-50 shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6 text-blue-800 flex items-center gap-2">
          <i class="fas fa-book text-blue-500"></i> Observation
        </h2>
        <ul class="space-y-4">
          <li>
            <div class="flex justify-between items-center">
              <label for="poids">Poids (Kg):</label>
              <p v-if="conclusion.poids" class="text-blue-600 font-semibold">{{ conclusion.poids }}</p>
            </div>
          </li>
  
          <li>
            <div class="flex justify-between items-center">
              <label for="temperature">Température (°C):</label>
              <p v-if="conclusion.temperature" class="text-blue-600 font-semibold">{{ conclusion.temperature }}</p>
            </div>
          </li>
  
          <li>
            <div class="flex justify-between items-center">
              <label for="taille">Taille (cm):</label>
              <p v-if="conclusion.taille" class="text-blue-600 font-semibold">{{ conclusion.taille }}</p>
            </div>
          </li>
  
          <li>
            <div class="flex justify-between items-center">
              <label for="frequence_cardiaque">Fréquence cardiaque (BPM):</label>
              <p v-if="conclusion.frequence_cardiaque" class="text-blue-600 font-semibold">{{ conclusion.frequence_cardiaque }}</p>
            </div>
          </li>
  
          <li>
            <div class="flex justify-between items-center">
              <label for="glycemie">Glycémie (mg/dL):</label>
              <p v-if="conclusion.glycemie" class="text-blue-600 font-semibold">{{ conclusion.glycemie }}</p>
            </div>
          </li>

            <li>
              <!-- Consultation Details -->
      <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <label class="block text-gray-700 font-medium mb-2" for="observations">Observations médicales</label>
        <textarea id="observations" v-model="form.diagnostic" required rows="6" class="w-full p-2 border rounded-md" placeholder="Notez les observations du médecin ici..."></textarea>
      </div>
            </li>
          
        </ul>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-xs">
      <!-- Medical History -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 bg-danger-200 "><i class="fas fa-book  text-gray-500"></i><span>Historique Médical</span></h2>
        <ul class="space-y-3">
          <li v-for="(history, index) in patient.historique_medical" :key="index" class="flex justify-between items-center">
            <span>{{ history.date }} - {{ history.maladie }}</span>
            <i class="fas fa-file-alt text-gray-500"></i>
          </li>
        </ul>
      </div>

      
    </div>



    

      <div class="grid grid-cols-1 bg-gray-100 gap-4">
  
        <!-- Section Prescription des Médicaments -->
        <div>
          <h3 class="text-lg font-semibold mb-2">Prescription des Médicaments</h3>
          <!-- Autocomplete pour sélectionner un médicament -->
          <div class="mb-4 mt-3">
            <label for="medicaments" class="block text-sm font-medium text-gray-900">
              <i class="fa fa-capsules"></i> Médicaments
            </label>
            <FloatLabel>
              <AutoComplete v-model="selectedItem" optionLabel="nom"
                class="block w-full bg-white rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6 placeholder:text-gray-400 text-gray-400"
                :suggestions="filteredItems"
                inputId="ac"
                @complete="search"
              />
            </FloatLabel>

            <button class="text-white bg-green-500 rounded-md px-3 py-1 mt-2"
              v-if="selectedItem" @click="addMedicament">
              Ajouter
            </button>
          </div>

          <!-- Liste des médicaments ajoutés avec la quantité -->
          <div v-if="listMedicaments.length" class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Liste des médicaments</h3>
            <table class="table text-center min-w-full bg-white shadow-md rounded-lg overflow-hidden">
              <thead>
                <tr>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Médicament</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Quantité</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Voie D'administration</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Durée (jours)</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Fréquence</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Dosage</th>
                  <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Instruction</th>
                  <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(medicament, index) in listMedicaments" :key="index">
                  <!-- Nom du médicament -->
                  <td>{{ medicament.nom }}</td>
              
                  <!-- Quantité -->
                  <td>
                    <div class="flex flex-column align-center justify-center items-center ">

                    <input type="number" v-model="medicament.quantite"
                      :class="{
                        'block w-20 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true, 
                        'border-red-500': form.errors[`medicaments.${index}.quantite`]
                      }"
                      placeholder="Quantité" min="1" />
                    <span v-if="form.errors[`medicaments.${index}.quantite`]" class="text-center  text-red-500 text-xs">
                      {{ form.errors[`medicaments.${index}.quantite`] }}
                    </span>
                  </div>
                  </td>
              
                  <!-- Voie d'administration -->
                  <td>
                    <div class="flex flex-column align-center justify-center items-center ">

                    <input type="text" v-model="medicament.voieAdministration"
                      :class="{
                        'block w-40 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true,
                        'border-red-500': form.errors[`medicaments.${index}.voieAdministration`]
                      }"
                      placeholder="Ex: Orale" />
                    <span v-if="form.errors[`medicaments.${index}.voieAdministration`]" class="text-center  text-red-500 text-xs">
                      {{ form.errors[`medicaments.${index}.voieAdministration`] }}
                    </span>
                   </div>
                  </td>
              
                  <!-- Durée -->
                  <td>
                    <div class="flex flex-column align-center justify-center items-center ">

                    <input type="number" v-model="medicament.duree" min="1"
                      :class="{
                        'block w-20 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true,
                        'border-red-500': form.errors[`medicaments.${index}.duree`]
                      }"
                      placeholder="Durée" />
                    <span v-if="form.errors[`medicaments.${index}.duree`]" class="text-center text-red-500 text-xs">
                      {{ form.errors[`medicaments.${index}.duree`] }}
                    </span>
                   </div>
                  </td>
              
                  <!-- Fréquence -->
                  <td >
                    <div class="flex flex-column align-center justify-center items-center ">
                      <input type="text" v-model="medicament.frequence"
                        :class="{
                          'block w-20 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true, 
                          'border-red-500': form.errors[`medicaments.${index}.frequence`]
                        }"
                        placeholder="Ex: 2x/jour" />
                      <span v-if="form.errors[`medicaments.${index}.frequence`]" class="text-center  text-red-500 text-xs">
                        {{ form.errors[`medicaments.${index}.frequence`] }}
                      </span>
                    </div>
                  </td>
              
                  <!-- Dosage -->
                  <td class="flex flex-column align-center justify-center items-center ">
                    <input type="text" v-model="medicament.dosage"
                      :class="{
                        'block w-40 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true,
                        'border-red-500 bg-red-500': form.errors[`medicaments.${index}.dosage`]
                      }"
                      placeholder="Ex: 500mg" />
                    <span v-if="form.errors[`medicaments.${index}.dosage`]" class="text-red-500 text-center text-xs">
                      {{ form.errors[`medicaments.${index}.dosage`] }}
                    </span>
                  </td>
              
                  <!-- Instruction -->
                  <td >
                    <div class="flex flex-column align-center justify-center items-center ">

                    <input type="text" v-model="medicament.instruction"
                      :class="{
                        'block w-48 text-center bg-transparent rounded-md py-1 text-center text-gray-900 placeholder:text-xs focus:border-indigo-600 sm:text-sm': true,
                        'border-red-500 bg-red-500': form.errors[`medicaments.${index}.instruction`]
                      }"
                      placeholder="Instruction particulière" />
                    <span v-if="form.errors[`medicaments.${index}.instruction`]" class="text-red-500 text-xs text-center ">
                      {{ form.errors[`medicaments.${index}.instruction`] }}
                    </span>
                  </div>

                  </td>
                  <!-- Action Supprimer -->
                  <td>
                    <button @click="removeMedicament(index)" class="text-red-600">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
              
            </table>
          </div>
        </div>

      </div>
      <div class="shadow-lg bg-white p-4 flex gap-4 justify-center items-center   ">
          <button class="bg-green-400 p-3 rounded-lg">
            <i class="fa fa-save"></i>
              Enregistrer
          </button>
          <button class="bg-yellow-200 p-3  rounded-lg ">
            <i class="fa fa-print"></i>
            Imprimer
        </button>
      </div>
    </form>
  </AuthenticatedLayout>
</template>


<script lang="ts" setup>
  import { ref,onMounted,watch } from "vue";
  import { useForm } from "@inertiajs/vue3";
  import AuthenticatedLayout from "../AuthenticatedLayout.vue";
  import { Doctor, Patient, Consultation, Medicament } from "@/Interfaces";

  onMounted(() => {
    age.value=calculateAge();
  });

  const age=ref(0);
  const props = defineProps<{ specialites: Doctor[]; patient: Patient; medicaments: Medicament[];errors:Object}>();

  const selectedItem = ref(null);
  const filteredItems = ref<Medicament[]>([]);
  const listMedicaments = ref<{ id:number,nom: string; quantite: number; dosage: string; frequence: string; duree: string; voieAdministration: string; instructions: string }[]>([]);

  interface ConclusionData{
    temperature: string | null;
    poids: string | null;
    taille: string | null;
    frequence_cardiaque: string | null;
    glycemie: string | null;
  };


  const form = useForm<Consultation>({
    dateCons: new Date().toISOString().split("T")[0],
    motifs: "",
    raison:"",
    diagnostic: "",
    medicaments: null, 
    medecin_id:  null, 
    patient_id: props.patient.id,
    temperature: null,
    frequence_cardiaque: null,
    saturation_oxygene: null,
    glycemie: null,
    poids:null,
    taille:null,
    type:"Médicale"
});

const conclusion = ref<ConclusionData>({
  temperature: null,
  poids: null,
  taille: null,
  frequence_cardiaque: null,
  glycemie: null,
});


//Observation de chaque examen du patients pour tirer des conclusion:
// Watch sur les inputs pour afficher des conclusions basées sur les valeurs et l'âge
watch([() => form.temperature, () => age.value], ([newTemp, ageValue]) => {
  if (newTemp !== null) {
    if (ageValue < 10 && newTemp < 36) {
      conclusion.value.temperature = "Hypothermie légère chez un enfant.";
    } else if (newTemp < 35) {
      conclusion.value.temperature = "Hypothermie détectée.";
    } else if (newTemp > 42) {
      conclusion.value.temperature = "Hyperthermie détectée.";
    } else {
      conclusion.value.temperature = "Température normale.";
    }
  } else {
    conclusion.value.temperature = null;
  }
});

watch([() => form.poids, () => age.value], ([newPoids, ageValue]) => {
  if (newPoids !== null) {
    if (newPoids < 1) {
      conclusion.value.poids = "Poids insuffisant.";
    } else if (newPoids > 300) {
      conclusion.value.poids = "Obésité morbide.";
    } else if (ageValue < 12 && newPoids > 50) {
      conclusion.value.poids = "Surpoids pour un enfant.";
    } else {
      conclusion.value.poids = "Poids normal.";
    }
  } else {
    conclusion.value.poids = null;
  }
});

watch([() => form.taille, () => age.value], ([newTaille, ageValue]) => {
  if (newTaille !== null) {
    if (newTaille < 30) {
      conclusion.value.taille = "Taille anormalement basse.";
    } else if (newTaille > 300) {
      conclusion.value.taille = "Taille anormalement élevée.";
    } else if (ageValue < 12 && newTaille > 150) {
      conclusion.value.taille = "Taille au-dessus de la moyenne pour un enfant.";
    } else {
      conclusion.value.taille = "Taille dans la norme.";
    }
  } else {
    conclusion.value.taille = null;
  }
});

watch([() => form.frequence_cardiaque, () => age.value], ([newFreq, ageValue]) => {
  if (newFreq !== null) {
    if (newFreq < 30) {
      conclusion.value.frequence_cardiaque = "Bradycardie détectée.";
    } else if (newFreq > 220) {
      conclusion.value.frequence_cardiaque = "Tachycardie détectée.";
    } else if (ageValue < 10 && newFreq > 120) {
      conclusion.value.frequence_cardiaque = "Fréquence cardiaque élevée chez un enfant.";
    } else {
      conclusion.value.frequence_cardiaque = "Fréquence cardiaque normale.";
    }
  } else {
    conclusion.value.frequence_cardiaque = null;
  }
});

watch([() => form.glycemie, () => age.value], ([newGlycemie, ageValue]) => {
  if (newGlycemie !== null) {
    if (newGlycemie < 40) {
      conclusion.value.glycemie = "Hypoglycémie détectée.";
    } else if (newGlycemie > 600) {
      conclusion.value.glycemie = "Hyperglycémie détectée.";
    } else if (ageValue < 10 && newGlycemie > 150) {
      conclusion.value.glycemie = "Glycémie élevée chez un enfant.";
    } else {
      conclusion.value.glycemie = "Glycémie normale.";
    }
  } else {
    conclusion.value.glycemie = null;
  }
});

//Calcule de l'âge
const calculateAge = () => {
  let now = new Date();
  let birth = new Date(props.patient.dateN);
  let age = now.getFullYear() - birth.getFullYear();
  return age;
};

  const submitForm = async () => {
    try {
      form.medicaments=listMedicaments.value
      await form.post("/consultation/insert");
    } catch (error) {
      console.error("Erreur lors de la soumission du formulaire", error);
    }
  };

  //Supprimer médicament 
  const removeMedicament = (index: number) => {
  listMedicaments.value.splice(index, 1);
};

  const search = async (event: any) => {
    const query = event.query.trim().toLowerCase();
    filteredItems.value = query
      ? props.medicaments.filter((medicament) => medicament.nom.toLowerCase().startsWith(query))
      : [...props.medicaments];
  };

  const addMedicament = () => {
  if (selectedItem.value) {
    listMedicaments.value.push({
      id: selectedItem.value.id,
      nom: selectedItem.value.nom,
      quantite: 1,
      dosage: "",
      voieAdministration: "Orale",
      frequence: "",
      duree: "",
      instructions: ""
    });
    selectedItem.value = null;
  }
};
</script>




