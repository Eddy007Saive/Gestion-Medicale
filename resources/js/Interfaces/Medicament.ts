export interface Medicament {
    id: number | null;
    nom: string;
    photos?: string | null;
    stock: number | null;
    prix: number | null;
    dosage: string;
    ingredient: string;
    date_peremption: string;  
    description?: string | null;  
    fabricant?: string | null;  
    date_fabrication?: string | null;  
    type_medicament?: string | null;  
    forme_id: number | null;  
}