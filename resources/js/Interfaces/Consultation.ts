export interface Consultation {
    id: number|null;
    dateCons: string;
    motifs: string;
    diagnostic: string;
    medecin_id:  number|null; 
    patient_id: number|null;
    temperature: number|null;
    poids: number|null;
    taille: number|null;
    pression_systolique: number|null;
    pression_diastolique: number|null;
    frequence_cardiaque: number|null;
    saturation_oxygene: number|null;
    glycemie: number|null;
    frequence_respiratoire: number|null;
    type:'Médicale' | 'chirurgicale' | 'Ginéco-Opstétrique',
  }