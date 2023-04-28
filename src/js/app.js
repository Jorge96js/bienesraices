document.addEventListener('DOMContentLoaded', function(){
    eventListeners()
    darkMode()
})

function darkMode(){
    const preferencia = window.matchMedia('(prefers-color-scheme: dark)')

    if(preferencia.matches){
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    }

    preferencia.addEventListener('change', function(){
        if(preferencia.matches){
            document.body.classList.add('dark-mode')
        }else{
            document.body.classList.remove('dark-mode')
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton')

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode')
    })
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu')
    mobileMenu.addEventListener('click',navegacionResponsiva)
}

function navegacionResponsiva(){
    const navegacion = document.querySelector('.navegacion')

    //navegacion.classList.toggle('mostrar') 

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar')
    }else{
        navegacion.classList.add('mostrar')

    }
}