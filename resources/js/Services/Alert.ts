import Swal from 'sweetalert2';

 class sweetalert2 {

    public async confirmation (confirm:String){
        return await Swal.fire({
            title: "Do you want to save the changes?",
            showCancelButton: true,
            confirmButtonText: "Valider",
            cancelButtonColor:"red",
            confirmButtonColor:"green"
          })
    }

    public async Success (confirm:String){
        Swal.fire({
            title:confirm,
            icon:"success"
          })
    }
}



export const alert=new sweetalert2();

