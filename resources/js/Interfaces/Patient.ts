export interface Allergie {
  id?:null | number
  name: string;
  description: string;
  patient_id?:null|number
}

export interface HistoriqueMedical {
  id?: number| null;
  maladie: string ;
  patient_id: number | null;
  date: string; // Format 'YYYY-MM-DD'
  description?: string; // Champ optionnel
  encours_traitement: boolean;
  type?: 'Familiale' | 'Personnelle'; // Champ optionnel
  category?: 'Médicale' | 'chirurgicale' | 'Ginéco-Opstétrique'; // Champ optionnel
  hereditary: boolean;
  medications?: string; // Champ optionnel
  
}

export interface Habitude {
  id: number | null;
  nom: string;
  dateD: string;
  dateF: string;
  patient_id?:null|number;
}

export interface Patient {
  id: number | null;
  nom: string;
  prfs: string;
  matricule: string;
  prenom: string;
  adresse: string;
  email: string;
  telephone: string;
  photos: File | null;
  genre: 'Homme' | 'Femme';
  groupe_sanguin: 'A+' | 'A-' | 'B+' | 'B-' | 'AB+' | 'AB-' | 'O+' | 'O-';
  dateN: string; // Date de naissance sous forme de chaîne (ISO 8601)
  historique_medical?: HistoriqueMedical[];
  allergies?: Allergie[];
  contact_urgence_nom: string;
  contact_urgence_telephone: string;
  nom_pere?: string;
  nom_mere?: string; // Nom du parent pour les mineurs
  age?: number | null;
  habitudes?: Habitude[];
  
}
