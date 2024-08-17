export interface Doctor {
    id: number|null;
    name: string;
    phone: string;
    address: string;
    photos: File | null; // `File | null` si le champ est optionnel // `File | null` si le champ est optionnel
    email:string;
    specialite_id:null|number;
    matricule:String


  }