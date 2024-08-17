<template>
  <AuthenticatedLayout>
    <form method="POST" @submit.prevent="submitForm" class="p-10 rounded-lg">
      {{ form.errors }}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-base font-semibold leading-7 text-gray-900">
            Profil du Patient
          </h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">
            Les informations seront utilisées pour la gestion du patient.
          </p>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <!-- Nom -->
            <div class="sm:col-span-4">
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
                    v-model="form.nom"
                    name="nom"
                    id="nom"
                    autocomplete="nom"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Nom"
                  />
                  <div v-if="form.errors.nom">{{ form.errors.nom }}</div>
                </div>
              </div>
            </div>

            <!--Prenom  -->
            <div class="sm:col-span-4">
              <label
                for="prenom"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Prénom</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    required
                    v-model="form.prenom"
                    name="prenom"
                    id="prenom"
                    autocomplete="prenom"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Prénom"
                  />
                  <div v-if="form.errors.prenom">{{ form.errors.prenom }}</div>
                </div>
              </div>
            </div>

            <!-- Adresse -->
            <div class="col-span-full">
              <label
                for="adresse"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Adresse</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    required
                    v-model="form.adresse"
                    name="adresse"
                    id="adresse"
                    autocomplete="adresse"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Adresse"
                  />
                  <div v-if="form.errors.adresse">
                    {{ form.errors.adresse }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Adresse -->
            <div class="col-span-full">
              <label
                for="dateN"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Date de Naissance</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="date"
                    required
                    v-model="form.dateN"
                    name="dateN"
                    id="dateN"
                    autocomplete="Date de Naissance"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Date de Naisssance"
                  />
                  <div v-if="form.errors.dateN">{{ form.errors.dateN }}</div>
                </div>
              </div>
            </div>

            <!-- Sexe -->
            <div class="sm:col-span-3">
              <label
                for="genre"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Genre</label
              >
              <div class="mt-2">
                <select
                  id="genre"
                  required
                  v-model="form.genre"
                  name="genre"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                >
                  <option value="Homme">Homme</option>
                  <option value="Femme">Femme</option>
                </select>
                <div v-if="form.errors.genre">{{ form.errors.genre }}</div>
              </div>
            </div>

            <!-- Groupe Sanguin -->
            <div class="sm:col-span-3">
              <label
                for="groupe_sanguin"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Groupe Sanguin</label
              >
              <div class="mt-2">
                <select
                  id="groupe_sanguin"
                  required
                  v-model="form.groupe_sanguin"
                  name="groupe_sanguin"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                >
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
                <div v-if="form.errors.groupe_sanguin">
                  {{ form.errors.groupe_sanguin }}
                </div>
              </div>
            </div>
          </div>

          <!-- Téephone -->
          <div class="col-span-full mt-4">
            <label
              for="telephone"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Téléphone</label
            >
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
              >
                <input
                  type="text"
                  v-model="form.telephone"
                  required
                  name="telephone"
                  id="telephone"
                  autocomplete="telephone"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Téléphone"
                />
              </div>
              <div v-if="form.errors.telephone">
                {{ form.errors.telephone }}
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="col-span-full mt-4">
            <label
              for="email"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Email</label
            >
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
              >
                <input
                  type="email"
                  required
                  v-model="form.email"
                  name="email"
                  id="email"
                  autocomplete="email"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Email"
                />
                <div v-if="form.errors.email">{{ form.errors.email }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Colonne 2 -->

        <div>
          <div
            class="col-span-full flex bg-white rounded-lg flex-column justify-center items-center"
          >
            <div class="mt-2 flex items-center gap-x-3">
              <img
                :src="image"
                class="w-64 h-64 object-cover rounded-lg shadow-md"
              />
            </div>
            <div class="col-span-full">
              <label
                for="photos"
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
                    </label>
                    <p class="pl-1">ou glisser-déposer</p>
                  </div>
                  <p class="text-xs leading-5 text-gray-600">
                    PNG, JPG, GIF jusqu'à 10MB
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

          <!-- Contecte pére si mineure -->
          <div
            class="gap-4 flex mt-4"
            v-if="(form.age && form.age < 18) || form.age === 0"
          >
            <!-- Adresse -->
            <div class="col-span-full">
              <label
                for="adresse"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Nom du pére</label
              >
              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    v-model="form.nom_pere"
                    name="nomPere"
                    id="nomPere"
                    autocomplete="nomPere"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Nom d pére"
                  />
                </div>
                <div v-if="form.errors.nom_pere">
                  {{ form.errors.nom_pere }}
                </div>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="adresse"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Nom de la mére</label
              >

              <div class="mt-2">
                <div
                  class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                >
                  <input
                    type="text"
                    v-model="form.nom_mere"
                    name="NomMere"
                    id="NomMere"
                    autocomplete="adresse"
                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    placeholder="Nom de la Mére"
                  />
                </div>
                <div v-if="form.errors.nom_mere">
                  {{ form.errors.nom_mere }}
                </div>
              </div>
            </div>
          </div>

          <!-- Télephone d-urgence -->
          <div class="col-span-full mt-4">
            <label
              for="contact_urgence_telephone"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Téléphone du Contact d'Urgence</label
            >
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
              >
                <input
                  type="text"
                  v-model="form.contact_urgence_telephone"
                  name="contact_urgence_telephone"
                  id="contact_urgence_telephone"
                  autocomplete="contact_urgence_telephone"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Téléphone du Contact d'Urgence"
                />
                <div v-if="form.errors.contact_urgence_telephone">
                  {{ form.errors.contact_urgence_telephone }}
                </div>
              </div>
            </div>
          </div>

          <!-- Contacte D-URGENCE -->
          <div class="col-span-full mt-4">
            <label
              for="contact_urgence_nom"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Nom du Contact d'Urgence</label
            >
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
              >
                <input
                  type="text"
                  v-model="form.contact_urgence_nom"
                  name="contact_urgence_nom"
                  id="contact_urgence_nom"
                  autocomplete="contact_urgence_nom"
                  class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="Nom du Contact d'Urgence"
                />
                <div v-if="form.errors.contact_urgence_nom">
                  {{ form.errors.contact_urgence_nom }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Allergies -->
      <fieldset>
        <label
          for="allergies"
          class="block text-xl font-sm leading-6 text-gray-900"
        >
          <i class="fas fa-user"></i>
          Allergies
        </label>
        <hr class="mt-4 mb-4 ">
        <div class="bg-blue-300  shadow p-5 rounded-xl">
          <div
            v-for="(allergie, index) in form.allergies"
            :key="index"
            class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"
          >
            <div>
              <label
                :for="'allergies_name_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >
                Nom de l'Allergie</label
              >
              <div class="mt-2">
                <input
                  v-model="allergie.name"
                  :name="'allergies_name_' + index"
                  :id="'allergies_name_' + index"
                  type="text"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  placeholder="Nom de l'allergie"
                />
              </div>
            </div>

            <div>
              <label
                :for="'allergies_description_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Description de l'Allergie</label
              >
              <div class="mt-2 flex gap-3">
                <textarea
                  v-model="allergie.description"
                  :name="'allergies_description_' + index"
                  :id="'allergies_description_' + index"
                  rows="1"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  placeholder="Décrivez les symptômes et la gravité ici"
                ></textarea>

                <button
                  v-if="form.allergies && form.allergies.length >= 1"
                  type="button"
                  @click="removeAllergie(allergie)"
                  class="mt-2"
                >
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
          <button
            type="button"
            @click="addAllergie"
            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
          >
            <i class="fas fa-plus"></i>
            Ajouter
          </button>
        </div>
      </fieldset>

        <!-- Historique Médical -->
        <fieldset>
          <h1
            for="historique_medical"
            class="block text-xl font-sm leading-6 text-gray-900 mt-4"
            >
            <i class="fas fa-folder"></i>
            Historique Médical</h1
          >
          <hr class="mb-5 mt-4 ">
  
          <div class="bg-green-300  shadow p-5 rounded-xl">
            
            <div
              v-for="(historique, index) in form.historique_medical"
              :key="index"
              class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5"
            >
              <!--Maladie  -->
              <div>
                <label
                  :for="'historique_medical_condition_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Maladie</label
                >
                <div class="mt-2">
                  <input
                    v-model="historique.maladie"
                    :name="'historique_medical_condition_' + index"
                    :id="'historique_medical_condition_' + index"
                    type="text"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Nom de la condition médicale"
                  />
                </div>
              </div>
  
            <!-- Type -->
            <div>
              <label
                :for="'historique_medical_date_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Type d'Antécédant</label
              >
              <div class="mt-2">
                <select
                  v-model="historique.type"
                  :name="'historique_medical_date_' + index"
                  :id="'historique_medical_date_' + index"
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
                :for="'historique_medical_date_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Catégorie d'Antécédant</label
              >
              <div class="mt-2">
                <select
                  v-model="historique.category"
                  :name="'historique_medical_date_' + index"
                  :id="'historique_medical_date_' + index"
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
                :for="'historique_medical_date_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Date de Diagnostic</label
              >
              <div class="mt-2">
                <input
                  v-model="historique.date"
                  :name="'historique_medical_date_' + index"
                  :id="'historique_medical_date_' + index"
                  type="date"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
            </div>
  
      
  
             <!-- Hérédité -->
             <div>
              <label
                :for="'historique_medical_date_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Est -ce Héréditaire ?</label
              >
              <div class="mt-2">
                <select
                  v-model="historique.hereditary"
                  :name="'historique_medical_date_' + index"
                  :id="'historique_medical_date_' + index"
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
                :for="'historique_medical_date_' + index"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Le traitement est-il déja terminé ?</label
              >
              <div class="mt-2">
                <select
                  v-model="historique.encours_traitement"
                  :name="'historique_medical_date_' + index"
                  :id="'historique_medical_date_' + index"
                  type="date"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                <option  value="1">Oui</option>
                <option value="0">Non</option>
  
              </select>
  
              </div>
            </div>
  
           
  
          
  
  
              <div>
                <label
                  :for="'historique_medical_description_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Description</label
                >
                <div class="flex gap-3 mt-2">
                  <textarea
                    v-model="historique.description"
                    :name="'historique_medical_description_' + index"
                    :id="'historique_medical_description_' + index"
                    rows="1"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Décrivez les détails de l'historique médical ici"
                  ></textarea>
                </div>
              </div>
  
             
              
              
              
  
              <!-- Liste des medicament -->
              <div>
                <label
                  :for="'historique_medical_description_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Medication</label
                >
                <div class="flex gap-3 mt-2">
                  <textarea
                    v-model="historique.medications"
                    :name="'historique_medical_description_' + index"
                    :id="'historique_medical_description_' + index"
                    rows="1"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Décrivez les détails de l'historique médical ici"
                  ></textarea>
                  <!-- Bouton pour ajouter une nouvelle condition médicale -->
                  <button
                    type="button"
                    @click="removeHistory(historique)"
                    class="rounded"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
  
  
              
            </div>
            <!-- Bouton pour ajouter une nouvelle condition médicale -->
            <button
              type="button"
              @click="addMedicalHistory"
              class="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
            >
              <i class="fas fa-plus"></i>
              Ajouter Historique Médicale
            </button>
          </div>
        </fieldset>
  
        <fieldset>
          <h1
            for="historique_medical"
            class="block text-xl font-sm leading-6 text-gray-900 mt-4"
            >
            <i class="fas fa-folder"></i>
            Mode de vie</h1
          >
          <hr class="mb-5 mt-4 ">
          <div class="bg-red-300  shadow p-5 rounded-xl">
            <div
              v-for="(habitude, index) in form.habitudes"
              :key="index"
              class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5"
            >
              <div>
                <label
                  :for="'historique_medical_condition_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Habitude</label
                >
                <div class="mt-2">
                  <input
                    v-model="habitude.nom"
                    :name="'historique_medical_condition_' + index"
                    :id="'historique_medical_condition_' + index"
                    type="text"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Nom de l'Habitude"
                  />
                </div>
                <span v-if="form.errors.habitudes && form.errors.habitudes[index] && form.errors.habitudes[index].nom" class="text-red-600 text-sm">
                  {{ form.errors.habitudes[index].nom }}
                </span>
              </div>
  
              <div>
                <label
                  :for="'historique_medical_date_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Date de Début</label
                >
                <div class="mt-2">
                  <input
                    v-model="habitude.dateD"
                    :name="'historique_medical_date_' + index"
                    :id="'historique_medical_date_' + index"
                    type="date"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
                </div>
  
                <span v-if="form.errors.habitudes && form.errors.habitudes[index] && form.errors.habitudes[index].dateD" class="text-red-600 text-sm">
                  {{ form.errors.habitudes[index].dateD }}
                </span>
              </div>
  
  
              <div>
                <label
                  :for="'historique_medical_description_' + index"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Date de Fin</label
                >
                <div class="flex gap-3 mt-2">
                  <input
                    v-model="habitude.dateF"
                    type="date"
                    :name="'historique_medical_description_' + index"
                    :id="'historique_medical_description_' + index"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Décrivez les détails de l'historique médical ici"
                  >
                  <span v-if="form.errors.habitudes && form.errors.habitudes[index] && form.errors.habitudes[index].dateF" class="text-red-600 text-sm">
                    {{ form.errors.habitudes[index].dateF }}
                  </span>
                  <!-- Bouton pour ajouter une nouvelle condition médicale -->
                  <button
                    type="button"
                    @click="removeHabitude(habitude)"
                    class="rounded"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
            <!-- Bouton pour ajouter une nouvelle condition médicale -->
            <button
              type="button"
              @click="addHabitude"
              class="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
            >
              <i class="fas fa-plus"></i>
              Ajouter Mode de vie
            </button>
          </div>
        </fieldset>

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
import { PhotoIcon } from "@heroicons/vue/24/solid";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Allergie, Patient, HistoriqueMedical,Habitude } from "@/Interfaces/Patient";
import { defineProps, Ref, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
  patient: Patient;
}>();

//Calcule de l'âge
const calculateAge = () => {
  let now = new Date();
  let birth = new Date(form.dateN);
  let age = now.getFullYear() - birth.getFullYear();
  return age;
};


// Initialiser le formulaire avec useForm
const form = useForm<Patient>({
  id: props.patient.id || null,
  matricule: props.patient.matricule ,
  prfs:props.patient.prfs,
  nom: props.patient.nom ,
  prenom: props.patient.prenom ,
  adresse: props.patient.adresse ,
  email: props.patient.email,
  telephone: props.patient.telephone,
  photos: props.patient.photos,
  genre: props.patient.genre,
  groupe_sanguin:props.patient.groupe_sanguin,
  dateN: props.patient.dateN,
  historique_medical: props.patient.historique_medical,
  allergies: props.patient.allergies,
  nom_mere: props.patient.nom_mere,
  nom_pere: props.patient.nom_pere,
  contact_urgence_nom: props.patient.contact_urgence_nom,
  contact_urgence_telephone: props.patient.contact_urgence_telephone,
  habitudes:props.patient.habitudes,
  age: null,
});

let image = ref(props.patient.photos? props.patient.photos:null);
form.age=calculateAge();

//Surveiller l'age
watch(
  () => form.dateN,
  (newDateN) => {
    if (newDateN) {
      form.age = calculateAge();
    } else {
      form.age = null;
    }
  }
);

//Surveiller les changements dans nom, prenom et dateN pour générer le matricule
watch([() => form.nom, () => form.prenom, () => form.dateN], () => {
  form.matricule = generateMatr();
});



// Fonction asynchrone pour soumettre le formulaire
const submitForm = async () => {
  try {
    await form.post(route("patient.update"));

    // form.reset();
  } catch (error) {
    // Gérer les erreurs de soumission
    console.error("Erreur lors de la soumission du formulaire", error);
  }
};

//Géneration du matricule
const generateMatr = () => {
  let nom = form.nom.slice(0, 2).toUpperCase();
  let prenom = form.prenom.slice(0, 2).toUpperCase();
  let birth = new Date(form.dateN);
  // Les deux derniers chiffres de l'année de naissance
  let birthYear = birth.getFullYear().toString().slice(-2);
  // Mois de naissance à deux chiffres
  let birthMonth = (birth.getMonth() + 1).toString().padStart(2, "0");
  // Jour de naissance à deux chiffres
  let birthDay = birth.getDate().toString().padStart(2, "0");

  return `P-${nom}${prenom}${birthYear}${birthMonth}${birthDay}`;
};

//Afficher l'image à chaque Sélection
const afficherImage = async (event: any) => {
  const file = event.target.files[0];
  if (file) {
    image.value = URL.createObjectURL(file);
  }
};


//Ajouter une allergie
const addAllergie = () => {
  form.allergies?.push({ name: "", description: "" });
};

//Ajouter une allergie
const addMedicalHistory = () => {
  form.historique_medical?.push({
      id: null,
      patient_id: null,
      date: "",
      description: "",
      encours_traitement: false,
      type: "Familiale",
      category: "Médicale",
      hereditary: false,
      medications: "",
      maladie:"",
    });
};

//Ajouter une allergie
const addHabitude = () => {
  form.habitudes?.push({nom:"",dateD:"",dateF:""});
};

//Supprimer un allergie
const removeHabitude = (habitude: Habitude) => {
  form.habitudes = form.habitudes?.filter((al) => al.nom !== habitude.nom);
};

//Supprimer un allergie
const removeAllergie = (allergie: Allergie) => {
  form.allergies = form.allergies?.filter((al) => al.name !== allergie.name);
};

//Supprimer un Historique
const removeHistory = (historique: HistoriqueMedical) => {
  form.historique_medical = form.historique_medical?.filter(
    (al) => al.maladie !== historique.maladie
  );
};
</script>
