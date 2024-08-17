<script setup  lang="ts">
import { defineProps, Ref } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import {Doctor} from "../../Interfaces/Doctor"
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import DoctorD from "@/Components/Modale/Doctor.vue"
import { useForm } from "@inertiajs/vue3";
import {alert} from '@/Services/Alert'
import { error, log } from 'console';

// Déclaration des props acceptées par le composant
const props = defineProps<{
  doctors: Doctor[];
}>();

 // Initialiser le formulaire avec useForm
 const form = useForm<Doctor>({
          id: null,
          name: "",
          phone: "",
          address: "",
          email: "",
          photos: null,
          specialite_id: null,
          matricule: "",
        });

// État réactif pour gérer l'ouverture du modal de suppression
const hidden: Ref<boolean> = ref(false);

const selectedDoctor: Ref<Doctor | null> = ref(null);


//Afficher le Modal
const showModale=(doctor:Doctor)=>{
  selectedDoctor.value=doctor
  hidden.value=true;
}

//Modifier le docteur
const editDoctor=(doctor:Doctor)=>{
  form.id=doctor.id
  form.get(route('doctor.edit',doctor.id))
}

//Supprimer le docteur
const deleteDoctor=(doctor:Doctor)=>{
  alert.confirmation("supprimer").then(result=>{
    if(result.isConfirmed){
      form.delete(route('doctor.delete',doctor.id), {
        onFinish: () => {
          form.reset();
          location.reload();
        },
      });
    }
  }).catch(error=>console.log(error))
}





</script>
<template>
    <AuthenticatedLayout >
      <DoctorD :hiddens="hidden"  :doctor="selectedDoctor" @update:hiddens="hidden =false"  ></DoctorD>
      <div class="container mx-auto py-8">
        <div class="flex items-centers  w-100 justify-between  ">
          <h2 class="text-2xl font-semibold ">Liste des Médecins</h2>
          <div>
            <Link :href="route('doctor.create')" >
              <i class="fas fa-user"></i>
              Ajouter
            </Link>
          </div>
        </div>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-gray-50">
            <tr>
              <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Matricule</th>
              <th class="py-2 px-4 text-center text-sm font-semibold text-gray-600">Nom</th>
              <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Spécialité</th>

              <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="doctor in doctors" :key="doctor.id" class="border-b">
              <td class="py-2 px-4">{{ doctor.matricule }}</td>
              <td class="py-2 px-4  text-center">{{ doctor.name }}</td>
              <td class="py-2 px-4">{{ doctor.specialite.specialite }}</td>

              <td class="py-2 px-4">
                <button @click="showModale(doctor)" class="text-blue-500 hover:text-blue-700 mx-1">
                  <i class="fas fa-eye"></i>
                </button>
                <button @click="editDoctor(doctor)" class="text-green-500 hover:text-green-700 mx-1">
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteDoctor(doctor)" class="text-red-500 hover:text-red-700 mx-1">
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
  