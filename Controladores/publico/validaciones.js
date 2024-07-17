/*VALIDAR LOGIN*/
console.log("Vinculo exitoso");

// Selecciona los campos de entrada del username y password.
const usernameLField = document.querySelector("[name=correo]");
const passwordLField = document.querySelector("[name=clave]");

const validateEmptyField = (e) => {
    const field = e.target;
    const fieldValue = e.target.value;
   if(fieldValue.length == 0){
    //devuelve el elemento hermano siguiente del elemento actual en el árbol DOM
    field.nextElementSibling.classList.add("error");
    field.nextElementSibling.innerText = `${field.name} requerida`;
   }
   else
   {
    field.nextElementSibling.classList.remove("error");
    field.nextElementSibling.innerText = "";
   }
}

// Agrega un evento para el evento "blur" (cuando el campo pierde el foco) en username.
usernameLField.addEventListener("blur",validateEmptyField);
passwordLField.addEventListener("blur",validateEmptyField);


/*VALIDAR SIGN UP*/