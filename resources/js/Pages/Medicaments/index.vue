<script setup  lang="ts">
import { defineProps, Ref } from "vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Medicament } from "../../Interfaces/Medicament";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import MedicamentD from "@/Components/Modale/MedicamentD.vue";
import { useForm } from "@inertiajs/vue3";
import { alert } from "@/Services/Alert";
import { error, log } from "console";

// Déclaration des props acceptées par le composant
const props = defineProps<{
  medicaments: Medicament[];
}>();

// Initialiser le formulaire avec useForm
const form = useForm<Medicament>({
  id: null,
  nom: "",
  photos: null, // Nullable in case of no photo
  stock: null,
  prix: null,
  dosage: "",
  ingredient: "",
  date_peremption: "", // Use ISO format YYYY-MM-DD for date
  description: null, // Nullable for optional description
  fabricant: null, // Nullable for optional fabricant
  date_fabrication: null, // Nullable for optional date of fabrication
  type_medicament: null, // Nullable for optional type of medicament
  forme_id: null,
});

// État réactif pour gérer l'ouverture du modal de suppression
const hidden: Ref<boolean> = ref(false);

const selectMedicament: Ref<Medicament | null> = ref(null);

//Afficher le Modal
const showModale = (Medicament: Medicament) => {
  selectMedicament.value = Medicament;
  hidden.value = true;
};

//Modifier le medicament
const editMeedicament = (Medicament: Medicament) => {
  form.id = Medicament.id;
  form.get(route("medicament.edit", Medicament.id));
};

//Supprimer le Médicament
const deleteMedicament = (Medicament: Medicament) => {
  alert
    .confirmation("supprimer")
    .then((result) => {
      if (result.isConfirmed) {
        form.delete(route("medicament.delete", Medicament.id), {
          onFinish: () => {
            form.reset();
            location.reload();
          },
        });
      }
    })
    .catch((error) => console.log(error));
};
</script>
<template>
  <MedicamentD
    :hiddens="hidden"
    :medicament="selectMedicament"
    @update:hiddens="hidden = false"
  ></MedicamentD>
  <AuthenticatedLayout>
    <div class="container mx-auto py-8">
      <div class="flex items-centers w-100 justify-between">
        <h2 class="text-2xl font-semibold">Liste des Médicament</h2>
        <div>
          <Link :href="route('medicament.create')">
            <i class="fas fa-user"></i>
            Ajouter
          </Link>
        </div>
      </div>

      <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">
                Médicament
            </th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">
                Date de Peremption
            </th>
            
            <th
              class="py-2 px-4 text-center text-sm font-semibold text-gray-600"
            >
              Stock
            </th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">
              Formes
            </th>

            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="medicament in medicaments" :key="medicament.id" class="border-b">
            <td class="py-2 px-4">{{ medicament.nom }}</td>
            <td class="py-2 px-4">{{ medicament.date_peremption }}</td>
            <td class="py-2 px-4 text-center">{{ medicament.stock }}</td>
            <td class="py-2 px-4">{{ medicament.formes[0] .forme}}</td>
            <td class="py-2 px-4">
              <button
                @click="showModale(medicament)"
                class="text-blue-500 hover:text-blue-700 mx-1"
              >
                <i class="fas fa-eye"></i>
              </button>
              <button
                @click="editMeedicament(medicament)"
                class="text-green-500 hover:text-green-700 mx-1"
              >
                <i class="fas fa-edit"></i>
              </button>
              <button
                @click="deleteMedicament(medicament)"
                class="text-red-500 hover:text-red-700 mx-1"
              >
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
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
  