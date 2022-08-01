let odontologico = document.querySelector('#odontologico');


odontologico.addEventListener('click', () => {
    if (odontologico.checked) {
        odontologico.value = "si";
    } else {
        odontologico.value = "no";
    }
});

const calcularEdad = (fechaNacimiento) => {
    const fechaActual = new Date();
    const anoActual = parseInt(fechaActual.getFullYear());
    const mesActual = parseInt(fechaActual.getMonth()) + 1;
    const diaActual = parseInt(fechaActual.getDate());

    const anoNacimiento = parseInt(String(fechaNacimiento).substring(0, 4));
    const mesNacimiento = parseInt(String(fechaNacimiento).substring(5, 7));
    const diaNacimiento = parseInt(String(fechaNacimiento).substring(8, 10));

    let edad = anoActual - anoNacimiento;
    if (mesActual < mesNacimiento) {
        edad--;
    } else if (mesActual === mesNacimiento) {
        if (diaActual < diaNacimiento) {
            edad--;
        }
    }
    return edad;
}

let edad = document.querySelector('#edad');
let fechaNacimiento = document.querySelector('#fechaNacimiento');

window.addEventListener('load', function() {
    fechaNacimiento.addEventListener('change', function() {
        if (this.value) {
            edad.value = calcularEdad(this.value)
        }

    })
});


let formEliminar = document.querySelector('#formEliminar');

formEliminar.addEventListener('submit', function(event) {
    // si es false entonces que no haga el submit
    if (!confirm('Realmente desea eliminar?')) {
        event.preventDefault();
    }
}, false);

// (function() {
//     var form = document.getElementById('formEliminar');
//     form.addEventListener('submit', function(event) {
//         // si es false entonces que no haga el submit
//         if (!confirm('Realmente desea eliminar?')) {
//             event.preventDefault();
//         }
//     }, false);
// })();