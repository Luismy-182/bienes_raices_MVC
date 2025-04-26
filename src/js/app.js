document.addEventListener('DOMContentLoaded', app);

function app(){
    menuApp();
    darkMode();
    campos();
    
}


function menuApp(){
    const mobileMenu = document.querySelector('.mobile-menu');
    const navegacion = document.querySelector('.navegacion');

    mobileMenu.addEventListener('click', e=>{
        e.preventDefault();
        if(navegacion.classList.contains('visible')){
            
            navegacion.classList.remove('visible');
            
        }else{
            navegacion.classList.add('visible');
        }
       
    });    
}


function darkMode(){
    const darkMode = document.querySelector('.btn-dark-mode');
    const defaultTheme=window.matchMedia('(prefers-color-scheme:dark)'); //lee las preferencias del usuario del tema
    
    //console.log(defaultTheme);
    /**************Leyendo preferencias del usuario en thema del sistema******************/
    if(defaultTheme.matches){

        document.body.classList.add('mode-dark');
        
      
    }else{
   
        document.body.classList.remove('mode-dark');
            
    }

    /*********CAMBIAR AUTOMATICAMENTE EN CUANTO CAMBIE EL TEMA DEL SISTEMA********* */
    
    defaultTheme.addEventListener('change', ()=>{
        if(defaultTheme.matches){

            document.body.classList.add('mode-dark');     
        }else{
            
            document.body.classList.remove('mode-dark');
                
        }
    })


    darkMode.addEventListener('click', e=>{
        e.preventDefault();
        if(document.body.classList.contains('mode-dark')){
            
            document.body.classList.remove('mode-dark');
            localStorage.setItem('modo-oscuro','false'); //almacenamos en local storage para que al recargar
            //no perdamos el tema
            
            
        }else{
            document.body.classList.add('mode-dark');
            localStorage.setItem('modo-oscuro','true');
        }
       
        
    })

        //Obtenemos el modo del color actual, buscaremos si ya existe
        if (localStorage.getItem('modo-oscuro') === 'true') {
            document.body.classList.add('mode-dark');
        } else {
            document.body.classList.remove('mode-dark');
        }
    
    
}


function campos(){
    const metodoContacto=document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value==='telefono'){
        contactoDiv.innerHTML=`
        <label for="telefono">Teléfono</label>
        <input type="number" name="telefono" id="telefono" name="contacto[telefono]">
        
        <p>Elija la fecha y la hora para ser contactado</p>

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" min="9:00" max="18:00" name="contacto[hora]">
        
        
        `;
    }else{
        contactoDiv.innerHTML=`
        <label for="email">Email</label>
        <input type="email" name="email" id="email" name="contacto[email]" required>
        `;
    }
    
}